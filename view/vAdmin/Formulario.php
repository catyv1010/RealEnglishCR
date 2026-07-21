<?php
// formulario generico (crear / editar): $entidad, $def, $registro, $opcionesFk

require_once __DIR__ . '/LayoutAdmin.php';

$esEdicion = ($registro !== null);
$pk        = $def['pk'];
$pkUpper   = strtoupper($pk);
$titulo    = ($esEdicion ? 'Editar ' : 'Agregar ') . $def['titulo'];
$accion    = $esEdicion ? 'actualizar' : 'crear';

AdminHeader($titulo, $entidad);

// valor actual del campo (para precargar en edicion)
function valorCampo($registro, $campo)
{
    if ($registro === null) { return ''; }
    $u = strtoupper($campo);
    return isset($registro[$u]) && $registro[$u] !== null ? $registro[$u] : '';
}
?>
<h3><?php echo htmlspecialchars($titulo); ?></h3>
<p class="text-muted"><small>
    Este formulario llama al procedimiento
    <code><?php echo $def['paquete'] . '.' . ($esEdicion ? 'actualizar' : 'insertar'); ?></code>
    (no se usan consultas directas).
</small></p>

<form method="post" action="admin.php?entidad=<?php echo $entidad; ?>&accion=<?php echo $accion; ?>" class="bg-white p-4 rounded shadow-sm" style="max-width:720px">

    <?php if ($esEdicion): ?>
        <div class="form-group">
            <label><?php echo $pkUpper; ?> (no se puede cambiar)</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($registro[$pkUpper]); ?>" disabled>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($registro[$pkUpper]); ?>">
        </div>
    <?php elseif (!empty($def['pk_manual'])): ?>
        <div class="form-group">
            <label><?php echo $pkUpper; ?> *</label>
            <input type="text" name="<?php echo $pk; ?>" class="form-control" required
                   placeholder="Ej.: PROF_ING" maxlength="10">
        </div>
    <?php endif; ?>

    <?php foreach ($def['campos'] as $campo => $cfg):
        $valor = valorCampo($registro, $campo);
        $req   = $cfg['requerido'] ? 'required' : ''; ?>
        <div class="form-group">
            <label><?php echo htmlspecialchars($cfg['etiqueta']); ?><?php echo $cfg['requerido'] ? ' *' : ''; ?></label>

            <?php if ($cfg['tipo'] === 'select'): ?>
                <select name="<?php echo $campo; ?>" class="form-control" <?php echo $req; ?>>
                    <option value="">-- Seleccione --</option>
                    <?php foreach ($cfg['opciones'] as $op): ?>
                        <option value="<?php echo $op; ?>" <?php echo ((string)$valor === (string)$op) ? 'selected' : ''; ?>>
                            <?php echo $op; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            <?php elseif ($cfg['tipo'] === 'fk'): ?>
                <select name="<?php echo $campo; ?>" class="form-control" <?php echo $req; ?>>
                    <option value="">-- Seleccione --</option>
                    <?php foreach ($opcionesFk[$campo] as $val => $texto): ?>
                        <option value="<?php echo htmlspecialchars($val); ?>" <?php echo ((string)$valor === (string)$val) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($val . ' - ' . $texto); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            <?php elseif ($cfg['tipo'] === 'fecha'): ?>
                <input type="date" name="<?php echo $campo; ?>" class="form-control"
                       value="<?php echo htmlspecialchars($valor); ?>" <?php echo $req; ?>>

            <?php elseif ($cfg['tipo'] === 'numero'): ?>
                <input type="number" name="<?php echo $campo; ?>" class="form-control"
                       value="<?php echo htmlspecialchars($valor); ?>" <?php echo $req; ?>>

            <?php elseif ($cfg['tipo'] === 'decimal'): ?>
                <input type="number" step="0.01" name="<?php echo $campo; ?>" class="form-control"
                       value="<?php echo htmlspecialchars($valor); ?>" <?php echo $req; ?>>

            <?php elseif ($cfg['tipo'] === 'textarea'): ?>
                <textarea name="<?php echo $campo; ?>" class="form-control" rows="2"><?php echo htmlspecialchars($valor); ?></textarea>

            <?php else: /* texto */ ?>
                <input type="text" name="<?php echo $campo; ?>" class="form-control"
                       value="<?php echo htmlspecialchars($valor); ?>" <?php echo $req; ?>>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <button type="submit" class="btn btn-primary">
        <?php echo $esEdicion ? 'Guardar cambios' : 'Crear registro'; ?>
    </button>
    <a class="btn btn-secondary" href="admin.php?entidad=<?php echo $entidad; ?>&accion=listar">Cancelar</a>
</form>

<?php AdminFooter(); ?>
