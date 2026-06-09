<?php $titulo_pagina = "Real English CR - Iniciar Sesion"; include_once '../LayoutExterno.php'; ImportCSS($titulo_pagina); PintarHeader(); ?>


		<!-- START SECTION TOP -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h1>Iniciar Sesion</h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / Iniciar Sesion</li>
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
								<p style="color:#777;">Ingresa tus credenciales para acceder al sistema</p>
							</div>
							<form action="../../control/InicioController.php" method="POST">
								<div class="form-group mb-3">
									<label for="correo">Correo electronico</label>
									<input type="email" name="correo" id="correo" class="form-control" placeholder="usuario@realenglishcr.com" required>
								</div>
								<div class="form-group mb-3">
									<label for="contrasena">Contrasena</label>
									<input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Tu contrasena" required>
								</div>
								<div class="form-group mb-3 d-flex justify-content-between align-items-center">
									<div>
										<input type="checkbox" name="recordar" id="recordar">
										<label for="recordar" style="margin-left:5px;font-weight:normal;">Recordarme</label>
									</div>
									<a href="#" style="font-size:14px;">Olvide mi contrasena</a>
								</div>
								<div class="form-group mb-3">
									<label for="tipo_usuario">Tipo de usuario</label>
									<select name="tipo_usuario" id="tipo_usuario" class="form-control" required>
										<option value="">-- Selecciona --</option>
										<option value="estudiante">Estudiante</option>
										<option value="profesor">Profesor</option>
										<option value="administrativo">Personal Administrativo</option>
										<option value="admin">Administrador del Sistema</option>
									</select>
								</div>
								<button type="submit" name="btnLogin" class="btn_one w-100" style="width:100%;">Iniciar Sesion</button>
								<p class="text-center mt-3" style="margin-top:20px;">
									Eres nuevo? <a href="RegistrarUsuarios.php"><strong>Registrate aqui</strong></a>
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- END LOGIN -->
<?php PintarFooter(); ImportJS(); ?>
