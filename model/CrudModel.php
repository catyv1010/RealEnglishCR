<?php
// SC-504 Lenguajes de Base de Datos - Proyecto Real English CR - Grupo F
// Granados, Perez, Rodriguez, Valverde
//
// Modelo generico de mantenimientos (CRUD).
// IMPORTANTE (requisito de la defensa): este modelo NUNCA arma consultas
// SQL directas sobre las tablas. Todo se hace llamando los procedimientos
// de los paquetes pkg_<tabla>_crud con bloques anonimos PL/SQL y
// parametros con notacion nombrada (p_campo => :p_campo).

require_once __DIR__ . '/Conexion.php';
require_once __DIR__ . '/Entidades.php';

class CrudModel
{
    // ---------- LISTAR: pkg.listar(p_cursor) devuelve un SYS_REFCURSOR ----------
    public static function listar($nombreEntidad)
    {
        $ent = Entidades::obtener($nombreEntidad);
        if ($ent === null) { return []; }

        $con = Conexion::obtener();
        $sql = "BEGIN {$ent['paquete']}.listar(p_cursor => :p_cursor); END;";

        $stmt   = oci_parse($con, $sql);
        $cursor = oci_new_cursor($con);
        oci_bind_by_name($stmt, ':p_cursor', $cursor, -1, OCI_B_CURSOR);
        self::ejecutar($stmt);
        oci_execute($cursor);

        $filas = [];
        while (($fila = oci_fetch_assoc($cursor)) !== false) {
            $filas[] = $fila;
        }
        oci_free_statement($cursor);
        oci_free_statement($stmt);
        return $filas;
    }

    // ---------- OBTENER: pkg.obtener(p_<pk>, p_cursor) trae un registro ----------
    public static function obtener($nombreEntidad, $id)
    {
        $ent = Entidades::obtener($nombreEntidad);
        if ($ent === null) { return null; }

        $con = Conexion::obtener();
        $pk  = $ent['pk'];
        $sql = "BEGIN {$ent['paquete']}.obtener(p_{$pk} => :p_id, p_cursor => :p_cursor); END;";

        $stmt   = oci_parse($con, $sql);
        $cursor = oci_new_cursor($con);
        oci_bind_by_name($stmt, ':p_id', $id);
        oci_bind_by_name($stmt, ':p_cursor', $cursor, -1, OCI_B_CURSOR);
        self::ejecutar($stmt);
        oci_execute($cursor);

        $fila = oci_fetch_assoc($cursor);
        oci_free_statement($cursor);
        oci_free_statement($stmt);
        return $fila === false ? null : $fila;
    }

    // ---------- INSERTAR: pkg.insertar(p_campo1..., p_<pk> OUT) ----------
    // $datos = ['campo' => 'valor', ...] en el mismo orden de Entidades.php
    public static function insertar($nombreEntidad, $datos)
    {
        $ent = Entidades::obtener($nombreEntidad);
        if ($ent === null) { return null; }

        $con      = Conexion::obtener();
        $pk       = $ent['pk'];
        $pkManual = !empty($ent['pk_manual']);

        $params = [];
        if ($pkManual) {
            $params[] = "p_{$pk} => :p_{$pk}";
        }
        foreach (array_keys($ent['campos']) as $campo) {
            $params[] = "p_{$campo} => :p_{$campo}";
        }
        if (!$pkManual) {
            $params[] = "p_{$pk} => :p_out_id";
        }

        $sql  = "BEGIN {$ent['paquete']}.insertar(" . implode(', ', $params) . "); END;";
        $stmt = oci_parse($con, $sql);

        // bind de entrada (una variable por campo; '' se guarda como NULL)
        $valores = [];
        if ($pkManual) {
            $valores["p_{$pk}"] = isset($datos[$pk]) ? trim($datos[$pk]) : '';
            oci_bind_by_name($stmt, ":p_{$pk}", $valores["p_{$pk}"]);
        }
        foreach (array_keys($ent['campos']) as $campo) {
            $valores[$campo] = isset($datos[$campo]) ? trim($datos[$campo]) : '';
            oci_bind_by_name($stmt, ":p_{$campo}", $valores[$campo]);
        }
        $nuevoId = null;
        if (!$pkManual) {
            oci_bind_by_name($stmt, ':p_out_id', $nuevoId, 40);
        }

        self::ejecutar($stmt);
        oci_free_statement($stmt);
        return $pkManual ? $valores["p_{$pk}"] : $nuevoId;
    }

