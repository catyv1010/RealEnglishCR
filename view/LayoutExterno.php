<?php
// Layout externo de Real English CR
// Aqui pongo todo lo que se repite en las paginas: el head con los CSS,
// el menu de arriba, el footer y los scripts. Asi no lo copio en cada vista.
// Las rutas estan pensadas para las vistas que viven en view/vInicio,
// por eso todo apunta a ../../assets

// head con los estilos, abre el body
function ImportCSS($titulo = 'Real English CR')
{
    echo '<!DOCTYPE html>
<html lang="es">

	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="Real English CR - Academia de Ingles">
		<meta name="keywords" content="ingles, academia, cursos, costa rica, MCER, real english cr">
		<!-- SITE TITLE -->
		<title>' . htmlspecialchars($titulo) . '</title>
		<!-- Latest Bootstrap min CSS -->
		<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
		<!-- Font Awesome CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
		<link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
		<link rel="stylesheet" href="../../assets/fonts/themify-icons.css">
		<!--- owl carousel Css-->
		<link rel="stylesheet" href="../../assets/owlcarousel/css/owl.carousel.css">
		<link rel="stylesheet" href="../../assets/owlcarousel/css/owl.theme.css">
		<!--jquery-simple-mobilemenu Css-->
		<link rel="stylesheet" href="../../assets/css/jquery-simple-mobilemenu.css">
		<!-- MAGNIFIC CSS -->
		<link rel="stylesheet" href="../../assets/css/magnific-popup.css">
		<!-- animate CSS -->
		<link rel="stylesheet" href="../../assets/css/animate.css">
		<!-- Style CSS -->
		<link rel="stylesheet" href="../../assets/css/style.css">
	</head>

	<body data-spy="scroll" data-offset="80">
';
}

// menu de arriba (preloader + logo + nav + menu movil)
function PintarHeader()
{
    echo <<<HTML

		<!-- START PRELOADER -->
		<div class="preloaders">
			<span class="loader"></span>
		</div>
		<!-- END PRELOADER -->		

		<!-- START NAVBAR -->  
		<div id="navigation" class="navbar-light bg-faded site-navigation">
			<div class="container-fluid">
				<div class="row">
					<div class="col-20 align-self-center">
						<div class="site-logo">
							<a href="Principal.php"><img src="../../assets/img/logo.svg" alt=""></a>          				
						</div>
					</div><!--- END Col -->
					
					<div class="col-60 d-flex">
						<nav id="main-menu">
							<ul>
								<li class="menu-item-has-children"><a href="#">Inicio</a>
									<ul>										
										<li><a href="Principal.php">Inicio</a></li>
										<li><a href="PrincipalV2.php">Inicio (v2)</a></li>
									</ul>
								</li>
								<li><a href="AcercaDe.php">Acerca de</a></li>				  				  
								<li class="menu-item-has-children"><a href="Cursos.php">Cursos</a>
									<ul>										
										<li><a href="Cursos.php">Cursos</a></li>
										<li><a href="DetalleCurso.php">Detalle Curso</a></li>
									</ul>
								</li>								
								<li class="menu-item-has-children"><a href="#">Paginas</a>
									<ul>										
										<li><a href="Profesores.php">Profesores</a></li>
										<li><a href="PerfilProfesor.php">Perfil Profesor</a></li>
										<li><a href="Precios.php">Precios</a></li>
										<li><a href="Preguntas.php">Preguntas</a></li>			
										<li><a href="Error404.php">404</a></li>				
									</ul>
								</li>							
								<li class="menu-item-has-children"><a href="Blog.php">Blog</a>
									<ul>										
										<li><a href="Blog.php">Blog</a></li>
										<li><a href="DetalleBlog.php">Detalle Blog</a></li>
									</ul>
								</li>							  
								<li><a href="Contacto.php">Contacto</a></li>
							</ul>
						</nav>
					</div><!--- END Col -->
					
					<div class="col-20 d-none d-xl-block text-end align-self-center">
						<a href="IniciarSesion.php" class="header-btn">Iniciar Sesion</a>
						<a href="RegistrarUsuarios.php" class="btn_one">Registrarse</a>
					</div><!--- END Col -->
					
					<ul class="mobile_menu">						
						<li><a href="#">Inicio</a>
							<ul class="sub-menu">										
								<li><a href="Principal.php">Inicio</a></li>
								<li><a href="PrincipalV2.php">Inicio (v2)</a></li>						
							</ul>
						</li>	
						<li><a href="AcercaDe.php">Acerca de</a></li>						
						<li><a href="#">Cursos</a>
							<ul class="sub-menu">										
								<li><a href="Cursos.php">Cursos</a></li>
								<li><a href="DetalleCurso.php">Detalle Curso</a></li>									
							</ul>
						</li>
						<li><a href="#">Paginas</a>
							<ul class="sub-menu">									
								<li><a href="Profesores.php">Profesores</a></li>
								<li><a href="PerfilProfesor.php">Perfil Profesor</a></li>
								<li><a href="Precios.php">Precios</a></li>
								<li><a href="Preguntas.php">Preguntas</a></li>			
								<li><a href="Error404.php">404</a></li>							
							</ul>
						</li>			
						<li><a href="Blog.php">Blog</a>
							<ul class="sub-menu">										
								<li><a href="Blog.php">Blog</a></li>
								<li><a href="DetalleBlog.php">Detalle Blog</a></li>
							</ul>
						</li>						
						<li><a href="Contacto.php">Contacto</a></li>
					</ul>			
				</div><!--- END ROW -->
			</div><!--- END CONTAINER -->
		</div> 	  
		<!-- END NAVBAR -->		
HTML;
}

