<?php
// SC-504 Lenguajes de Base de Datos - Proyecto Real English CR - Grupo F
// Granados, Perez, Rodriguez, Valverde
//
// Controlador del modulo de administracion (mantenimientos).
// Rutas: admin.php?entidad=<tabla>&accion=<listar|nuevo|crear|editar|actualizar|eliminar>
// Patron MVC: este controlador recibe la peticion, usa CrudModel (que llama
// los paquetes PL/SQL) y pinta la vista que corresponda.

session_start();

require_once __DIR__ . '/../model/Entidades.php';
require_once __DIR__ . '/../model/CrudModel.php';

class AdminController
{
    // Puestos que pueden entrar al modulo de mantenimientos.
    const PUESTOS_ADMIN = ['DIR_ACAD', 'COORD'];

    public static function despachar()
    {
        $entidad = isset($_GET['entidad']) ? $_GET['entidad'] : 'estudiantes';
        $accion  = isset($_GET['accion'])  ? $_GET['accion']  : 'listar';

        // ---------------------------------------------------------------
        // CONTROL DE ACCESO. Antes este modulo estaba abierto: cualquiera
        // que escribiera la URL podia crear, editar y borrar en las 15
        // tablas. Ahora ninguna accion se ejecuta sin sesion iniciada.
        // ---------------------------------------------------------------
        if ($accion === 'salir') {
            session_destroy();
            header('Location: admin.php');
            exit();
        }

        if ($accion === 'entrar') {
            self::entrar();   // procesa el formulario y redirige
            exit();
        }

        if (!isset($_SESSION['admin_id'])) {
            $error = isset($_SESSION['admin_error']) ? $_SESSION['admin_error'] : null;
            unset($_SESSION['admin_error']);
            require __DIR__ . '/../view/vAdmin/Login.php';
            exit();
        }

        $def = Entidades::obtener($entidad);
        if ($def === null) {
            self::flash('error', 'La entidad solicitada no existe.');
            header('Location: admin.php?entidad=estudiantes');
            exit();
        }

        try {
            switch ($accion) {

                case 'nuevo':      // muestra el formulario vacio
                    self::vistaFormulario($entidad, $def, null);
                    break;

                case 'crear':      // POST del formulario -> pkg.insertar
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $id = CrudModel::insertar($entidad, $_POST);
                        self::flash('ok', "Registro creado correctamente (ID: {$id}).");
                    }
                    self::redirigir($entidad);
                    break;

                case 'editar':     // muestra el formulario con datos -> pkg.obtener
                    // Sin este guard, entrar a admin.php?accion=editar (sin id)
                    // tiraba "Undefined array key" y le pasaba NULL al paquete.
                    if (!isset($_GET['id']) || $_GET['id'] === '') {
                        self::flash('error', 'No se indico cual registro editar.');
                        self::redirigir($entidad);
                    }
                    $registro = CrudModel::obtener($entidad, $_GET['id']);
                    if ($registro === null) {
                        self::flash('error', 'No se encontro el registro.');
                        self::redirigir($entidad);
                    }
                    self::vistaFormulario($entidad, $def, $registro);
                    break;

                case 'actualizar': // POST del formulario -> pkg.actualizar
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
                        CrudModel::actualizar($entidad, $_POST['id'], $_POST);
                        self::flash('ok', 'Registro actualizado correctamente.');
                    }
                    self::redirigir($entidad);
                    break;

                case 'eliminar':   // POST (con confirmacion) -> pkg.eliminar
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
                        CrudModel::eliminar($entidad, $_POST['id']);
                        self::flash('ok', 'Registro eliminado correctamente.');
                    }
                    self::redirigir($entidad);
                    break;

                case 'listar':
                default:           // pkg.listar
                    $filas = CrudModel::listar($entidad);
                    self::vistaLista($entidad, $def, $filas);
                    break;
            }
        } catch (Exception $ex) {
            // Los mensajes de RAISE_APPLICATION_ERROR llegan aqui ya limpios
            self::flash('error', $ex->getMessage());
            self::redirigir($entidad);
        }
    }

    // ------------------- helpers -------------------

    private static function vistaLista($entidad, $def, $filas)
    {
        require __DIR__ . '/../view/vAdmin/Lista.php';
    }

    private static function vistaFormulario($entidad, $def, $registro)
    {
        // precargar los combos de llaves foraneas
        $opcionesFk = [];
        foreach ($def['campos'] as $campo => $cfg) {
            if ($cfg['tipo'] === 'fk') {
                $opcionesFk[$campo] = CrudModel::opcionesFk($cfg['fk']);
            }
        }
        require __DIR__ . '/../view/vAdmin/Formulario.php';
    }

    private static function redirigir($entidad)
    {
        header("Location: admin.php?entidad={$entidad}&accion=listar");
        exit();
    }

    private static function flash($tipo, $mensaje)
    {
        $_SESSION['flash'] = ['tipo' => $tipo, 'mensaje' => $mensaje];
    }

    // -----------------------------------------------------------------------
    // Valida la cedula contra EMPLEADOS y exige un puesto administrativo.
    // Lee con el paquete PL/SQL: aqui tampoco hay SQL directo.
    // -----------------------------------------------------------------------
    private static function entrar()
    {
        $cedula = isset($_POST['cedula']) ? trim($_POST['cedula']) : '';

        $empleado = null;
        foreach (CrudModel::listar('empleados') as $e) {
            if (isset($e['CEDULA']) && trim($e['CEDULA']) === $cedula) {
                $empleado = $e;
                break;
            }
        }

        if ($empleado === null) {
            $_SESSION['admin_error'] = 'Esa cedula no corresponde a ningun empleado.';
            header('Location: admin.php');
            return;
        }

        if (($empleado['ACTIVO'] ?? 'N') !== 'S') {
            $_SESSION['admin_error'] = 'El empleado esta inactivo.';
            header('Location: admin.php');
            return;
        }

        if (!in_array($empleado['PUESTO_ID'] ?? '', self::PUESTOS_ADMIN, true)) {
            $_SESSION['admin_error'] =
                'Su puesto no tiene acceso al modulo de mantenimientos. '
              . 'Solo Direccion Academica y Coordinacion de Sede.';
            header('Location: admin.php');
            return;
        }

        $_SESSION['admin_id']     = $empleado['EMPLEADO_ID'];
        $_SESSION['admin_nombre'] = $empleado['NOMBRE'] . ' ' . $empleado['APELLIDO_P'];
        $_SESSION['admin_puesto'] = $empleado['PUESTO_ID'];

        header('Location: admin.php?entidad=estudiantes');
    }
}

AdminController::despachar();
