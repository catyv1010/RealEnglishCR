<?php
// Estadisticas en vivo desde Oracle
require_once __DIR__ . "/../../model/Conexion.php";
require_once __DIR__ . "/../../model/Entidades.php";
require_once __DIR__ . "/../../model/CrudModel.php";
require_once __DIR__ . "/../../model/Catalogo.php";

$nCursos = $nSedes = $nProfes = $nAulas = $nEstudiantes = 0;
$cursosDestacados = [];
$profesDestacados = [];
try {
    $nCursos = count(CrudModel::listar("cursos"));
    $nSedes  = count(CrudModel::listar("sedes"));
    $nAulas  = count(CrudModel::listar("aulas"));

    foreach (CrudModel::listar("estudiantes") as $e) {
        if (($e["ACTIVO"] ?? "N") === "S") { $nEstudiantes++; }
    }
    $profesDestacados = Catalogo::profesores();
    $nProfes          = count($profesDestacados);
    $profesDestacados = array_slice($profesDestacados, 0, 4);

    $cursosDestacados = Catalogo::cursosDestacados(6);
} catch (Exception $e) {
}

$titulo_pagina = "Real English CR - Inicio";
include_once "../LayoutExterno.php";
ImportCSS($titulo_pagina);
PintarHeader();
?>

		<!-- home -->
		<section class="home_bg hb_height" style="background-image: url(../../assets/img/bg/home-bg.jpg);  background-size:cover; background-position: center center;">
			<div class="container">
				<div class="row">
				  <div class="col-lg-6 col-sm-12 col-xs-12">
					<div class="hero-text ht_top">
						<h1>Domina el <span>Inglés</span> con Real English CR</h1>
						<p>Aprende inglés de la manera más efectiva en nuestras cinco sedes en Costa Rica. Cursos certificados MCER de A1 a C2, con profesores nativos y bilingües.</p>
					</div>
					<div class="home_sb">
						<form action="#" class="banner_subs">
							<input type="text" class="form-control home_si" placeholder="Busca tu curso de inglés" required="required">
							<button type="button" class="subscribe__btn">Buscar <i class="fa fa-paper-plane-o"></i></button>
						</form>
					</div>					
				  </div>
				  <div class="col-lg-6 col-sm-12 col-xs-12">
					<div class="hero-text-img">
						<img src="../../assets/img/home-img2.png" class="img-fluid" alt="" />
						<div class="home_ps">
							<span class="ti-user"></span>
							<h2><?= $nEstudiantes ?></h2>
							<p>Estudiantes activos</p>
						</div>
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
							<h2 class="counter-num"><?= $nCursos ?></h2>
							<p>Cursos disponibles</p>
						</div>							
					</div>
					<div class="col-lg-3 col-sm-6 col-xs-12">
						<div class="single-counter">
							<span class="ti-medall-alt sc_two"></span>
							<h2 class="counter-num"><?= $nSedes ?></h2>
							<p>Sedes en Costa Rica</p>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 col-xs-12">
						<div class="single-counter">
							<span class="ti-id-badge sc_three"></span>
							<h2 class="counter-num"><?= $nProfes ?></h2>
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
	
	<!-- category -->
	<section class="top_cat__area section-padding" style="background-image: url(../../assets/img/bg/section-2.jpg);  background-size:cover; background-position: center center;">
		<div class="container">									
			<div class="section-title text-center">
				<h2>Explora nuestras categorías populares</h2>
				<p>Ofrecemos un enfoque innovador para que aprendas inglés a tu ritmo. Elige entre nuestra amplia variedad de cursos certificados MCER y desarrolla habilidades reales para el mundo profesional.</p>
			</div>						
			<div class="row">													
				<div class="col-lg-12 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="cat_list">
						<ul>
							<li><a href="#"><img src="../../assets/img/e1.png" alt="categoria" /> Preparación TOEFL</a></li>
							<li><a href="#"><img src="../../assets/img/e2.png" alt="categoria" /> Inglés Conversacional</a></li>
							<li><a href="#"><img src="../../assets/img/e3.png" alt="categoria" /> Inglés Avanzado C1-C2</a></li>
							<li><a href="#"><img src="../../assets/img/e4.png" alt="categoria" /> Inglés para Negocios</a></li>
							<li><a href="#"><img src="../../assets/img/e5.png" alt="categoria" /> Preparación IELTS</a></li>
							<li><a href="#"><img src="../../assets/img/e6.png" alt="categoria" /> Inglés para Niños</a></li>
							<li><a href="#"><img src="../../assets/img/e7.png" alt="categoria" /> Gramática y Escritura</a></li>
							<li><a href="#"><img src="../../assets/img/e8.png" alt="categoria" /> Pronunciación</a></li>
							<li><a href="#"><img src="../../assets/img/e9.png" alt="categoria" /> Inglés Académico</a></li>
							<li><a href="#"><img src="../../assets/img/e2.png" alt="categoria" /> Inglés Básico A1-A2</a></li>
							<li><a href="#"><img src="../../assets/img/e3.png" alt="categoria" /> Inglés Intermedio B1-B2</a></li>
							<li><a href="#"><img src="../../assets/img/e7.png" alt="categoria" /> Inglés para Viajar</a></li>
						</ul>
					</div>
				</div>							  
			</div>
		</div>
	</section>

		<!-- course -->
		<section class="home_course section-padding">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-sm-6 col-xs-12">
						<div class="section-title">
							<h2>Únete a nuestros <b><?= $nCursos ?></b> cursos <br />certificados MCER.</h2>
						</div>					
					</div>
					<div class="col-lg-4 col-sm-6 col-xs-12">
						<div class="cour_btn">
							<a href="Cursos.php" class="btn_one">Ver todos los cursos <i class="ti-arrow-top-right"></i></a>
						</div>
					</div>
				</div>				
				<div class="row">
