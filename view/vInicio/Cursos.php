<?php
// Cursos leidos en vivo desde Oracle. La consulta pasa por
// REALENGLISH.pkg_cursos_crud.listar (nunca un SELECT directo).
require_once __DIR__ . "/../../model/Conexion.php";
require_once __DIR__ . "/../../model/Entidades.php";
require_once __DIR__ . "/../../model/CrudModel.php";

$cursos  = [];
$errorBD = null;
try {
    $cursos  = CrudModel::listar("cursos");
    $niveles = [];
    foreach (CrudModel::listar("niveles") as $n) {
        $niveles[$n["NIVEL_ID"]] = $n["CODIGO"] . " " . $n["NOMBRE"];
    }
} catch (Exception $e) {
    $errorBD = $e->getMessage();
}

$titulo_pagina = "Real English CR - Cursos";
include_once "../LayoutExterno.php";
ImportCSS($titulo_pagina);
PintarHeader();
?>

		<!-- START SECTION TOP -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h1>Catalogo de Cursos</h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / Cursos</li>
						</ul>
					</div><!-- //.HERO-TEXT -->
				</div><!--- END COL -->
			</div><!--- END CONTAINER -->
		</section>	
		<!-- END SECTION TOP -->
		
		<!-- START COURSE -->
		<section class="home_course section-padding">
			<div class="container">			
				<div class="row">
<?php if ($errorBD !== null) { ?>
					<div class="col-12">
						<p style="color:#c0392b;">No se pudieron cargar los cursos: <?= htmlspecialchars($errorBD) ?></p>
					</div>
<?php } elseif (count($cursos) === 0) { ?>
					<div class="col-12">
						<p>Por el momento no hay cursos publicados.</p>
					</div>
<?php } else { $i = 0; foreach ($cursos as $c) { $i++; ?>
					<div class="col-lg-4 col-sm-6 col-xs-12">
						<div class="single_course">
							<div class="single_c_img">
								<img src="../../assets/img/course/<?= (($i - 1) % 6) + 1 ?>.png" class="img-fluid" alt="course-image" />
								<span><?= htmlspecialchars($niveles[$c['NIVEL_ID']] ?? 'Nivel ' . $c['NIVEL_ID']) ?></span>
							</div>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
							<h4><a href="Cursos.php"><?= htmlspecialchars($c['NOMBRE']) ?></a></h4>
							<p><span class="ti-book"> </span> <?= htmlspecialchars($c['CODIGO']) ?> &middot; <?= htmlspecialchars($c['MODALIDAD']) ?></p>
							<p><span class="ti-alarm-clock"> </span><?= htmlspecialchars($c['DURACION_HORAS']) ?> horas</p>
							<div class="price">Precio: &#8353; <?= number_format((float) $c['PRECIO_COLONES'], 0, ',', '.') ?></div>
						</div>
					</div><!-- END COL -->
<?php } } ?>
				</div><!--- END ROW -->
			</div><!--- END CONTAINER -->		
		</section>
		<!-- END COURSE -->		
		
<?php PintarFooter(); ImportJS(); ?>
