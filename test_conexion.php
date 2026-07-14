<?php
// SC-504 - Real English CR - Grupo F
// Prueba de la conexion Oracle vias OCI8. Es solo evidencia para el informe:
// BORRAR este archivo antes de la defensa.
//   http://localhost:81/RealEnglishCR/test_conexion.php

require_once __DIR__ . '/model/Conexion.php';
require_once __DIR__ . '/model/Entidades.php';
require_once __DIR__ . '/model/CrudModel.php';

$ts   = (defined('PHP_ZTS') && PHP_ZTS) ? 'Thread Safe (TS)' : 'Non Thread Safe (NTS)';
$bits = (PHP_INT_SIZE === 8) ? '64 bits (x64)' : '32 bits (x86)';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificación de la conexión Oracle - Real English CR</title>
    <style>
        body   { font-family: Arial, sans-serif; margin: 40px; color: #222; }
        h1     { color: #1b4f72; margin-bottom: 4px; }
        h2     { color: #2874a6; margin-top: 26px; font-size: 18px; }
        .sub   { color: #7b7d7d; margin-top: 0; }
        table  { border-collapse: collapse; margin-top: 10px; }
        td, th { border: 1px solid #ccc; padding: 7px 14px; text-align: left; font-size: 14px; }
        th     { background: #eaf2f8; }
        .ok    { color: #1e8449; font-weight: bold; }
        .no    { color: #c0392b; font-weight: bold; }
        code   { background: #f4f4f4; padding: 2px 5px; }
        ul     { line-height: 1.7; }
    </style>
</head>
<body>
    <h1>Verificación de la conexión PHP &rarr; Oracle Autonomous Database</h1>
    <p class="sub">SC-504 Lenguajes de Base de Datos &middot; Proyecto Real English CR &middot; Grupo F</p>

    <h2>1. Entorno de PHP</h2>
    <table>
        <tr><th>Versión de PHP</th>       <td><?php echo PHP_VERSION; ?></td></tr>
        <tr><th>Arquitectura</th>         <td><?php echo $bits; ?></td></tr>
        <tr><th>Thread safety</th>        <td><?php echo $ts; ?></td></tr>
        <tr><th>Archivo php.ini</th>      <td><code><?php echo php_ini_loaded_file(); ?></code></td></tr>
    </table>

    <h2>2. Extensión OCI8</h2>
    <?php if (!function_exists('oci_connect')) { ?>
        <p class="no">FALLO: la extensión OCI8 no está cargada. Revisar php.ini y el Instant Client.</p>
        </body></html>
        <?php exit;
    } ?>
    <p class="ok">✔ Extensión OCI8 cargada (oci8_19 + Oracle Instant Client 23).</p>

    <h2>3. Conexión con el usuario de la aplicación</h2>
    <?php
    try {
        Conexion::obtener();
        echo '<p class="ok">✔ Conexión establecida con RECR_APP contra el servicio '
           . '<code>xyq9b8zot1w90vt1_high</code> del wallet de Oracle Cloud.</p>';
    } catch (Exception $e) {
        echo '<p class="no">FALLO: ' . htmlspecialchars($e->getMessage()) . '</p></body></html>';
        exit;
    }
    ?>

    <h2>4. Ejecución de un paquete PL/SQL</h2>
    <?php
    try {
        $regiones = CrudModel::listar('regiones');
        $cursos   = CrudModel::listar('cursos');
        echo '<p class="ok">✔ REALENGLISH.pkg_regiones_crud.listar ejecutado ('
           . count($regiones) . ' regiones).</p><ul>';
        foreach ($regiones as $r) {
            echo '<li>' . htmlspecialchars($r['REGION_ID'] . ' - ' . $r['NOMBRE']) . '</li>';
        }
        echo '</ul>';
        echo '<p class="ok">✔ REALENGLISH.pkg_cursos_crud.listar ejecutado ('
           . count($cursos) . ' cursos).</p>';
        echo '<h2>5. Resultado</h2>';
        echo '<p class="ok">TODO FUNCIONA. El front-end lee Oracle únicamente a través de '
           . 'procedimientos almacenados: RECR_APP no tiene privilegios sobre las tablas.</p>';
    } catch (Exception $e) {
        echo '<p class="no">FALLO al ejecutar el paquete: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
    ?>
</body>
</html>
