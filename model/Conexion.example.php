<?php
// Real English CR - Grupo F
// Plantilla: copiar a Conexion.php y poner la clave real de RECR_APP. Requiere OCI8.

class Conexion
{
    // RECR_APP solo ejecuta los paquetes CRUD, no toca tablas
    private const USUARIO = 'RECR_APP';
    private const CLAVE   = 'PONER_LA_CLAVE_AQUI';

    private const SERVICIO = 'xyq9b8zot1w90vt1_high';

    private const CHARSET = 'AL32UTF8';

    private static $conexion = null;

    public static function obtener()
    {
        if (self::$conexion === null) {
            self::$conexion = oci_connect(
                self::USUARIO,
                self::CLAVE,
                self::SERVICIO,
                self::CHARSET
            );
            if (!self::$conexion) {
                $e = oci_error();
                die('Error de conexion a Oracle: ' . htmlspecialchars($e['message']));
            }
        }
        return self::$conexion;
    }
}
