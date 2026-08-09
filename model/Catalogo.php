<?php
// Real English CR - Grupo F
// Consultas para las vistas del sitio publico. Solo llama a los paquetes via CrudModel.

require_once __DIR__ . '/Conexion.php';
require_once __DIR__ . '/Entidades.php';
require_once __DIR__ . '/CrudModel.php';

class Catalogo
{
    // cache en memoria por peticion
    private static $cache = [];

    private static function traer($entidad)
    {
        if (!isset(self::$cache[$entidad])) {
            self::$cache[$entidad] = CrudModel::listar($entidad);
        }
        return self::$cache[$entidad];
    }

    // niveles: ['1' => ['CODIGO'=>'A1', 'NOMBRE'=>'Principiante'], ...]
    public static function niveles()
    {
        $mapa = [];
        foreach (self::traer('niveles') as $n) {
            $mapa[$n['NIVEL_ID']] = $n;
        }
        return $mapa;
    }

    public static function nivelTexto($nivelId)
    {
        $niveles = self::niveles();
        if (!isset($niveles[$nivelId])) {
            return 'Nivel ' . $nivelId;
        }
        return $niveles[$nivelId]['CODIGO'] . ' ' . $niveles[$nivelId]['NOMBRE'];
    }

    public static function nivelCodigo($nivelId)
    {
        $niveles = self::niveles();
        return isset($niveles[$nivelId]) ? $niveles[$nivelId]['CODIGO'] : '--';
    }

    // cursos
    public static function cursos()
    {
        return self::traer('cursos');
    }

    public static function curso($id)
    {
        foreach (self::cursos() as $c) {
            if ((string) $c['CURSO_ID'] === (string) $id) {
                return $c;
            }
        }
        return null;
    }

    // los N cursos mas baratos por nivel, para la portada
    public static function cursosDestacados($cuantos = 6)
    {
        $cursos = self::cursos();
        usort($cursos, function ($a, $b) {
            return ((int) $a['NIVEL_ID']) <=> ((int) $b['NIVEL_ID']);
        });
        return array_slice($cursos, 0, $cuantos);
    }

    // profesor = empleado activo cuyo puesto empieza por PROF
    public static function profesores()
    {
        $profes = [];
        foreach (self::traer('empleados') as $e) {
            $esProfe = stripos($e['PUESTO_ID'] ?? '', 'PROF') === 0;
            if ($esProfe && ($e['ACTIVO'] ?? 'N') === 'S') {
                $profes[] = $e;
            }
        }
        return $profes;
    }

    public static function profesor($id)
    {
        foreach (self::traer('empleados') as $e) {
            if ((string) $e['EMPLEADO_ID'] === (string) $id) {
                return $e;
            }
        }
        return null;
    }

    // grupos de un curso que aun admiten matricula (ABIERTO)
    public static function gruposDeCurso($cursoId)
    {
        $lista = [];
        foreach (self::traer('grupos') as $g) {
            if ((string) $g['CURSO_ID'] !== (string) $cursoId) {
                continue;
            }
            if ($g['ESTADO'] !== 'ABIERTO') {
                continue;
            }
            $lista[] = $g;
        }
        return $lista;
    }

    public static function grupo($id)
    {
        foreach (self::traer('grupos') as $g) {
            if ((string) $g['GRUPO_ID'] === (string) $id) {
                return $g;
            }
        }
        return null;
    }

    public static function gruposDeProfesor($empleadoId)
    {
        $lista = [];
        foreach (self::traer('grupos') as $g) {
            if ((string) $g['PROFESOR_ID'] === (string) $empleadoId) {
                $lista[] = $g;
            }
        }
        return $lista;
    }

    // cupos libres en un grupo
    public static function cupoDisponible($grupo)
    {
        return max(0, ((int) ($grupo['CUPO_MAX'] ?? 0)) - ((int) ($grupo['CUPO_ACTUAL'] ?? 0)));
    }

    // contadores de la portada
    public static function contadores()
    {
        return [
            'cursos'      => count(self::cursos()),
            'profesores'  => count(self::profesores()),
            'estudiantes' => count(array_filter(self::traer('estudiantes'),
                                 function ($e) { return ($e['ACTIVO'] ?? 'N') === 'S'; })),
            'sedes'       => count(self::traer('sedes')),
            'grupos'      => count(self::traer('grupos')),
        ];
    }

    // la imagen se deriva del ID del registro (prof_<id>.png, curso_<id>.png)
    public static function imagenProfesor($empleadoId, $prefijo = '../../assets/img')
    {
        $rel  = '/team/prof_' . (int) $empleadoId . '.png';
        $disco = __DIR__ . '/../assets/img' . $rel;
        if (is_file($disco)) {
            return $prefijo . $rel;
        }
        return $prefijo . '/team/prof_default.png';
    }

    public static function imagenCurso($cursoId, $prefijo = '../../assets/img')
    {
        $rel  = '/course/curso_' . (int) $cursoId . '.png';
        $disco = __DIR__ . '/../assets/img' . $rel;
        if (is_file($disco)) {
            return $prefijo . $rel;
        }
        return $prefijo . '/course/curso_default.png';
    }

    // formato tico de colones (separador de miles con punto)
    public static function colones($monto)
    {
        return '&#8353; ' . number_format((float) $monto, 0, ',', '.');
    }

    public static function fecha($valor)
    {
        if (empty($valor)) {
            return '';
        }
        $ts = strtotime(str_replace('/', '-', $valor));
        return $ts === false ? $valor : date('d/m/Y', $ts);
    }
}
