<?php
// Real English CR - Grupo F
// Proceso estrella del proyecto. El sitio NO inserta la matricula ni el pago:
// llama a REALENGLISH.sp_matricular_estudiante, que hace las dos inserciones
// dentro de una sola transaccion protegida por un SAVEPOINT.
//
// Reparto de responsabilidades:
//   - El procedimiento valida, bloquea el grupo con FOR UPDATE, inserta la
//     matricula y el pago, y NO hace COMMIT.
//   - Si algo falla, el procedimiento hace ROLLBACK a su savepoint y levanta
//     una excepcion con su codigo (-20001 a -20005).
//   - Quien confirma es este llamador: el driver OCI8 corre en modo
//     OCI_COMMIT_ON_SUCCESS, asi que confirma solo si la llamada termina bien.

require_once __DIR__ . '/Conexion.php';

class Matricula
{
    // Mensajes propios para los errores que levanta el procedimiento.
    private static $mensajes = [
        20001 => 'Tu cuenta no está activa. Escribinos para reactivarla.',
        20002 => 'Ese grupo ya no existe.',
        20003 => 'Ese grupo no está abierto para matrícula.',
        20004 => 'Ese grupo ya no tiene cupo disponible.',
        20005 => 'Ya estás matriculada en ese grupo.',
    ];

    /**
     * Matricula a un estudiante en un grupo.
     * Devuelve el matricula_id que genero la base.
     * Lanza Exception con un mensaje presentable si el procedimiento la rechaza.
     */
    public static function matricular($estudianteId, $grupoId, $metodoPago = '')
    {
        $con = Conexion::obtener();

        // OCI8 se lleva mejor con cadena vacia que con null; en Oracle '' ES NULL,
        // asi que el procedimiento recibe exactamente lo mismo.
        $metodoPago = (string) $metodoPago;

        $sql = 'BEGIN REALENGLISH.sp_matricular_estudiante('
             . 'p_estudiante_id => :p_estudiante_id, '
             . 'p_grupo_id      => :p_grupo_id, '
             . 'p_metodo_pago   => :p_metodo_pago, '
             . 'p_matricula_id  => :p_matricula_id); END;';

        $stmt = oci_parse($con, $sql);

        $matriculaId = 0;
        oci_bind_by_name($stmt, ':p_estudiante_id', $estudianteId);
        oci_bind_by_name($stmt, ':p_grupo_id',      $grupoId);
        oci_bind_by_name($stmt, ':p_metodo_pago',   $metodoPago);
        oci_bind_by_name($stmt, ':p_matricula_id',  $matriculaId, 20);

        $ok = @oci_execute($stmt);   // confirma solo si termina bien

        if (!$ok) {
            $e = oci_error($stmt);
            oci_free_statement($stmt);
            throw new Exception(self::traducir($e));
        }

        oci_free_statement($stmt);

        return (int) $matriculaId;
    }

    // Convierte el ORA-xxxxx en algo que el estudiante pueda entender.
    private static function traducir($e)
    {
        $codigo = isset($e['code']) ? (int) $e['code'] : 0;
        if (isset(self::$mensajes[$codigo])) {
            return self::$mensajes[$codigo];
        }

        // Cualquier otro error: se limpia la traza de PL/SQL para no mostrarla.
        $msg = isset($e['message']) ? $e['message'] : 'Error desconocido.';
        $msg = preg_replace('/\nORA-06512.*/s', '', $msg);
        $msg = preg_replace('/^ORA-\d+:\s*/', '', $msg);

        return trim($msg);
    }
}
