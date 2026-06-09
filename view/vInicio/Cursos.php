<?php $titulo_pagina = "Real English CR - Cursos"; include_once '../LayoutExterno.php'; ImportCSS($titulo_pagina); PintarHeader(); ?>

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
					<div class="col-lg-4 col-sm-6 col-xs-12">
						<div class="single_course">
							<div class="single_c_img">
								<img src="../../assets/img/course/1.png" class="img-fluid" alt="course-image" />
								<span>A1 Principiante</span>
							</div>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
							<h4><a href="Cursos.php">Ingles desde Cero A1</a></h4>
							<p><span class="ti-book"> </span> 12 lecciones</p>
							<p><span class="ti-alarm-clock"> </span>72 horas</p>
							<div class="price">Precio: &#8353; 110,000</div>
						</div>
					</div><!-- END COL -->
					<div class="col-lg-4 col-sm-6 col-xs-12">
						<div class="single_course">
							<div class="single_c_img">
								<img src="../../assets/img/course/2.png" class="img-fluid" alt="course-image" />
								<span>A2 Basico</span>
							</div>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
							<h4><a href="Cursos.php">Ingles Intermedio B1 General</a></h4>
							<p><span class="ti-book"> </span> 36 lecciones</p>
							<p><span class="ti-alarm-clock"> </span>84 horas</p>
							<div class="price">Precio: &#8353; 85,000</div>
						</div>
					</div><!-- END COL -->
					<div class="col-lg-4 col-sm-6 col-xs-12">
						<div class="single_course">
							<div class="single_c_img">
								<img src="../../assets/img/course/3.png" class="img-fluid" alt="course-image" />
								<span>Conversacional</span>
							</div>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
							<h4><a href="Cursos.php">Conversacion - Practica Diaria</a></h4>
							<p><span class="ti-book"> </span> 24 lecciones</p>
							<p><span class="ti-alarm-clock"> </span>72 horas</p>
							<div class="price">Precio: Gratis</div>
						</div>
					</div><!-- END COL -->
					<div class="col-lg-4 col-sm-6 col-xs-12">
						<div class="single_course">
							<div class="single_c_img">
								<img src="../../assets/img/course/4.png" class="img-fluid" alt="course-image" />
								<span>B1 Intermedio</span>
							</div>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
							<h4><a href="Cursos.php">Ingles Basico A1-A2</a></h4>
							<p><span class="ti-book"> </span> 18 lecciones</p>
							<p><span class="ti-alarm-clock"> </span>72 horas</p>
							<div class="price">Precio: &#8353; 90,000</div>
						</div>
					</div><!-- END COL -->
					<div class="col-lg-4 col-sm-6 col-xs-12">
						<div class="single_course">
							<div class="single_c_img">
								<img src="../../assets/img/course/5.png" class="img-fluid" alt="course-image" />
								<span>C1 Avanzado</span>
							</div>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
							<h4><a href="Cursos.php">Ingles Conversacional - Practica Real</a></h4>
							<p><span class="ti-book"> </span> 20 lecciones</p>
							<p><span class="ti-alarm-clock"> </span>72 horas</p>
							<div class="price">Precio: &#8353; 95,000</div>
						</div>
					</div><!-- END COL -->
					<div class="col-lg-4 col-sm-6 col-xs-12">
						<div class="single_course">
							<div class="single_c_img">
								<img src="../../assets/img/course/6.png" class="img-fluid" alt="course-image" />
								<span>Negocios</span>
							</div>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
							<h4><a href="Cursos.php">Ingles para Negocios B2</a></h4>
							<p><span class="ti-book"> </span> 16 lecciones</p>
							<p><span class="ti-alarm-clock"> </span>72 horas</p>
							<div class="price">Precio: &#8353; 70,000</div>
						</div>
					</div><!-- END COL -->						
				</div><!--- END ROW -->
			</div><!--- END CONTAINER -->		
		</section>
		<!-- END COURSE -->		
		
<?php PintarFooter(); ImportJS(); ?>