<?php if (count($cursosDestacados) === 0) { ?>
					<div class="col-12"><p>Por el momento no hay cursos publicados.</p></div>
<?php } else { foreach ($cursosDestacados as $c) { ?>
					<div class="col-lg-4 col-sm-6 col-xs-12">
						<div class="single_course">
							<div class="single_c_img">
								<img src="<?= Catalogo::imagenCurso($c['CURSO_ID']) ?>" class="img-fluid" alt="<?= htmlspecialchars($c['NOMBRE']) ?>" />
								<span><?= htmlspecialchars(Catalogo::nivelTexto($c['NIVEL_ID'])) ?></span>
							</div>
							<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
							<h4><a href="DetalleCurso.php?id=<?= urlencode($c['CURSO_ID']) ?>"><?= htmlspecialchars($c['NOMBRE']) ?></a></h4>
							<p><span class="ti-book"> </span> <?= htmlspecialchars($c['CODIGO']) ?> &middot; <?= htmlspecialchars($c['MODALIDAD']) ?></p>
							<p><span class="ti-alarm-clock"> </span><?= (int) $c['DURACION_HORAS'] ?> horas</p>
							<div class="price">Precio: <?= Catalogo::colones($c['PRECIO_COLONES']) ?></div>
						</div>
					</div>
<?php } } ?>
				</div>
			</div>		
		</section>
		
		<!-- company partner logo -->
		<div class="partner-logo section-padding">
			<div class="container">
				<div class="row part_bg">
					<div class="col-lg-4 col-sm-4 col-xs-12">
						<div class="partner_title">
							<h3>Ya somos <span><?= $nEstudiantes ?></span> estudiantes activos mejorando el inglés</h3>
						</div>					
					</div>
					<div class="col-lg-8 col-sm-8 col-xs-12 text-center">
						<div class="partner">
							<a href="#"><img src="../../assets/img/clients/1.png" alt="image"></a>
							<a href="#"><img src="../../assets/img/clients/2.png" alt="image"></a>
							<a href="#"><img src="../../assets/img/clients/3.png" alt="image"></a>
							<a href="#"><img src="../../assets/img/clients/4.png" alt="image"></a>
							<a href="#"><img src="../../assets/img/clients/5.png" alt="image"></a>
							<a href="#"><img src="../../assets/img/clients/2.png" alt="image"></a>
							<a href="#"><img src="../../assets/img/clients/1.png" alt="image"></a>
							<a href="#"><img src="../../assets/img/clients/3.png" alt="image"></a>
							<a href="#"><img src="../../assets/img/clients/4.png" alt="image"></a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- video -->
		<section class="vid_area section-padding">
			<div class="container">																
				<div class="row">
					<div class="col-lg-12 vp_top wow fadeInUDown" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
						<div class="video-area" style="background-image: url(../../assets/img/bg/video.jpg);  background-size:cover; background-position: center center;">
							<a href="https://www.youtube.com/watch?v=RXv_uIN6e-Y" class="magnific_popup video-button"><i class="fa fa-play"></i></a>
						</div>
					</div>	
				</div>
			</div>
		</section>
		
		<!-- team -->
		<section class="team_area section-padding">
			<div class="container">									
				<div class="section-title text-center">
					<h2>Conoce a nuestros profesores</h2>
					<p>Ofrecemos un enfoque innovador para que aprendas inglés a tu ritmo. Elige entre nuestra amplia variedad de cursos certificados MCER y desarrolla habilidades reales para el mundo profesional.</p>
				</div>						
				<div class="row">
