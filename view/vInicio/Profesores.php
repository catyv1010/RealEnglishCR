<?php
// Los profesores salen en vivo de Oracle: Catalogo::profesores() llama a
// REALENGLISH.pkg_empleados_crud.listar y se queda con los empleados activos
// cuyo puesto empieza por PROF.
//
// La foto YA NO se escoge por la posicion en la lista (antes era
// team<?= $i % 4 ?>.jpg, y con 15 profesores las mismas 4 caras se repetian
// una y otra vez). Ahora cada empleado tiene su propia imagen, prof_<id>.png,
// derivada de su EMPLEADO_ID: nunca se repite y no se corre si se borra a otro.
require_once __DIR__ . "/../../model/Catalogo.php";

$profes  = [];
$errorBD = null;
try {
    $profes = Catalogo::profesores();
} catch (Exception $ex) {
    $errorBD = $ex->getMessage();
}

$titulo_pagina = "Real English CR - Profesores";
include_once "../LayoutExterno.php";
ImportCSS($titulo_pagina);
PintarHeader();
?>

		<!-- START SECTION TOP -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h1>Nuestros Profesores</h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / Profesores</li>
						</ul>
					</div><!-- //.HERO-TEXT -->
				</div><!--- END COL -->
			</div><!--- END CONTAINER -->
		</section>
		<!-- END SECTION TOP -->

		<!-- START TEAM -->
		<section class="team_area section-padding">
			<div class="container">
				<div class="section-title text-center">
					<h2>Conoce a nuestros profesores</h2>
					<p>Todo nuestro equipo docente está certificado en el nivel C1 o C2 del Marco Común Europeo. Cada profesor tiene una especialidad: negocios, conversación, preparación de exámenes internacionales o inglés para niños.</p>
				</div>
				<div class="row">
<?php if ($errorBD !== null) { ?>
					<div class="col-12"><p style="color:#c0392b;">No se pudo cargar el equipo docente: <?= htmlspecialchars($errorBD) ?></p></div>
<?php } elseif (count($profes) === 0) { ?>
					<div class="col-12"><p>Por el momento no hay profesores publicados.</p></div>
<?php } else { foreach ($profes as $pr) {
        $id  = $pr['EMPLEADO_ID'];
        $url = 'PerfilProfesor.php?id=' . urlencode($id);
?>
					<div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
						<div class="our-team">
							<div class="team-content">
								<a href="<?= $url ?>">
									<img src="<?= Catalogo::imagenProfesor($id) ?>"
									     alt="<?= htmlspecialchars($pr['NOMBRE'] . ' ' . $pr['APELLIDO_P']) ?>, profesor de Real English CR">
								</a>
							</div>
							<div class="team-prof">
								<h3><a href="<?= $url ?>"><?= htmlspecialchars($pr['NOMBRE'] . ' ' . $pr['APELLIDO_P']) ?></a></h3>
								<span><?= htmlspecialchars($pr['ESPECIALIDAD'] ?: 'Inglés General') ?></span>
							</div>
							<div class="sth_det2">
								<span class="ti-medall-alt"> <u>Nivel <?= htmlspecialchars($pr['NIVEL_INGLES'] ?: 'C1') ?></u></span>
								<span class="ti-email"> <u><?= htmlspecialchars($pr['CORREO']) ?></u></span>
							</div>
						</div>
					</div><!-- END COL -->
<?php } } ?>
				</div><!--- END ROW -->
			</div><!--- END CONTAINER -->
		</section>
		<!-- END TEAM -->

<?php PintarFooter(); ImportJS(); ?>
