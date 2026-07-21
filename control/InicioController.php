<?php
// Real English CR - Grupo F - controlador del sitio publico

session_start();

require_once __DIR__ . '/../model/Conexion.php';
require_once __DIR__ . '/../model/CrudModel.php';
require_once __DIR__ . '/../model/Entidades.php';
require_once __DIR__ . '/../model/Catalogo.php';

// muestra un mensaje y un boton para volver
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

// busca un estudiante por cedula
function buscarEstudiantePorCedula($cedula)
{
    foreach (CrudModel::listar('estudiantes') as $e) {
        if (isset($e['CEDULA']) && trim($e['CEDULA']) === trim($cedula)) {
            return $e;
        }
    }
    return null;
}

// login
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

// registrar
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

// contacto - guarda en la bitacora
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

// matricular - la logica la hacen los paquetes y triggers en la base
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

        // insertar matricula
        $matriculaId = CrudModel::insertar('matriculas', [
            'estudiante_id'   => $_SESSION['estudiante_id'],
            'grupo_id'        => $grupoId,
            'fecha_matricula' => '',      // vacio = SYSDATE (lo pone el trigger)
            'nota_final'      => '',
            'estado'          => 'ACTIVA',
        ]);

        // pago pendiente con el precio real del curso
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
        mensaje('No se pudo matricular',
                htmlspecialchars($ex->getMessage()),
                '../view/vInicio/DetalleCurso.php?id=' . urlencode($_POST['curso_id'] ?? ''),
                '#c0392b');
    }
}

// pagar - el pago pendiente pasa a pagado
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

// cerrar sesion
if (isset($_GET['salir'])) {
    session_destroy();
    header('Location: ../view/vInicio/Principal.php');
    exit;
}
