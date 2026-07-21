<?php
// listado generico ($entidad, $def, $filas)

require_once __DIR__ . '/LayoutAdmin.php';
AdminHeader($def['titulo'], $entidad);

$pk = strtoupper($def['pk']);
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0"><?php echo htmlspecialchars($def['titulo']); ?></h3>
    <a class="btn btn-primary" href="admin.php?entidad=<?php echo $entidad; ?>&accion=nuevo">
        + Agregar
    </a>
</div>

<?php if (count($filas) === 0): ?>
    <div class="alert alert-info">No hay registros todav&iacute;a. Us&aacute; el bot&oacute;n <b>+ Agregar</b>.</div>
<?php else: ?>
<div class="table-responsive">
<table class="table table-sm table-striped table-hover bg-white tabla-crud">
    <thead class="thead-dark">
        <tr>
            <th><?php echo $pk; ?></th>
            <?php foreach ($def['campos'] as $campo => $cfg): ?>
                <th><?php echo htmlspecialchars($cfg['etiqueta']); ?></th>
            <?php endforeach; ?>
            <th style="width:130px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($filas as $fila): ?>
        <tr>
            <td><b><?php echo htmlspecialchars($fila[$pk]); ?></b></td>
            <?php foreach ($def['campos'] as $campo => $cfg):
                $valor = isset($fila[strtoupper($campo)]) ? $fila[strtoupper($campo)] : ''; ?>
                <td><?php echo htmlspecialchars(mb_strimwidth((string)$valor, 0, 40, '...')); ?></td>
            <?php endforeach; ?>
            <td>
                <a class="btn btn-sm btn-outline-secondary"
                   href="admin.php?entidad=<?php echo $entidad; ?>&accion=editar&id=<?php echo urlencode($fila[$pk]); ?>">
                   Editar
                </a>
                <form method="post" style="display:inline"
                      action="admin.php?entidad=<?php echo $entidad; ?>&accion=eliminar"
                      onsubmit="return confirm('¿Seguro que quiere eliminar el registro <?php echo htmlspecialchars($fila[$pk]); ?>?');">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($fila[$pk]); ?>">
                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<p class="text-muted"><small>Total: <?php echo count($filas); ?> registros
(datos le&iacute;dos con <code><?php echo $def['paquete']; ?>.listar</code>)</small></p>
<?php endif; ?>

<?php AdminFooter(); ?>
