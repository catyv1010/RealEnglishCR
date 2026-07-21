<?php
// Precios por nivel MCER, calculados desde el catalogo real
require_once __DIR__ . "/../../model/Catalogo.php";

$niveles   = [];
$porNivel  = [];
$errorBD   = null;

try {
    $niveles = Catalogo::niveles();

    foreach (Catalogo::cursos() as $c) {
        $nid    = $c['NIVEL_ID'];
        $precio = (float) $c['PRECIO_COLONES'];

        if (!isset($porNivel[$nid])) {
            $porNivel[$nid] = ['cursos' => [], 'min' => $precio, 'max' => $precio, 'grupos' => 0];
        }

        $porNivel[$nid]['cursos'][] = $c;
        $porNivel[$nid]['min']      = min($porNivel[$nid]['min'], $precio);
        $porNivel[$nid]['max']      = max($porNivel[$nid]['max'], $precio);
        // solo grupos abiertos
        $porNivel[$nid]['grupos'] += count(Catalogo::gruposDeCurso($c['CURSO_ID']));
    }

    // ordenar por nivel (A1..C2)
    uksort($porNivel, function ($a, $b) use ($niveles) {
        $oa = isset($niveles[$a]['ORDEN']) ? (int) $niveles[$a]['ORDEN'] : (int) $a;
        $ob = isset($niveles[$b]['ORDEN']) ? (int) $niveles[$b]['ORDEN'] : (int) $b;
        return $oa <=> $ob;
    });

} catch (Exception $ex) {
    $errorBD = $ex->getMessage();
}

$titulo_pagina = "Real English CR - Precios";
include_once "../LayoutExterno.php";
ImportCSS($titulo_pagina);
PintarHeader();
?>

		<!-- section top -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h1>Precios</h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / Precios</li>
						</ul>
					</div>
				</div>
			</div>
		</section>

		<!-- pricing -->
		<section id="pricing" class="pricing-content section-padding">
			<div class="container">
				<div class="section-title text-center">
					<h2>Cuánto cuesta cada nivel</h2>
					<p>Estos precios salen directamente de nuestro catálogo: son los mismos que ves al matricularte. El monto depende del curso, no de un paquete cerrado.</p>
				</div>

				<div class="row text-center">
<?php if ($errorBD !== null) { ?>
					<div class="col-12">
						<p style="color:#c0392b;">No se pudieron cargar los precios en este momento: <?= htmlspecialchars($errorBD) ?></p>
					</div>
<?php } elseif (count($porNivel) === 0) { ?>
					<div class="col-12">
						<p>Todavía no hay cursos publicados con precio.</p>
					</div>
<?php } else {
        $i = 0;
        foreach ($porNivel as $nid => $datos) {
            $i++;
            $codigo  = Catalogo::nivelCodigo($nid);
            $nombre  = $niveles[$nid]['NOMBRE'] ?? ('Nivel ' . $nid);
            $desc    = $niveles[$nid]['DESCRIPCION'] ?? '';
            $nCursos = count($datos['cursos']);
            $delay   = 0.1 * (($i - 1) % 3 + 1);
            // destacar el nivel con mas grupos abiertos
            $esDestacado = ($datos['grupos'] > 0 && $datos['grupos'] === max(array_column($porNivel, 'grupos')));
?>
					<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="<?= $delay ?>s" data-wow-offset="0" style="margin-bottom:30px;">
						<div class="single-pricing<?= $esDestacado ? ' single-pricing-white' : '' ?>">
							<div class="price-head">
								<h2><?= htmlspecialchars($codigo . ' ' . $nombre) ?></h2>
								<span></span>
								<span></span>
								<span></span>
								<span></span>
								<span></span>
								<span></span>
							</div>
<?php if ($esDestacado) { ?>
							<span class="price-label">Más grupos abiertos</span>
<?php } ?>
							<h1 class="price"><?= Catalogo::colones($datos['min']) ?></h1>
							<h5>
<?php if ($datos['min'] == $datos['max']) { ?>
								precio único del nivel
<?php } else { ?>
								desde &middot; hasta <?= Catalogo::colones($datos['max']) ?>
<?php } ?>
							</h5>
							<ul>
								<li><?= $nCursos ?> curso<?= $nCursos == 1 ? '' : 's' ?> en este nivel</li>
								<li>
<?php if ($datos['grupos'] > 0) { ?>
									<?= $datos['grupos'] ?> grupo<?= $datos['grupos'] == 1 ? '' : 's' ?> con matrícula abierta
<?php } else { ?>
									Sin grupos abiertos por ahora
<?php } ?>
								</li>
								<li>Certificación MCER <?= htmlspecialchars($codigo) ?></li>
								<li>Material de estudio incluido</li>
								<li>Profesor certificado C1 o C2</li>
<?php if ($desc !== '') { ?>
								<li><?= htmlspecialchars($desc) ?></li>
<?php } ?>
							</ul>
							<a class="btn_one" href="Cursos.php">Ver los cursos <?= htmlspecialchars($codigo) ?></a>
						</div>
					</div>
<?php   }
    } ?>
				</div>

				<div class="row">
					<div class="col-12 text-center" style="margin-top:20px;">
						<p style="color:#777;">El pago se genera al matricularte y podés cancelarlo con SINPE Móvil, transferencia, tarjeta o en efectivo en cualquiera de nuestras sedes.</p>
					</div>
				</div>
			</div>
		</section>

<?php PintarFooter(); ImportJS(); ?>