<?php if (count($profesDestacados) === 0) { ?>
					<div class="col-12"><p>Por el momento no hay profesores publicados.</p></div>
<?php } else { foreach ($profesDestacados as $pr) { ?>
					<div class="col-lg-3 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
						<div class="our-team">
							<div class="team-content">
								<a href="PerfilProfesor.php?id=<?= urlencode($pr['EMPLEADO_ID']) ?>"><img src="<?= Catalogo::imagenProfesor($pr['EMPLEADO_ID']) ?>" alt="<?= htmlspecialchars($pr['NOMBRE'] . ' ' . $pr['APELLIDO_P']) ?>"></a>
							</div>
							<div class="team-prof">
								<h3><?= htmlspecialchars($pr['NOMBRE'] . ' ' . $pr['APELLIDO_P']) ?></h3>
								<span><?= htmlspecialchars($pr['ESPECIALIDAD'] ?: 'Profesor de Inglés') ?></span>
							</div>
							<div class="sth_det2">
								<span class="ti-medall-alt"> <u>Nivel <?= htmlspecialchars($pr['NIVEL_INGLES'] ?: 'B2') ?></u></span>
								<span class="ti-user"> <u><?= count(Catalogo::gruposDeProfesor($pr['EMPLEADO_ID'])) ?> grupos</u></span>
							</div>
						</div>
					</div>
<?php } } ?>
				</div>
			</div>
		</section>

	<!-- promo -->
	<section class="ab_area section-padding">
		<div class="container">									
			<div class="row">													
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="ab_content">
						<h2>Por qué elegir Real English CR</h2>
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
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="ab_img">
						<img src="../../assets/img/about3.png" class="img-fluid" alt="image">
						<div class="home_ps2">
							<span class="ti-book"></span>
							<h2><?= $nCursos ?></h2>
							<p>Cursos en línea</p>
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
					<div class="col-lg-6 col-sm-12 col-xs-12">
						<div class="ab_img">
							<img src="../../assets/img/review.png" class="img-fluid" alt="image">
						</div>					
					</div>						
					<div class="col-lg-6 col-sm-12 col-xs-12">
						<div id="testimonial-slider" class="owl-carousel">
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

		<!-- blog -->
		<section id="blog" class="blog_area section-padding">
			<div class="container">
				<div class="section-title text-center">
					<h2>Últimas noticias del blog</h2>
					<p>Ofrecemos un enfoque innovador para que aprendas inglés a tu ritmo. Elige entre nuestra amplia variedad de cursos certificados MCER y desarrolla habilidades reales para el mundo profesional.</p>
				</div>	
				<div class="row">		
					<div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
						<div class="single_blog">
							<img src="../../assets/img/blog/1.jpg" class="img-fluid" alt="image" />
							<div class="content_box">
								<span>10 de mayo de 2024 | <a href="Blog.php">A1 Principiante</a></span>
								<h2><a href="Blog.php">5 consejos para mejorar tu pronunciación en inglés</a></h2>
								<a class="btn_one" href="Blog.php">Leer más <i class="ti-arrow-top-right"></i></a>
							</div>
						</div>
					</div>				
					<div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
						<div class="single_blog">
							<img src="../../assets/img/blog/2.jpg" class="img-fluid" alt="image" />
							<div class="content_box">
								<span>16 de mayo de 2024 | <a href="Blog.php">A1 Principiante</a></span>
								<h2><a href="Blog.php">Cómo prepararte para el examen TOEFL</a></h2>
								<a class="btn_one" href="Blog.php">Leer más <i class="ti-arrow-top-right"></i></a>							
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<div class="single_blog">
							<img src="../../assets/img/blog/3.jpg" class="img-fluid" alt="image" />
							<div class="content_box">
								<span>18 de mayo de 2024 | <a href="Blog.php">Consejos</a></span>
								<h2><a href="Blog.php">Educamos a los líderes del mañana, hoy </a></h2>
								<a class="btn_one" href="Blog.php">Leer más <i class="ti-arrow-top-right"></i></a>
							</div>
						</div>
					</div>						
				</div>
			</div>
		</section>	
		
<?php PintarFooter(); ImportJS(); ?>
