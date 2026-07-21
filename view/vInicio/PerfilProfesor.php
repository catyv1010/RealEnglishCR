<?php
// Perfil de un profesor por id.
require_once __DIR__ . "/../../model/Catalogo.php";

$id      = isset($_GET['id']) ? preg_replace('/\D/', '', $_GET['id']) : '';
$profe   = null;
$grupos  = [];
$errorBD = null;

try {
    if ($id !== '') {
        $profe = Catalogo::profesor($id);
        // solo profesores activos
        if ($profe && (stripos($profe['PUESTO_ID'] ?? '', 'PROF') !== 0 || ($profe['ACTIVO'] ?? 'N') !== 'S')) {
            $profe = null;
        }
        if ($profe) {
            $grupos = Catalogo::gruposDeProfesor($id);
        }
    }
} catch (Exception $e) {
    $errorBD = $e->getMessage();
}

if ($errorBD === null && $profe === null) {
    header('Location: Profesores.php');
    exit;
}

$nombre = $profe ? trim($profe['NOMBRE'] . ' ' . $profe['APELLIDO_P'] . ' ' . ($profe['APELLIDO_M'] ?? '')) : '';

$titulo_pagina = "Real English CR - " . $nombre;
include_once "../LayoutExterno.php";
ImportCSS($titulo_pagina);
PintarHeader();
?>

		<!-- START SECTION TOP -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
						<h1><?= htmlspecialchars($nombre) ?></h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / <a href="Profesores.php">Profesores</a></li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<!-- END SECTION TOP -->

		<section class="section-padding">
			<div class="container">
<?php if ($errorBD !== null) { ?>
				<p style="color:#c0392b;">No se pudo cargar el perfil: <?= htmlspecialchars($errorBD) ?></p>
<?php } else { ?>
				<div class="row">

					<div class="col-lg-4">
						<img src="<?= Catalogo::imagenProfesor($profe['EMPLEADO_ID']) ?>" class="img-fluid"
						     style="border-radius:10px;width:100%;"
						     alt="<?= htmlspecialchars($nombre) ?>">

						<div style="background:#fff;border:1px solid #e5e8e8;border-radius:10px;padding:24px;margin-top:22px;">
							<p><span class="ti-medall-alt"></span> <b>Nivel de inglés:</b> <?= htmlspecialchars($profe['NIVEL_INGLES'] ?: 'C1') ?></p>
							<p><span class="ti-bookmark"></span> <b>Especialidad:</b> <?= htmlspecialchars($profe['ESPECIALIDAD'] ?: 'Inglés General') ?></p>
							<p><span class="ti-briefcase"></span> <b>Puesto:</b> <?= $profe['PUESTO_ID'] === 'PROF_SR' ? 'Profesor Senior' : 'Profesor Junior' ?></p>
							<p><span class="ti-calendar"></span> <b>En la academia desde:</b> <?= htmlspecialchars(Catalogo::fecha($profe['FECHA_INGRESO'])) ?></p>
							<p><span class="ti-email"></span> <?= htmlspecialchars($profe['CORREO']) ?></p>
<?php if (!empty($profe['TELEFONO'])) { ?>
							<p><span class="ti-mobile"></span> <?= htmlspecialchars($profe['TELEFONO']) ?></p>
<?php } ?>
						</div>
					</div><!-- END COL -->

					<div class="col-lg-8">
						<h3>Sobre <?= htmlspecialchars($profe['NOMBRE']) ?></h3>
						<p>
							<?= htmlspecialchars($profe['NOMBRE'] . ' ' . $profe['APELLIDO_P']) ?> forma parte del equipo docente de
							Real English CR y está certificado en el nivel
							<?= htmlspecialchars($profe['NIVEL_INGLES'] ?: 'C1') ?> del Marco Común Europeo de Referencia.
							Su área de trabajo es <b><?= htmlspecialchars($profe['ESPECIALIDAD'] ?: 'Inglés General') ?></b>,
							y actualmente tiene <?= count($grupos) ?> grupo(s) a cargo.
						</p>

						<h3 style="margin-top:40px;">Grupos a cargo</h3>
<?php if (count($grupos) === 0) { ?>
						<p>Por el momento no tiene grupos asignados.</p>
<?php } else { ?>
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Grupo</th>
									<th>Curso</th>
									<th>Días</th>
									<th>Horario</th>
									<th>Estado</th>
									<th>Cupo</th>
								</tr>
							</thead>
							<tbody>
<?php   foreach ($grupos as $g) { $c = Catalogo::curso($g['CURSO_ID']); ?>
								<tr>
									<td><?= htmlspecialchars($g['CODIGO']) ?></td>
									<td>
<?php     if ($c) { ?>
										<a href="DetalleCurso.php?id=<?= urlencode($c['CURSO_ID']) ?>"><?= htmlspecialchars($c['NOMBRE']) ?></a>
<?php     } else { echo '&mdash;'; } ?>
									</td>
									<td><?= htmlspecialchars($g['DIAS']) ?></td>
									<td><?= htmlspecialchars($g['HORARIO']) ?></td>
									<td><?= htmlspecialchars($g['ESTADO']) ?></td>
									<td><?= htmlspecialchars($g['CUPO_ACTUAL']) ?> / <?= htmlspecialchars($g['CUPO_MAX']) ?></td>
								</tr>
<?php   } ?>
							</tbody>
						</table>
<?php } ?>
					</div><!-- END COL -->

				</div><!--- END ROW -->
<?php } ?>
			</div><!--- END CONTAINER -->
		</section>

<?php PintarFooter(); ImportJS(); ?>
