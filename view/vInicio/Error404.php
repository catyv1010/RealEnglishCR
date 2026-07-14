<?php $titulo_pagina = "Real English CR - Pagina no encontrada"; include_once '../LayoutExterno.php'; ImportCSS($titulo_pagina); PintarHeader(); ?>

		<!-- START SECTION TOP -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h1>Página no encontrada</h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / 404</li>
						</ul>
					</div><!-- //.HERO-TEXT -->
				</div><!--- END COL -->
			</div><!--- END CONTAINER -->
		</section>	
		<!-- END SECTION TOP -->
		
	<!-- START 404 -->
	<section class="zero_area section-padding">
		<div class="container">
			<div class="row">
			  <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
					<div class="error_page">
						<img src="../../assets/img/404.svg" class="img-fluid" alt="404 error" />
						<h2>Ups! Página no encontrada</h2>
						<p>No encontramos la página que buscas. Revisa la dirección o volve al inicio.</p>
						<div class="home_btn">
							<a href="Principal.php" class="btn_one">Volver al inicio</a>
						</div>	
					</div>
			  </div><!--- END COL -->				  
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END 404 -->	
		
<?php PintarFooter(); ImportJS(); ?>
