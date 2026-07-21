<?php
// Real English CR - Grupo F
// La validacion la hace REALENGLISH.fn_validar_admin en la BD; aqui no hay contrasenas.

require_once __DIR__ . '/Conexion.php';

class Autenticacion
{
    // devuelve el empleado_id si las credenciales son validas, o null
    public static function validarAdmin($cedula, $clave)
    {
        $con = Conexion::obtener();

        $sql  = 'BEGIN :resultado := REALENGLISH.fn_validar_admin(:cedula, :clave); END;';
        $stmt = oci_parse($con, $sql);

        $resultado = 0;
        oci_bind_by_name($stmt, ':resultado', $resultado, 20);
        oci_bind_by_name($stmt, ':cedula',    $cedula);
        oci_bind_by_name($stmt, ':clave',     $clave);

        $ok = @oci_execute($stmt);
        if (!$ok) {
            $e = oci_error($stmt);
            oci_free_statement($stmt);
            throw new Exception($e['message']);
        }

        oci_free_statement($stmt);

        return ((int) $resultado) > 0 ? (int) $resultado : null;
    }
}
