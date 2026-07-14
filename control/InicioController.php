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
require_once __DIR__ . '/../model/Catalogo.php';

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
// MATRICULAR - el proceso de negocio del proyecto
//
// Este es el flujo que el enunciado pide implementar "mediante un conjunto de
// procedimientos almacenados, funciones y triggers". El PHP casi no decide
// nada: solo pasa los datos. Toda la logica vive en la base de datos.
//
//   1. pkg_matriculas_crud.insertar valida, con la fila del grupo bloqueada
//      (SELECT ... FOR UPDATE), que el grupo este abierto y que quede cupo.
//      Si no, devuelve ORA-20006 / ORA-20007 / ORA-20008.
//   2. El trigger trg_bi_matriculas_act rechaza a un estudiante inactivo.
//   3. El trigger trg_bi_matriculas asigna el matricula_id de la secuencia.
//   4. El trigger trg_cupo_matriculas sube cupo_actual y, si el grupo se
//      llena, lo pasa solo a CERRADO.
//   5. El trigger trg_aud_matriculas escribe en la bitacora (transaccion
//      autonoma: queda registrado aunque despues haya ROLLBACK).
//   6. Aqui se genera el pago PENDIENTE por el precio real del curso.
// ===========================================================================
if (isset($_POST['btnMatricular'])) {

    if (!isset($_SESSION['estudiante_id'])) {
        mensaje('Iniciá sesión primero',
                'Para matricularte necesitás entrar con tu cédula. Si es tu primera vez, creá tu cuenta.',
                '../view/vInicio/IniciarSesion.php', '#c0392b');
    }

    $grupoId = isset($_POST['grupo_id']) ? preg_replace('/\D/', '', $_POST['grupo_id']) : '';
    if ($grupoId === '') {
        mensaje('Elegí un grupo',
                'Tenés que seleccionar uno de los grupos abiertos antes de matricularte.',
                '../view/vInicio/Cursos.php', '#c0392b');
    }

    try {
        $grupo = Catalogo::grupo($grupoId);
        if ($grupo === null) {
            mensaje('Grupo no encontrado', 'Ese grupo ya no existe.',
                    '../view/vInicio/Cursos.php', '#c0392b');
        }
        $curso = Catalogo::curso($grupo['CURSO_ID']);

        // 1) La matricula. Las validaciones las hace el paquete, no el PHP.
        $matriculaId = CrudModel::insertar('matriculas', [
            'estudiante_id'   => $_SESSION['estudiante_id'],
            'grupo_id'        => $grupoId,
            'fecha_matricula' => '',      // vacio = SYSDATE (lo pone el trigger)
            'nota_final'      => '',
            'estado'          => 'ACTIVA',
        ]);

        // 2) El pago que esa matricula genera. El monto NO se escribe a mano:
        //    es el precio que tiene el curso en la tabla CURSOS.
        CrudModel::insertar('pagos', [
            'matricula_id'      => $matriculaId,
            'monto'             => $curso['PRECIO_COLONES'],
            'fecha_pago'        => '',                                  // aun no se paga
            'fecha_vencimiento' => date('Y-m-d', strtotime('+8 days')), // 8 dias de plazo
            'metodo_pago'       => '',
            'estado'            => 'PENDIENTE',
        ]);

        header('Location: ../view/vInicio/Pagar.php?matricula=' . urlencode($matriculaId));
        exit;

    } catch (Exception $ex) {
        // Aqui caen los ORA-20006 (grupo cerrado), ORA-20007 (grupo lleno),
        // ORA-20008 (ya matriculado) y ORA-20022 (estudiante inactivo).
        mensaje('No se pudo matricular',
                htmlspecialchars($ex->getMessage()),
                '../view/vInicio/DetalleCurso.php?id=' . urlencode($_POST['curso_id'] ?? ''),
                '#c0392b');
    }
}

// ===========================================================================
// PAGAR - cierra el proceso: el pago PENDIENTE pasa a PAGADO
// ===========================================================================
if (isset($_POST['btnPagar'])) {

    if (!isset($_SESSION['estudiante_id'])) {
        mensaje('Sesión expirada', 'Volvé a iniciar sesión para completar el pago.',
                '../view/vInicio/IniciarSesion.php', '#c0392b');
    }

    $pagoId = isset($_POST['pago_id']) ? preg_replace('/\D/', '', $_POST['pago_id']) : '';
    $metodo = $_POST['metodo_pago'] ?? '';

    $permitidos = ['EFECTIVO', 'TARJETA', 'TRANSFERENCIA', 'SINPE'];
    if (!in_array($metodo, $permitidos, true)) {
        mensaje('Método de pago inválido', 'Elegí SINPE, transferencia, tarjeta o efectivo.',
                '../view/vInicio/Principal.php', '#c0392b');
    }

    try {
        $pago = CrudModel::obtener('pagos', $pagoId);
        if ($pago === null) {
            mensaje('Pago no encontrado', 'Ese pago no existe.',
                    '../view/vInicio/Principal.php', '#c0392b');
        }

        // El trigger trg_aud_pagos deja el cambio de estado en la bitacora.
        CrudModel::actualizar('pagos', $pagoId, [
            'matricula_id'      => $pago['MATRICULA_ID'],
            'monto'             => $pago['MONTO'],
            'fecha_pago'        => date('Y-m-d'),
            'fecha_vencimiento' => $pago['FECHA_VENCIMIENTO'],
            'metodo_pago'       => $metodo,
            'estado'            => 'PAGADO',
        ]);

        header('Location: ../view/vInicio/Gracias.php?pago=' . urlencode($pagoId));
        exit;

    } catch (Exception $ex) {
        mensaje('No se pudo registrar el pago',
                htmlspecialchars($ex->getMessage()),
                '../view/vInicio/Principal.php', '#c0392b');
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