// pie de pagina
function PintarFooter()
{
    echo <<<HTML
		<!-- START FOOTER -->
		<div class="footer section-padding">
			<div class="container">				
				<div class="row">						
					<div class="col-lg-3 col-sm-6 col-xs-12">
						<div class="single_footer">
							<a href="Principal.php"><img src="../../assets/img/logo.svg" alt=""></a>         
							<p>Academia de ingles con presencia en cinco sedes en Costa Rica. Certificacion MCER A1 a C2.</p>
							<div class="social_profile">
								<ul>
									<li><a class="f_facebook" href="#"><i class="fa-solid fa-x"></i></a></li>
									<li><a class="f_twitter" href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
									<li><a class="f_instagram"href="#"><i class="fa-brands fa-instagram"></i></a></li>
									<li><a class="f_linkedin" href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
								</ul>
							</div>
						</div>			
					</div><!--- END COL -->						
					<div class="col-lg-2 col-sm-6 col-xs-12">
						<div class="single_footer">
							<h4>Acerca de Real English CR</h4>
							<ul>
								<li><a href="#">Sobre Nosotros</a></li>
								<li><a href="#">Registro de Profesores</a></li>
								<li><a href="#">Trabaja con Nosotros</a></li>
								<li><a href="#">Nuestros Profesores</a></li>
								<li><a href="#">Preguntas Frecuentes</a></li>
								<li><a href="#">Contactanos</a></li>
							</ul>
						</div>
					</div><!--- END COL -->	
					<div class="col-lg-2 col-sm-6 col-xs-12">
						<div class="single_footer">
							<h4>Cursos Populares</h4>
							<ul>
								<li><a href="#">Ingles Basico A1-A2</a></li>
								<li><a href="#">Ingles Intermedio B1-B2</a></li>
								<li><a href="#">Ingles Avanzado C1-C2</a></li>
								<li><a href="#">Ingles para Negocios</a></li>
								<li><a href="#">Preparacion IELTS</a></li>						
								<li><a href="#">Preparacion TOEFL</a></li>						
							</ul>
						</div>
					</div><!--- END COL -->
					<div class="col-lg-3 col-sm-6 col-xs-12">
						<div class="single_footer">
							<h4>Contacto</h4>
							<div class="sf_contact">
								<span class="ti-map"></span>
								<p>Avenida Central, San Jose, Costa Rica</p>
							</div>
							<div class="sf_contact">
								<span class="ti-mobile"></span>
								<p>+506 2222-1010</p>
							</div>
							<div class="sf_contact">
								<span class="ti-mobile"></span>
								<p><a href="tel:+88457845695">Whatsapp</a></p>
							</div>
							<div class="sf_contact">
								<span class="ti-email"></span>
								<p>info@realenglishcr.com</p>
							</div>
						</div>
					</div><!--- END COL -->						
					<div class="col-lg-2 col-sm-6 col-xs-12">
						<div class="single_footer">
							<h4>Descarga Nuestra App</h4>
							<p>Pronto disponible para iOS y Android.</p>
							<a href="Principal.php"><img src="../../assets/img/google-play.jpg" class="foot_img" alt=""></a>  
							<a href="Principal.php"><img src="../../assets/img/app-store.jpg" class="foot_img" alt=""></a>  
						</div>
					</div><!--- END COL -->	
				</div><!--- END ROW -->					
			</div><!--- END CONTAINER -->
		</div>
		<!-- END FOOTER -->	

		<!-- START FOOTER COPYRIGHT -->	
		<div class="foot_copy">
			<div class="footer_copyright">
				<p>&copy; 2026. Real English CR &middot; Proyecto academico SC-504 - Grupo F - Universidad Fidelitas</p>
			</div>	
		</div>
		<!-- END FOOTER COPYRIGHT -->	
HTML;
}

// scripts y cierre del html
function ImportJS()
{
    echo <<<HTML
	
	<!-- Latest jQuery -->
		<script src="../../assets/js/jquery-1.12.4.min.js"></script>
	<!-- Latest compiled and minified Bootstrap -->
		<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- modernizer JS -->		
		<script src="../../assets/js/modernizr-2.8.3.min.js"></script>	
	<!-- jquery-simple-mobilemenu.min -->
		<script src="../../assets/js/jquery-simple-mobilemenu.js"></script>		
	<!-- owl-carousel min js  -->
		<script src="../../assets/owlcarousel/js/owl.carousel.min.js"></script>					
	<!-- magnific-popup js -->               
		<script src="../../assets/js/jquery.magnific-popup.min.js"></script>						
	<!-- countTo js -->
		<script src="../../assets/js/jquery.inview.min.js"></script>								
	<!-- scrolltopcontrol js -->
		<script src="../../assets/js/scrolltopcontrol.js"></script>			
	<!-- WOW - Reveal Animations When You Scroll -->
		<script src="../../assets/js/wow.min.js"></script>				
	<!-- scripts js -->
		<script src="../../assets/js/scripts.js"></script>
HTML;
    echo '
    </body>
</html>';
}
