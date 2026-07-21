<?php
// layout del modulo admin (encabezado, menu lateral, pie)

require_once __DIR__ . '/../../model/Entidades.php';

function AdminHeader($titulo, $entidadActiva)
{
    $entidades = Entidades::todas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($titulo); ?> - Admin Real English CR</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <style>
        body            { background: #f4f6f9; }
        .sidebar        { min-height: 100vh; background: #1b2a4a; padding-top: 1rem; }
        .sidebar a      { display: block; color: #cdd6e6; padding: .45rem 1.2rem; text-decoration: none; font-size: .95rem; }
        .sidebar a:hover, .sidebar a.activo { background: #27406e; color: #fff; }
        .sidebar .marca { color: #fff; font-weight: bold; padding: 0 1.2rem 1rem; font-size: 1.05rem; }
        .contenido      { padding: 2rem; }
        .tabla-crud th  { white-space: nowrap; }
        .tabla-crud td  { vertical-align: middle; }
    </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block sidebar">
        <div class="marca">Real English CR<br><small>Administraci&oacute;n</small></div>
        <div style="color:#8fa3c8;font-size:.78rem;padding:0 1.2rem .9rem;line-height:1.5;">
            <?= htmlspecialchars($_SESSION['admin_nombre'] ?? '') ?><br>
            <span style="opacity:.7;"><?= htmlspecialchars($_SESSION['admin_puesto'] ?? '') ?></span>
        </div>
        <a href="index.php">&larr; Volver al sitio</a>
        <a href="admin.php?accion=salir">Cerrar sesión</a>
        <hr style="border-color:#33507f">
        <?php foreach ($entidades as $clave => $ent): ?>
            <a href="admin.php?entidad=<?php echo $clave; ?>&accion=listar"
               class="<?php echo $clave === $entidadActiva ? 'activo' : ''; ?>">
                <?php echo htmlspecialchars($ent['titulo']); ?>
            </a>
        <?php endforeach; ?>
    </nav>
    <main class="col-md-10 contenido">
        <?php
        // mensaje flash de la accion anterior
        if (isset($_SESSION['flash'])) {
            $f     = $_SESSION['flash'];
            $clase = $f['tipo'] === 'ok' ? 'alert-success' : 'alert-danger';
            echo '<div class="alert ' . $clase . '">' . htmlspecialchars($f['mensaje']) . '</div>';
            unset($_SESSION['flash']);
        }
        ?>
<?php
}

function AdminFooter()
{
?>
    </main>
  </div>
</div>
<footer class="text-center text-muted py-3">
    <small>SC-504 Lenguajes de Base de Datos &middot; Proyecto Final &middot; Grupo F &middot; Universidad Fid&eacute;litas &middot; 2026</small>
</footer>
</body>
</html>
<?php
}
