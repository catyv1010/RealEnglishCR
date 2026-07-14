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
              color:#fff;text-decoration:none;border-radius:6px;}
          </style></head><body>
          <div class='caja'>
            <h2>{$titulo}</h2>
            <p>{$texto}</p>
            <a href='{$volverA}'>Volver</a>
          </div></body></html>";
    exit;
}

// ---------------------------------------------------------------------------
// Busca un estudiante por cedula usando pkg_estudiantes_crud.listar
// (no hacemos SELECT directo: el paquete devuelve el cursor y filtramos aqui)
// ---------------------------------------------------------------------------
function buscarEstudiantePorCedula($cedula)
{
    foreach (CrudModel::listar('estudiantes') as $e) {
        if (isset($e['CEDULA']) && trim($e['CEDULA']) === trim($cedula)) {
            return $e;
        }
    }
    return null;
}

// ===========================================================================
// INICIAR SESION - valida la cedula contra la tabla estudiantes
// ===========================================================================
if (isset($_POST["btnLogin"])) {

    $cedula = trim($_POST['cedula'] ?? '');
    $est    = buscarEstudiantePorCedula($cedula);

    if ($est === null) {
        mensaje('Cedula no encontrada',
                'La cedula <b>' . htmlspecialchars($cedula) . '</b> no esta registrada.
                 Si es tu primera vez, crea tu cuenta primero.',
                '../view/vInicio/RegistrarUsuarios.php', '#c0392b');
    }

    if (isset($est['ACTIVO']) && $est['ACTIVO'] === 'N') {
        mensaje('Cuenta inactiva',
                'Tu cuenta esta marcada como inactiva. Contacta a la administracion de la sede.',
                '../view/vInicio/Contacto.php', '#c0392b');
    }

    $_SESSION['estudiante_id'] = $est['ESTUDIANTE_ID'];
    $_SESSION['nombre']        = $est['NOMBRE'] . ' ' . $est['APELLIDO_P'];
    $_SESSION['cedula']        = $est['CEDULA'];

    mensaje('Bienvenida de vuelta, ' . htmlspecialchars($_SESSION['nombre']),
            'Sesion iniciada correctamente. Tu numero de estudiante es el <b>'
            . htmlspecialchars($est['ESTUDIANTE_ID']) . '</b>.',
            '../view/vInicio/Principal.php');
}

// ===========================================================================
// REGISTRAR ESTUDIANTE - inserta con pkg_estudiantes_crud.insertar
// ===========================================================================
if (isset($_POST["btnRegistrar"])) {

    $cedula = trim($_POST['cedula'] ?? '');

    if (buscarEstudiantePorCedula($cedula) !== null) {
        mensaje('Esa cedula ya existe',
                'Ya hay un estudiante registrado con la cedula '
                . htmlspecialchars($cedula) . '. Inicia sesion.',
                '../view/vInicio/IniciarSesion.php', '#c0392b');
    }

    $nivel = $_POST['nivel_inicial'] ?? '';

    $datos = [
        'cedula'           => $cedula,
        'nombre'           => trim($_POST['nombre'] ?? ''),
        'apellido_p'       => trim($_POST['apellido_p'] ?? ''),
        'apellido_m'       => trim($_POST['apellido_m'] ?? ''),
        'correo'           => trim($_POST['correo'] ?? ''),
        'telefono'         => trim($_POST['telefono'] ?? ''),
        'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? '',   // YYYY-MM-DD
        'nivel_actual_id'  => $nivel,   // '' se guarda como NULL en el paquete
        'activo'           => 'S',
    ];

    try {
        $id = CrudModel::insertar('estudiantes', $datos);
        mensaje('Cuenta creada',
                'Bienvenida a Real English CR. Tu numero de estudiante es el <b>'
                . htmlspecialchars($id) . '</b>. Ya podes iniciar sesion con tu cedula.',
                '../view/vInicio/IniciarSesion.php');
    } catch (Exception $ex) {
        mensaje('No se pudo crear la cuenta',
                htmlspecialchars($ex->getMessage()),
                '../view/vInicio/RegistrarUsuarios.php', '#c0392b');
    }
}

// ===========================================================================
// CONTACTO - guarda el mensaje en la bitacora con pkg_bitacora_crud.insertar
// ===========================================================================
if (isset($_POST["btnContacto"])) {

    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $datos = [
        'tabla'       => 'CONTACTO',
        'operacion'   => 'INSERT',
        'registro_id' => substr($email, 0, 30),
        'detalles'    => "De: {$name} <{$email}> | Asunto: {$subject} | Mensaje: {$message}",
    ];

    try {
        CrudModel::insertar('bitacora', $datos);
        mensaje('Mensaje enviado',
                'Gracias ' . htmlspecialchars($name) . ', recibimos tu mensaje y te
                 contestamos al correo ' . htmlspecialchars($email) . '.',
                '../view/vInicio/Principal.php');
    } catch (Exception $ex) {
        mensaje('No se pudo enviar el mensaje',
                htmlspecialchars($ex->getMessage()),
                '../view/vInicio/Contacto.php', '#c0392b');
    }
}

// ===========================================================================
// CERRAR SESION
// ===========================================================================
if (isset($_GET['salir'])) {
    session_destroy();
    header('Location: ../view/vInicio/Principal.php');
    exit;
}
