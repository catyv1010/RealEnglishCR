<?php
// SC-504 Lenguajes de Base de Datos - Proyecto Final Real English CR - Grupo F
// Granados Gonzalez Luis Andres, Perez Calderon David,
// Rodriguez Arroyo Michelle Andrea, Valverde Arroyo Maria Catalina
//
// Controlador del sitio publico. Cada formulario se reconoce por el name
// del boton de submit.
//
// IMPORTANTE (requisito de la defensa): este controlador NO ejecuta SQL
// directo. Todo pasa por CrudModel, que a su vez solo llama a los paquetes
// PL/SQL (REALENGLISH.pkg_<tabla>_crud) con el usuario RECR_APP.

session_start();

require_once __DIR__ . '/../model/Conexion.php';
require_once __DIR__ . '/../model/CrudModel.php';
require_once __DIR__ . '/../model/Entidades.php';

// ---------------------------------------------------------------------------
// Muestra un mensaje sencillo y un boton para volver
// ---------------------------------------------------------------------------
function mensaje($titulo, $texto, $volverA, $color = '#1e8449')
{
    echo "<!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'>
          <title>Real English CR</title>
          <style>
            body{font-family:Arial,sans-serif;margin:0;background:#f5f7fa;}
            .caja{max-width:560px;margin:80px auto;background:#fff;padding:40px;
                  border-radius:10px;box-shadow:0 0 30px rgba(0,0,0,.06);text-align:center;}
            h2{color:{$color};margin-top:0;}
            a{display:inline-block;margin-top:22px;padding:12px 26px;background:#1b4f72;
              color:#fff;text-decoration:none;bo