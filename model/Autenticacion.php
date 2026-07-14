<?php
// SC-504 - Real English CR - Grupo F
//
// Autenticacion del modulo de mantenimientos.
//
// Este archivo NO compara contrasenas. Le pasa la cedula y la clave a la
// funcion REALENGLISH.fn_validar_admin y la base de datos responde con el
// empleado_id (si las credenciales son correctas Y el puesto es
// administrativo) o con 0 en cualquier otro caso.
//
// Consecuencia: en todo el codigo PHP del proyecto no existe ninguna
// contrasena, ni en texto plano ni cifrada. La aplicacion no la conoce.

require_once __DIR__ . '/Conexion.php';

class Autenticacion
{
    // Devuelve el empleado_id si las credenciales son validas, o null.
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
