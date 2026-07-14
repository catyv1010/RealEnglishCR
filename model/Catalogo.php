<?php
// SC-504 Lenguajes de Base de Datos - Proyecto Real English CR - Grupo F
// Granados Gonzalez Luis Andres, Perez Calderon David,
// Rodriguez Arroyo Michelle Andrea, Valverde Arroyo Maria Catalina
//
// Catalogo: funciones de consulta que usan TODAS las vistas del sitio publico.
//
// Regla de oro del proyecto: ninguna vista arma SQL. Todo lo que se muestra en
// la pagina sale de aqui, y esto a su vez solo llama a los paquetes PL/SQL
// (REALENGLISH.pkg_<tabla>_crud) a traves de CrudModel, con el usuario RECR_APP,
// que no tiene NINGUN privilegio sobre las tablas.
//
// Antes cada vista tenia los cursos, los precios y los profesores escritos a
// mano en el HTML. El resultado era que la pagina decia una cosa y la base de
// datos otra. Con este archivo, si alguien cambia un precio en el mantenimiento,
// el sitio publico lo muestra al instante.

require_once __DIR__ . '/Conexion.php';
require_once __DIR__ . '/Entidades.php';
require_once __DIR__ . '/CrudModel.php';

class Catalogo
{
    // Cache en memoria: dentro de una misma peticion no repetimos la llamada
    // al paquete si dos secciones de la pagina piden lo mismo.
    private static $cache = [];

    private static function traer($entidad)
    {
        if (!isset(self::$cache[$entidad])) {
            self::$cache[$entidad] = CrudModel::listar($entidad);
        }
        return self::$cache[$entidad];
    }

    // ---------------------------------------------------------------- NIVELES
    // Devuelve ['1' => ['CODIGO'=>'A1', 'NOMBRE'=>'Principiante'], ...]
    public static function niveles()
    {
        $mapa = [];
        foreach (self::traer('niveles') as $n) {
            $mapa[$n['NIVEL_ID']] = $n;
        }
        return $mapa;
    }

    // "A1 Principiante" a partir del nivel_id
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

    // ----------------------------------------------------------------- CURSOS
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

    // Los N cursos mas baratos por nivel, para la portada. No inventamos
    // "cursos destacados": mostramos los que de verdad existen, ordenados
    // por nivel, que es como los ve el estudiante que empieza.
    public static function cursosDestacados($cuantos = 6)
    {
        $cursos = self::cursos();
        usort($cursos, function ($a, $b) {
            return ((int) $a['NIVEL_ID']) <=> ((int) $b['NIVEL_ID']);
        });
        return array_slice($cursos, 0, $cuantos);
    }

    // ------------------------------------------------------------- PROFESORES
    // Un profesor es un empleado activo cuyo puesto empieza por PROF
    // (PROF_SR = Profesor Senior, PROF_JR = Profesor Junior).
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

    // ----------------------------------------------------------------- GRUPOS
    // Grupos de un curso que todavia admiten matricula (ABIERTO y con cupo).
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

    // Cupos que quedan libres en un grupo
    public static function cupoDisponible($grupo)
    {
        return max(0, ((int) $grupo['CUPO_MAX']) - ((int) $grupo['CUPO_ACTUAL']));
    }

    // -------------------------------------------------------------- CONTADORES
    // Los numeros que salen en la portada y en Acerca de. Antes estaban
    // escritos a mano ("80,000+ cursos") y se contradecian entre paginas.
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

    // ---------------------------------------------------------------- IMAGENES
    // La imagen se deriva del ID del registro, NO de su posicion en la lista.
    // Antes se usaba team<?= $i % 4 ?>.jpg: con 15 profesores, cuatro caras se
    // repetian una y otra vez, y al borrar un empleado se corrian todas.
    // Ahora cada empleado tiene su prof_<id>.png y cada curso su curso_<id>.png.
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

    // ------------------------------------------------------------------ FORMATO
    // Formato tico de colones: separador de miles con punto. Antes cada pagina
    // lo escribia distinto (110,000 en una, 70.000 en otra).
    public static function colones($monto)
    {
        return '&#8353; ' . number_format((float) $monto, 0, ',', '.');
    }

    // Fecha de Oracle (viene como DD/MM/YY o YYYY-MM-DD segun el NLS) a texto
    public static function fecha($valor)
    {
        if (empty($valor)) {
            return '';
        }
        $ts = strtotime(str_replace('/', '-', $valor));
        return $ts === false ? $valor : date('d/m/Y', $ts);
    }
}
