<?php
// Los profesores salen en vivo de Oracle: se leen con
// REALENGLISH.pkg_empleados_crud.listar y se filtran los puestos PROF_*.
require_once __DIR__ . "/../../model/Conexion.php";
require_once __DIR__ . "/../../model/Entidades.php";
require_once __DIR__ . "/../../model/CrudModel.php";

$profes  = [];
$errorBD = null;
try {
    foreach (CrudModel::listar("empleados") as $e) {
        if (stripos($e["PUESTO_ID"] ?? "", "PROF") === 0 && ($e["ACTIVO"] ?? "N") === "S") {
            $profes[] = $e;
        }
    }
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
					<p>Ofrecemos un enfoque innovador para que aprendas inglés a tu ritmo. Elige entre nuestra amplia variedad de cursos certificados MCER y desarrolla habilidades reales para el mundo profesional.</p>
				</div>						
				<div class="row">
<?php if ($errorBD !== null) { ?>
					<div class="col-12"><p style="color:#c0392b;">No se pudo cargar el equipo docente: <?= htmlspecialchars($errorBD) ?></p></div>
<?php } elseif (count($profes) === 0) { ?>
					<div class="col-12"><p>Por el momento no hay profesores publicados.</p></div>
<?php } else { $i = 0; foreach ($profes as $pr) { $i++; ?>
					<div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
						<div class="our-team">
							<div class="team-content">
								<a href="#"><img src="../../assets/img/team/team<?= (($i - 1) % 4) + 1 ?>.jpg" alt="Profesor de Real English CR"></a>
							</div>
							<div class="team-prof">
								<h3><?= htmlspecialchars($pr['NOMBRE'] . ' ' . $pr['APELLIDO_P']) ?></h3>
								<span><?= htmlspecialchars($pr['ESPECIALIDAD'] ?: 'Profesor de Inglés') ?></span>
							</div>
							<div class="sth_det2">
								<span class="ti-medall-alt"> <u>Nivel <?= htmlspecialchars($pr['NIVEL_INGLES'] ?: 'B2') ?></u></span>
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
