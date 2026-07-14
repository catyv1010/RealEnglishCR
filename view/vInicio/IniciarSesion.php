<?php $titulo_pagina = "Real English CR - Iniciar Sesion"; include_once '../LayoutExterno.php'; ImportCSS($titulo_pagina); PintarHeader(); ?>


		<!-- START SECTION TOP -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h1>Iniciar Sesión</h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / Iniciar Sesión</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<!-- END SECTION TOP -->

		<!-- START LOGIN -->
		<section class="login_area section-padding">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-md-8 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
						<div class="login-form" style="background:#fff;padding:50px 40px;border-radius:10px;box-shadow:0 0 30px rgba(0,0,0,0.05);">
							<div class="text-center mb-4">
								<h3 style="margin-bottom:10px;">Bienvenido a Real English CR</h3>
								<p style="color:#777;">Ingresa tu número de cédula para acceder al sistema</p>
							</div>
							<form action="../../control/InicioController.php" method="POST">
									<div class="form-group mb-3">
										<label for="cedula">Número de cédula</label>
										<input type="text" name="cedula" id="cedula" class="form-control" placeholder="1-1234-5678" pattern="[18]-[0-9]{4}-[0-9]{4}" required>
										<small style="color:#777;">La cédula con la que te registraste, con guiones.</small>
									</div>
								<button type="submit" name="btnLogin" class="btn_one w-100" style="width:100%;">Iniciar Sesión</button>
								<p class="text-center mt-3" style="margin-top:20px;">
									Eres nuevo? <a href="RegistrarUsuarios.php"><strong>Registrate aquí</strong></a>
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- END LOGIN -->
<?php PintarFooter(); ImportJS(); ?>
