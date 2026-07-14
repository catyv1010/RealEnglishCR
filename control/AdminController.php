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
    public static function despachar()
    {
        $entidad = isset($_GET['entidad']) ? $_GET['entidad'] : 'estudiantes';
        $accion  = isset($_GET['accion'])  ? $_GET['accion']  : 'listar';

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
                    $registro = CrudModel::obtener($entidad, $_GET['id']);
                    if ($registro === null) {
                        self::flash('error', 'No se encontro el registro.');
                        self::redirigir($entidad);
                    }
                    self::vistaFormulario($entidad, $def, $registro);
                    break;

                case 'actualizar': // POST del formulario -> pkg.actualizar
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        CrudModel::actualizar($entidad, $_POST['id'], $_POST);
                        self::flash('ok', 'Registro actualizado correctamente.');
                    }
                    self::redirigir($entidad);
                    break;

                case 'eliminar':   // POST (con confirmacion) -> pkg.eliminar
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
}

AdminController::despachar();
