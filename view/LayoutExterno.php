<?php
// Layout externo de Real English CR
// Aqui pongo todo lo que se repite en las paginas: el head con los CSS,
// el menu de arriba, el footer y los scripts. Asi no lo copio en cada vista.
// Las rutas estan pensadas para las vistas que viven en view/vInicio,
// por eso todo apunta a ../../assets
//
// CAMBIOS DE ESTA VERSION (y por que):
//  1. El logo se llamaba logo.svg en el HTML, pero el archivo que existe en
//     assets/img es logo.png. Se veia la imagen rota en TODAS las paginas.
//  2. El header ahora sabe si hay sesion: si el estudiante ya entro, en vez de
//     "Iniciar Sesion / Registrarse" se muestra su nombre, "Mis matriculas"
//     y "Salir". Antes uno iniciaba sesion y el menu seguia igualito.
//  3. Se quitaron del menu "Detalle Curso" y "Perfil Profesor": esas paginas
//     ahora necesitan un ?id= y sin el no tienen nada que mostrar. Se entra a
//     ellas desde Cursos.php y Profesores.php.
//  4. El footer ya no tiene links muertos (href="#") y los "Cursos Populares"
//     salen de Oracle, no escritos a mano.

// La sesion se abre aqui, ANTES de que se imprima el primer byte de HTML.
// Si se abriera despues, PHP tira el aviso "headers already sent".
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// El footer necesita consultar los cursos reales.
require_once __DIR__ . '/../model/Catalogo.php';

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
		<link rel="stylesheet" href="../../assets/css/style.css?v=3">
	</head>

	<body data-spy="scroll" data-offset="80">
';
}

// menu de arriba (preloader + logo + nav + menu movil)
function PintarHeader()
{
    // ¿Hay alguien con la sesion abierta? El controlador guarda estudiante_id
    // y nombre cuando el login sale bien (ver control/InicioController.php).
    $hayEstudiante = isset($_SESSION['estudiante_id']);
    $nombre        = htmlspecialchars($_SESSION['nombre'] ?? '');

    if ($hayEstudiante) {
        // Sesion iniciada: saludo + acceso a sus matriculas + salir.
        // El "salir" apunta al controlador, que hace session_destroy().
        $bloqueSesion = '
						<span class="header-btn" style="cursor:default;">Hola, ' . $nombre . '</span>
						<a href="Carrito.php" class="header-btn">Mis matrículas</a>
						<a href="../../control/InicioController.php?salir=1" class="btn_one">Salir</a>';

        $bloqueSesionMovil = '
						<li><a href="Carrito.php">Mis matrículas (' . $nombre . ')</a></li>
						<li><a href="../../control/InicioController.php?salir=1">Salir</a></li>';
    } else {
        // Visitante anonimo: los dos botones de siempre.
        $bloqueSesion = '
						<a href="IniciarSesion.php" class="header-btn">Iniciar Sesión</a>
						<a href="RegistrarUsuarios.php" class="btn_one">Registrarse</a>';

        $bloqueSesionMovil = '
						<li><a href="IniciarSesion.php">Iniciar Sesión</a></li>
						<li><a href="RegistrarUsuarios.php">Registrarse</a></li>';
    }

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
							<a href="Principal.php"><img src="../../assets/img/logo.svg" alt="Real English CR"></a>
						</div>
					</div><!--- END Col -->

					<div class="col-60 d-flex">
						<nav id="main-menu">
							<ul>
								<li><a href="Principal.php">Inicio</a></li>
								<li><a href="AcercaDe.php">Acerca de</a></li>
								<li><a href="Cursos.php">Cursos</a></li>
								<li><a href="Precios.php">Precios</a></li>
								<li class="menu-item-has-children"><a href="#">Páginas</a>
									<ul>
										<li><a href="Profesores.php">Profesores</a></li>
										<li><a href="Preguntas.php">Preguntas</a></li>
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

					<div class="col-20 d-none d-xl-block text-end align-self-center">{$bloqueSesion}
					</div><!--- END Col -->

					<ul class="mobile_menu">
						<li><a href="Principal.php">Inicio</a></li>
						<li><a href="AcercaDe.php">Acerca de</a></li>
						<li><a href="Cursos.php">Cursos</a></li>
						<li><a href="Precios.php">Precios</a></li>
						<li><a href="#">Páginas</a>
							<ul class="sub-menu">
								<li><a href="Profesores.php">Profesores</a></li>
								<li><a href="Preguntas.php">Preguntas</a></li>
							</ul>
						</li>
						<li><a href="Blog.php">Blog</a>
							<ul class="sub-menu">
								<li><a href="Blog.php">Blog</a></li>
								<li><a href="DetalleBlog.php">Detalle Blog</a></li>
							</ul>
						</li>
						<li><a href="Contacto.php">Contacto</a></li>{$bloqueSesionMovil}
					</ul>
				</div><!--- END ROW -->
			</div><!--- END CONTAINER -->
		</div>
		<!-- END NAVBAR -->
HTML;
}

