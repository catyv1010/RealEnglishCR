<?php $titulo_pagina = "Real English CR - Contacto"; include_once '../LayoutExterno.php'; ImportCSS($titulo_pagina); PintarHeader(); ?>

		<!-- START SECTION TOP -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h1>Contactanos</h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / Contacto</li>
						</ul>
					</div><!-- //.HERO-TEXT -->
				</div><!--- END COL -->
			</div><!--- END CONTAINER -->
		</section>	
		<!-- END SECTION TOP -->
		
		<!-- START ADDRESS -->
		<section class="address_area section-padding">
			<div class="container">
				<div class="row text-center">
					<div class="col-lg-4 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
						<div class="single_address sa_one">
							<i class="ti-map"></i>
							<h4>Nuestra Ubicación</h4>
							<p>Avenida Central, Calle 5, Edificio Plaza <br />San Jose, Costa Rica</p>
						</div>
					</div><!-- END COL -->
					<div class="col-lg-4 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
						<div class="single_address sa_two">
							<i class="ti-mobile"></i>
							<h4>Teléfono</h4>
							<p>+506 2222-1010</p>
							<p>+506 8888-2020</p>
						</div>
					</div><!-- END COL -->
					<div class="col-lg-4 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<div class="single_address sa_three">
							<i class="ti-email"></i>
							<h4>Escribenos</h4>
							<p>info@realenglishcr.com</p>
							<p>admisiones@realenglishcr.com</p>
						</div>
					</div><!-- END COL -->			  
				</div><!--- END ROW -->
			</div><!--- END CONTAINER -->
		</section>
		<!-- END ADDRESS -->	

		<!-- CONTACT -->
		<div id="contact" class="contact_area section-padding">
			<div class="container">			
				<div class="row">					
					<div class="col-lg-7 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">		
						<div class="contact">
							<form class="form" name="enq" method="POST" action="../../control/InicioController.php" onsubmit="return validation();">
								<div class="row">
									<div class="form-group col-md-6">
										<label for="">Nombre</label>
										<input type="text" name="name" class="form-control" required="required">
									</div>
									<div class="form-group col-md-6">
										<label for="">Tu correo electrónico</label>
										<input type="email" name="email" class="form-control" required="required">
									</div>
									<div class="form-group col-md-12">
										<label for="">Asunto</label>
										<input type="text" name="subject" class="form-control" required="required">
									</div>
									<div class="form-group col-md-12">
										<label for="">Tu mensaje</label>
										<textarea rows="6" name="message" class="form-control" required="required"></textarea>
									</div>
									<div class="col-md-12 text-center">
										<button type="submit" value="Enviar mensaje" name="btnContacto" id="submitButton" class="btn_one" title="Enviar tu mensaje!">Enviar mensaje</button>
									</div>
								</div>
							</form>
						</div>
					</div><!-- END COL  -->
					<div class="col-lg-5 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">		<div class="map">
							<iframe src="https://www.google.com/maps?q=San%20Jos%C3%A9,%20Costa%20Rica&output=embed" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
						</div>					
					</div><!-- END COL  -->				
				</div><!-- END ROW -->				
			</div><!--- END CONTAINER -->
		</div>
		<!-- END CONTACT -->
		
<?php PintarFooter(); ImportJS(); ?>
