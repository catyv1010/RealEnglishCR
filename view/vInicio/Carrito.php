<?php
// Mis matriculas: las del estudiante con sesion abierta
require_once __DIR__ . "/../../model/Conexion.php";
require_once __DIR__ . "/../../model/Entidades.php";
require_once __DIR__ . "/../../model/CrudModel.php";
require_once __DIR__ . "/../../model/Catalogo.php";

session_start();

// requiere sesion
if (!isset($_SESSION['estudiante_id'])) {
    header('Location: IniciarSesion.php');
    exit();
}

$misMatriculas = [];
$errorBD       = null;

try {
    $yo = (string) $_SESSION['estudiante_id'];

    // pagos indexados por matricula
    $pagosPorMatricula = [];
    foreach (CrudModel::listar('pagos') as $p) {
        $pagosPorMatricula[(string) $p['MATRICULA_ID']] = $p;
    }

    foreach (CrudModel::listar('matriculas') as $m) {
        if ((string) $m['ESTUDIANTE_ID'] !== $yo) {
            continue;
        }

        $grupo = Catalogo::grupo($m['GRUPO_ID']);
        $curso = $grupo ? Catalogo::curso($grupo['CURSO_ID']) : null;
        $clave = (string) $m['MATRICULA_ID'];

        $misMatriculas[] = [
            'matricula' => $m,
            'grupo'     => $grupo,
            'curso'     => $curso,
            'pago'      => isset($pagosPorMatricula[$clave]) ? $pagosPorMatricula[$clave] : null,
        ];
    }
} catch (Exception $e) {
    $errorBD = $e->getMessage();
}

$titulo_pagina = "Real English CR - Mis matriculas";
include_once "../LayoutExterno.php";
ImportCSS($titulo_pagina);
PintarHeader();
?>

		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title">
						<h1>Mis Matrículas</h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / Mis matrículas</li>
						</ul>
					</div>
				</div>
			</div>
		</section>

		<section class="section-padding">
			<div class="container">

<?php if ($errorBD !== null) { ?>
				<p style="color:#c0392b;">No se pudieron cargar tus matrículas: <?= htmlspecialchars($errorBD) ?></p>

<?php } elseif (count($misMatriculas) === 0) { ?>
				<div style="background:#fff;border:1px solid #e5e8e8;border-radius:12px;padding:50px;text-align:center;">
					<h3 style="margin-top:0;">Todavía no tenés matrículas</h3>
					<p style="color:#7f8c8d;">Elegí un curso del catálogo y matriculate en el grupo que mejor te calce.</p>
					<a class="btn_one" href="Cursos.php">Ver los cursos</a>
				</div>

<?php } else { ?>
				<div class="table-responsive" style="background:#fff;border:1px solid #e5e8e8;border-radius:12px;padding:24px;">
					<table class="table align-middle">
						<thead>
							<tr>
								<th>Curso</th>
								<th>Grupo</th>
								<th>Estado</th>
								<th>Monto</th>
								<th>Pago</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
<?php foreach ($misMatriculas as $fila) {
          $m     = $fila['matricula'];
          $grupo = $fila['grupo'];
          $curso = $fila['curso'];
          $pago  = $fila['pago'];
?>
							<tr>
								<td>
									<b><?= htmlspecialchars($curso['NOMBRE'] ?? 'Curso') ?></b><br>
									<span style="color:#7f8c8d;font-size:13px;">
										<?= htmlspecialchars($curso['CODIGO'] ?? '') ?> &middot;
										<?= htmlspecialchars($curso['MODALIDAD'] ?? '') ?>
									</span>
								</td>
								<td><?= htmlspecialchars($grupo['CODIGO'] ?? '-') ?></td>
								<td><?= htmlspecialchars($m['ESTADO']) ?></td>
								<td><?= $curso ? Catalogo::colones($curso['PRECIO_COLONES']) : '-' ?></td>
								<td>
<?php     if ($pago === null) { ?>
									<span style="color:#c0392b;">Sin registrar</span>
<?php     } else { ?>
									<?= htmlspecialchars($pago['ESTADO']) ?>
<?php     } ?>
								</td>
								<td>
<?php     if ($pago !== null && $pago['ESTADO'] === 'PAGADO') { ?>
									<a class="btn btn-sm btn-outline-secondary" href="Gracias.php?pago=<?= urlencode($pago['PAGO_ID']) ?>">Ver comprobante</a>
<?php     } else { ?>
									<a class="btn btn-sm btn-primary" href="Pagar.php?matricula=<?= urlencode($m['MATRICULA_ID']) ?>">Pagar</a>
<?php     } ?>
								</td>
							</tr>
<?php } ?>
						</tbody>
					</table>
				</div>
<?php } ?>

			</div>
		</section>

<?php PintarFooter(); ImportJS(); ?>