// pie de página
function PintarFooter()
{
    // "Cursos Populares" ya no esta escrito a mano. Se pide a Oracle igual que
    // en el resto del sitio (Catalogo -> CrudModel -> pkg_cursos_crud.listar).
    //
    // El try/catch NO es adorno: el footer se pinta en las 15 paginas. Si la
    // base esta caida y esto reventara, se caeria el sitio entero. Asi, en el
    // peor caso la columna sale vacia y lo demas sigue funcionando.
    $cursosPopulares = [];
    try {
        $cursosPopulares = Catalogo::cursosDestacados(6);
    } catch (Exception $ex) {
        $cursosPopulares = [];
    }

    $itemsCursos = '';
    foreach ($cursosPopulares as $c) {
        $url    = 'DetalleCurso.php?id=' . urlencode($c['CURSO_ID']);
        $nombre = htmlspecialchars($c['NOMBRE'] ?? '');
        $itemsCursos .= "\n\t\t\t\t\t\t\t\t<li><a href=\"{$url}\">{$nombre}</a></li>";
    }
    if ($itemsCursos === '') {
        $itemsCursos = "\n\t\t\t\t\t\t\t\t<li><a href=\"Cursos.php\">Ver el catálogo completo</a></li>";
    }

    echo <<<HTML
		<!-- START FOOTER -->
		<div class="footer section-padding">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-sm-6 col-xs-12">
						<div class="single_footer">
							<a href="Principal.php"><img src="../../assets/img/logo.svg" alt="Real English CR"></a>
							<p>Academia de inglés con presencia en cinco sedes en Costa Rica. Certificación MCER A1 a C2.</p>
							<div class="social_profile">
								<ul>
									<!-- Los iconos venian cruzados en la plantilla: la clase f_facebook
									     tenia el icono de X y f_twitter el de Facebook. Ya coinciden. -->
									<li><a class="f_facebook" href="https://www.facebook.com" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a></li>
									<li><a class="f_twitter" href="https://x.com" target="_blank" rel="noopener"><i class="fa-brands fa-x-twitter"></i></a></li>
									<li><a class="f_instagram" href="https://www.instagram.com" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a></li>
									<li><a class="f_linkedin" href="https://www.linkedin.com" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in"></i></a></li>
								</ul>
							</div>
						</div>
					</div><!--- END COL -->
					<div class="col-lg-2 col-sm-6 col-xs-12">
						<div class="single_footer">
							<h4>Acerca de Real English CR</h4>
							<!-- Antes los seis enlaces eran href="#" y no llevaban a ningun lado.
							     Ahora cada uno apunta a una pagina que si existe. -->
							<ul>
								<li><a href="AcercaDe.php">Sobre Nosotros</a></li>
								<li><a href="Profesores.php">Nuestros Profesores</a></li>
								<li><a href="Contacto.php">Trabaja con Nosotros</a></li>
								<li><a href="Cursos.php">Catálogo de Cursos</a></li>
								<li><a href="Preguntas.php">Preguntas Frecuentes</a></li>
								<li><a href="Contacto.php">Contáctanos</a></li>
							</ul>
						</div>
					</div><!--- END COL -->
					<div class="col-lg-2 col-sm-6 col-xs-12">
						<div class="single_footer">
							<h4>Cursos Populares</h4>
							<ul>{$itemsCursos}
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
								<!-- El tel: traia el numero de la plantilla original (+8845...).
								     Ahora es el telefono real de la sede central. -->
								<p><a href="tel:+50622221010">Whatsapp</a></p>
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
							<a href="Principal.php"><img src="../../assets/img/google-play.jpg" class="foot_img" alt="Google Play"></a>
							<a href="Principal.php"><img src="../../assets/img/app-store.jpg" class="foot_img" alt="App Store"></a>
						</div>
					</div><!--- END COL -->
				</div><!--- END ROW -->
			</div><!--- END CONTAINER -->
		</div>
		<!-- END FOOTER -->

		<!-- START FOOTER COPYRIGHT -->
		<div class="foot_copy">
			<div class="footer_copyright">
				<p>&copy; 2026. Real English CR &middot; Proyecto académico SC-504 - Grupo F - Universidad Fidelitas</p>
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
