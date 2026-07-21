<?php
// Contadores en vivo desde Oracle
require_once __DIR__ . "/../../model/Conexion.php";
require_once __DIR__ . "/../../model/Entidades.php";
require_once __DIR__ . "/../../model/CrudModel.php";
require_once __DIR__ . "/../../model/Catalogo.php";

$cont = ['cursos' => 0, 'sedes' => 0, 'profesores' => 0, 'estudiantes' => 0];
$nAulas = 0;
try {
    $cont   = Catalogo::contadores();
    $nAulas = count(CrudModel::listar("aulas"));
} catch (Exception $e) {
}

$titulo_pagina = "Real English CR - Acerca de";
include_once "../LayoutExterno.php";
ImportCSS($titulo_pagina);
PintarHeader();
?>

		<!-- section top -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h1>Acerca de</h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / Acerca de</li>
						</ul>
					</div>
				</div>
			</div>
		</section>	
		
	<!-- category -->
	<section class="top_cat__area section-padding" style="background-image: url(../../assets/img/bg/shape-1.png);  background-size:cover; background-position: center center;">
		<div class="container">									
			<div class="section-title text-center">
				<h2>Comienza tu viaje con nosotros</h2>
				<p>Ofrecemos un enfoque innovador para que aprendas inglés a tu ritmo. Elige entre nuestra amplia variedad de cursos certificados MCER y desarrolla habilidades reales para el mundo profesional.</p>
			</div>						
			<div class="row">					
				<div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="single_tp">
						<span class="sc_one">01</span>
						<h3>Profesores <br />Expertos</h3>
						<p>Cursos diseñados para que aprendas inglés a tu ritmo, con metodología probada y profesores expertos.</p>
					</div>
				</div>			
				<div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
					<div class="single_tp">
						<span class="sc_two">02</span>
						<h3>Educación <br />de Calidad</h3>
						<p>Cursos diseñados para que aprendas inglés a tu ritmo, con metodología probada y profesores expertos.</p>
					</div>
				</div>			
				<div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
					<div class="single_tp">
						<span class="sc_three">03</span>
						<h3>Aprendizaje <br />Remoto</h3>
						<p>Cursos diseñados para que aprendas inglés a tu ritmo, con metodología probada y profesores expertos.</p>
					</div>
				</div>	
				<div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
					<div class="single_tp">
						<span class="sc_four">04</span>
						<h3>Soporte <br />Permanente</h3>
						<p>Cursos diseñados para que aprendas inglés a tu ritmo, con metodología probada y profesores expertos.</p>
					</div>
				</div>							
			</div>
		</div>
	</section>
		
	<!-- about us -->
	<section class="ab_area section-padding">
		<div class="container">									
			<div class="row">								
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="ab_img">
						<img src="../../assets/img/about1.png" class="img-fluid" alt="image">
					</div>
				</div>						
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="ab_content">
						<h2>Ofrecemos cursos de inglés en cinco sedes en Costa Rica</h2>
						<p>Ofrecemos un enfoque innovador para que aprendas inglés a tu ritmo. Elige entre nuestra amplia variedad de cursos certificados MCER y desarrolla habilidades reales para el mundo profesional.</p>
						<p>Ofrecemos un enfoque innovador para que aprendas inglés a tu ritmo. Elige entre nuestra amplia variedad de cursos certificados MCER y desarrolla habilidades reales para el mundo profesional.</p>
						<ul>
							<li><span class="ti-check"></span> Accede a <b>+12</b> cursos especializados certificados</li>
							<li><span class="ti-check"></span> Temas populares para todos los niveles MCER</li>
							<li><span class="ti-check"></span> Encuentra el profesor ideal para ti</li>
						</ul>
						<a class="btn_one" href="Cursos.php">Ver todos los cursos <i class="ti-arrow-top-right"></i></a>
					</div>
				</div>							  
			</div>
		</div>
	</section>
	
		<!-- video -->
		<section class="vid_area va2" style="background-image: url(../../assets/img/bg/video.jpg);  background-size:cover; background-position: center center;">
			<div class="container">																
				<div class="row">
					<div class="col-lg-12 vp_top wow fadeInUDown" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
						<div class="video-area2">
						</div>
					</div>	
				</div>
			</div>
		</section>

		<!-- counter -->
		<section class="count_area counter_feature">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-sm-6 col-xs-12">
						<div class="single-counter">
							<span class="ti-folder sc_one"></span>
							<h2 class="counter-num"><?= $cont['cursos'] ?></h2>
							<p>Cursos disponibles</p>
						</div>							
					</div>
					<div class="col-lg-3 col-sm-6 col-xs-12">
						<div class="single-counter">
							<span class="ti-medall-alt sc_two"></span>
							<h2 class="counter-num"><?= $cont['sedes'] ?></h2>
							<p>Sedes en Costa Rica</p>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 col-xs-12">
						<div class="single-counter">
							<span class="ti-id-badge sc_three"></span>
							<h2 class="counter-num"><?= $cont['profesores'] ?></h2>
							<p>Profesores certificados</p>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 col-xs-12">
						<div class="single-counter">
							<span class="ti-user sc_four"></span>
							<h2 class="counter-num"><?= $nAulas ?></h2>
							<p>Aulas equipadas</p>
						</div>
					</div>						
				</div>
			</div>		
		</section>

	<!-- instructor+free course -->
	<section class="insfreecourse section-padding">
		<div class="container">									
			<div class="row">								
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="single_ins" style="background-image: url(../../assets/img/ins1.png);  background-size:cover; background-position: center center;">
						<div class="single_ins_content">
							<h4>Crece con nosotros</h4>
							<h1>Trabaja como Profesor</h1>
							<p>Aprende a tu ritmo, avanza entre distintos cursos. </p>
							<a class="btn_one" href="#">Aplicar ahora <i class="ti-arrow-top-right"></i></a>
						</div>
					</div>
				</div>				
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="single_ins" style="background-image: url(../../assets/img/ins2.png);  background-size:cover; background-position: center center;">
						<div class="single_ins_content">
							<h4>Crece con nosotros</h4>
							<h1>Cursos disponibles</h1>
							<p>Aprende a tu ritmo, avanza entre distintos cursos. </p>
							<a class="btn_one" href="#">Contáctanos <i class="ti-arrow-top-right"></i></a>
						</div>
					</div>
				</div>								  
			</div>
		</div>
	</section>

		<!-- testimonials -->
		<section class="testi_area section-padding">
			<div class="container">
				<div class="section-title">
					<h2>Lo que dicen nuestros estudiantes</h2>
				</div>						
				<div class="row">					
					<div class="col-lg-12 col-sm-12 col-xs-12">
						<div id="testimonial-slider2" class="owl-carousel">
							<div class="testimonial">
								<img src="../../assets/img/quote.png" alt="" />
								<div class="testimonial_content">													
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<p>Llegué sin saber nada y hoy sostengo reuniones en inglés con clientes de afuera. Lo que más me sirvió fue que en cada clase hay que hablar, no solo escuchar al profesor.</p>
								</div>
								<div class="testi_pic_title">
									<img src="../../assets/img/testimonial/1.png" alt="">
									<h4>Andrés Fonseca</h4>
									<p>Estudiante de Inglés para Negocios</p>
								</div>
							</div>
							<div class="testimonial">
							<img src="../../assets/img/quote.png" alt="" />
								<div class="testimonial_content">													
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<p>Hice el TOEFL después de dos niveles acá y saqué el puntaje que necesitaba para la beca. La preparación se enfoca justo en lo que evalúa el examen.</p>
								</div>
								<div class="testi_pic_title">
									<img src="../../assets/img/testimonial/2.png" alt="">
									<h4>Sofía Castro</h4>
									<p>Estudiante de Preparación TOEFL</p>
								</div>
							</div>
							<div class="testimonial">
								<img src="../../assets/img/quote.png" alt="" />
								<div class="testimonial_content">													
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<p>Matriculé a mi hija de nueve años y llega feliz de cada clase. Aprenden jugando y ya me corrige la pronunciación a mí.</p>
								</div>
								<div class="testi_pic_title">
									<img src="../../assets/img/testimonial/3.png" alt="">
									<h4>Marcela Jiménez</h4>
									<p>Madre de estudiante del programa Kids</p>
								</div>
							</div>
							<div class="testimonial">
								<img src="../../assets/img/quote.png" alt="" />
								<div class="testimonial_content">													
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<p>Llevo el curso virtual porque trabajo por turnos. Las clases son en vivo con el profesor, no videos grabados, y esa diferencia se nota.</p>
								</div>
								<div class="testi_pic_title">
									<img src="../../assets/img/testimonial/4.png" alt="">
									<h4>Diego Hidalgo</h4>
									<p>Estudiante de Inglés Virtual B2</p>
								</div>
							</div>
							<div class="testimonial">
								<img src="../../assets/img/quote.png" alt="" />
								<div class="testimonial_content">													
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<i class="ti-star"></i>
									<p>Ya hablaba algo, pero me trababa. El curso de conversación me quitó el miedo a equivocarme, que era lo que de verdad me frenaba.</p>
								</div>
								<div class="testi_pic_title">
									<img src="../../assets/img/testimonial/5.png" alt="">
									<h4>Laura Brenes</h4>
									<p>Estudiante de Inglés Conversacional</p>
								</div>
							</div>
						</div>
					</div>		
				</div>
			</div>		
		</section>
		
<?php PintarFooter(); ImportJS(); ?>
