<?php $titulo_pagina = "Real English CR - Perfil del Profesor"; include_once '../LayoutExterno.php'; ImportCSS($titulo_pagina); PintarHeader(); ?>

		<!-- START SECTION TOP -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h1>Perfil Profesor</h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / Perfil Profesor</li>
						</ul>
					</div><!-- //.HERO-TEXT -->
				</div><!--- END COL -->
			</div><!--- END CONTAINER -->
		</section>	
		<!-- END SECTION TOP -->
		
	<!-- START AGENT PROFILE -->
	<section class="template_agent section-padding">
		<div class="container">
			<div class="row">
			  <div class="col-lg-12 col-sm-12 col-xs-12">
					<div class="single_agent">
						<div class="single_agent_image">
							<img src="../../assets/img/team/team1.jpg" class="img-fluid" alt=""/>
						</div>
						<div class="single_agent_content">
							<h4>Laura Jimenez</h4>
							<h5>Coordinadora Academica</h5>
							<p>Profesora de ingles con mas de diez anos de experiencia. Le gusta ensenar con ejemplos de la vida diaria y acompanar a cada estudiante segun su nivel. Especialista en preparacion de examenes IELTS y TOEFL.</p>
							<ul>
								<li><i class="fa fa-envelope-o"></i>laura.jimenez@realenglishcr.com</li>
								<li><i class="fa fa-phone"></i>+506 2222-1010</li>
								<li><i class="fa fa-plane"></i>www.realenglishcr.com</li>
								<li><i class="fa fa-skype"></i>realenglishcr</li>
							</ul>
						</div>
						<div class="agent_social">
							<ul class="list-inline">
								<li><a href="#" class="top_f_facebook"><img src="../../assets/img/fb.svg" alt="" /></a></li>
								<li><a href="#" class="top_f_facebook"><img src="../../assets/img/pn.svg" alt="" /></a></li>
								<li><a href="#" class="top_f_facebook"><img src="../../assets/img/ins.svg" alt="" /></a></li>
							</ul>
						</div>
					</div><!--- END SINGLE ITEM -->		
			  </div><!--- END COL -->				  
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->		
	</section>
	<!-- END AGENT PROFILE -->	
		
<?php PintarFooter(); ImportJS(); ?>
