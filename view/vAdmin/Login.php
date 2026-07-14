<?php
// SC-504 - Real English CR - Grupo F
// Pantalla de acceso al modulo de mantenimientos.
//
// Al modulo de administracion solo entran los empleados con puesto de
// Director Academico (DIR_ACAD) o Coordinador de Sede (COORD). La validacion
// se hace contra la tabla EMPLEADOS, igual que todo lo demas: leyendo con
// REALENGLISH.pkg_empleados_crud.listar, nunca con un SELECT directo.
//
// Se identifica con la cedula, por la misma razon que el login de estudiantes:
// el modelo de datos no tiene columna de contrasena.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso administrativo - Real English CR</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <style>
        body  { background: #f2f5fa; font-family: Arial, sans-serif; }
        .caja { max-width: 420px; margin: 90px auto; background: #fff; padding: 40px;
                border-radius: 10px; box-shadow: 0 0 30px rgba(0,0,0,.07); }
        h1    { color: #1b2a4a; font-size: 1.35rem; margin-bottom: 4px; }
        .sub  { color: #7b8794; font-size: .9rem; margin-bottom: 26px; }
        .err  { background: #fdecea; color: #c0392b; padding: 10px 14px;
                border-radius: 6px; font-size: .9rem; margin-bottom: 18px; }
        .pie  { text-align: center; margin-top: 22px; font-size: .85rem; }
    </style>
</head>
<body>
    <div class="caja">
        <h1>Panel de administración</h1>
        <p class="sub">Real English CR &middot; acceso restringido al personal</p>

        <?php if (!empty($error)) { ?>
            <div class="err"><?= htmlspecialchars($error) ?></div>
        <?php } ?>

        <form action="admin.php?accion=entrar" method="POST">
            <div class="mb-3">
                <label for="cedula" class="form-label">Cédula del empleado</label>
                <input type="text" name="cedula" id="cedula" class="form-control"
                       placeholder="1-1234-5678" pattern="[18]-[0-9]{4}-[0-9]{4}" required autofocus>
                <div class="form-text">
                    Solo Dirección Académica y Coordinación de Sede.
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>

        <p class="pie"><a href="view/vInicio/Principal.php">&larr; Volver al sitio</a></p>
    </div>
</body>
</html>
