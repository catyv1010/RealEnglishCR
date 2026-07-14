<?php
// Catalogo de cursos leido en vivo desde Oracle.
// Catalogo::cursos() -> CrudModel -> REALENGLISH.pkg_cursos_crud.listar
// Nunca hay un SELECT directo en la vista.
//
// La portada de cada curso se deriva de su CURSO_ID (curso_<id>.png), no de su
// posicion en la lista. Antes se usaba (($i-1) % 6) + 1 y, como solo habia 6
// imagenes, el curso 7 mostraba la foto del curso 1.
require_once __DIR__ . "/../../model/Catalogo.php";

$cursos  = [];
$errorBD = null;
try {
    $cursos = Catalogo::cursos();
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
						<h1>Catálogo de Cursos</h1>
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
<?php } else { foreach ($cursos as $c) {
        $id      = $c['CURSO_ID'];
        $url     = 'DetalleCurso.php?id=' . urlencode($id);
        $abiertos = count(Catalogo::gruposDeCurso($id));
?>
					<div class="col-lg-4 col-sm-6 col-xs-12">
						<div class="single_course">
							<div class="single_c_img">
								<a href="<?= $url ?>">
									<img src="<?= Catalogo::imagenCurso($id) ?>" class="img-fluid"
									     alt="<?= htmlspecialchars($c['NOMBRE']) ?>" />
								</a>
								<span><?= htmlspecialchars(Catalogo::nivelTexto($c['NIVEL_ID'])) ?></span>
							</div>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
							<h4><a href="<?= $url ?>"><?= htmlspecialchars($c['NOMBRE']) ?></a></h4>
							<p><span class="ti-book"> </span> <?= htmlspecialchars($c['CODIGO']) ?> &middot; <?= htmlspecialchars($c['MODALIDAD']) ?></p>
							<p><span class="ti-alarm-clock"> </span><?= htmlspecialchars($c['DURACION_HORAS']) ?> horas
<?php if ($abiertos > 0) { ?>
								&middot; <b style="color:#1e8449;"><?= $abiertos ?> grupo<?= $abiertos == 1 ? '' : 's' ?> abierto<?= $abiertos == 1 ? '' : 's' ?></b>
<?php } else { ?>
								&middot; <span style="color:#909497;">sin grupos abiertos</span>
<?php } ?>
							</p>
							<div class="price">Precio: <?= Catalogo::colones($c['PRECIO_COLONES']) ?></div>
						</div>
					</div><!-- END COL -->
<?php } } ?>
				</div><!--- END ROW -->
			</div><!--- END CONTAINER -->
		</section>
		<!-- END COURSE -->

<?php PintarFooter(); ImportJS(); ?>