    // ---------- ACTUALIZAR: pkg.actualizar(p_<pk>, p_campo1...) ----------
    public static function actualizar($nombreEntidad, $id, $datos)
    {
        $ent = Entidades::obtener($nombreEntidad);
        if ($ent === null) { return false; }

        $con = Conexion::obtener();
        $pk  = $ent['pk'];

        $params = ["p_{$pk} => :p_{$pk}"];
        foreach (array_keys($ent['campos']) as $campo) {
            $params[] = "p_{$campo} => :p_{$campo}";
        }

        $sql  = "BEGIN {$ent['paquete']}.actualizar(" . implode(', ', $params) . "); END;";
        $stmt = oci_parse($con, $sql);

        oci_bind_by_name($stmt, ":p_{$pk}", $id);
        $valores = [];
        foreach (array_keys($ent['campos']) as $campo) {
            $valores[$campo] = isset($datos[$campo]) ? trim($datos[$campo]) : '';
            oci_bind_by_name($stmt, ":p_{$campo}", $valores[$campo]);
        }

        self::ejecutar($stmt);
        oci_free_statement($stmt);
        return true;
    }

    // ---------- ELIMINAR: pkg.eliminar(p_<pk>) ----------
    public static function eliminar($nombreEntidad, $id)
    {
        $ent = Entidades::obtener($nombreEntidad);
        if ($ent === null) { return false; }

        $con  = Conexion::obtener();
        $pk   = $ent['pk'];
        $sql  = "BEGIN {$ent['paquete']}.eliminar(p_{$pk} => :p_id); END;";
        $stmt = oci_parse($con, $sql);
        oci_bind_by_name($stmt, ':p_id', $id);
        self::ejecutar($stmt);
        oci_free_statement($stmt);
        return true;
    }

    // ---------- Opciones para los combos de llaves foraneas ----------
    // Devuelve [ 'valor_pk' => 'texto a mostrar', ... ]
    public static function opcionesFk($configFk)
    {
        $filas    = self::listar($configFk['entidad']);
        $opciones = [];
        foreach ($filas as $fila) {
            $textos = [];
            foreach ($configFk['texto'] as $col) {
                if (isset($fila[$col]) && $fila[$col] !== null) {
                    $textos[] = $fila[$col];
                }
            }
            $opciones[$fila[$configFk['valor']]] = implode(' ', $textos);
        }
        return $opciones;
    }

    // ---------- Ejecucion con manejo de errores de Oracle ----------
    // Los RAISE_APPLICATION_ERROR de los paquetes (-20001 a -20005) llegan
    // aqui; se lanza una excepcion PHP con el mensaje limpio para mostrarlo
    // al usuario en la vista.
    private static function ejecutar($stmt)
    {
        // @: el error se maneja abajo, no como warning de PHP
        $ok = @oci_execute($stmt);
        if (!$ok) {
            $e   = oci_error($stmt);
            $msg = $e['message'];
            // Dejar solo la primera linea del error (sin el stack de ORA-06512)
            $msg = preg_replace('/\nORA-06512.*/s', '', $msg);
            // Quitar el prefijo "ORA-2000x:" para mostrar solo el mensaje amigable
            $msg = preg_replace('/^ORA-\d+:\s*/', '', $msg);
            throw new Exception($msg);
        }
    }
}
