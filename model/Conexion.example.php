<?php
// SC-504 - Real English CR - Grupo F
//
// PLANTILLA de la conexion. El archivo real (model/Conexion.php) NO se sube
// a GitHub porque lleva la clave: esta en el .gitignore a proposito.
//
// COMO USARLA:
//   1. Copiar este archivo y renombrarlo a  Conexion.php  (misma carpeta).
//   2. Poner la clave real de RECR_APP (se las pasa Caty por aparte).
//   3. Requiere tener OCI8 habilitado en XAMPP: ver la guia
//      GF_SC504_Guia_OCI8_XAMPP.docx en la carpeta Entrega_Final_Defensa.

class Conexion
{
    // Usuario final de la aplicacion (rol ROL_USUARIO_FINAL).
    // Solo puede EJECUTAR los paquetes CRUD; nunca toca las tablas.
    // NO usar REALENGLISH aqui: eso rompe el esquema de control de acceso.
    private const USUARIO = 'RECR_APP';
    private const CLAVE   = 'PONER_LA_CLAVE_AQUI';

    // Alias del tnsnames.ora del wallet de Oracle Cloud
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
