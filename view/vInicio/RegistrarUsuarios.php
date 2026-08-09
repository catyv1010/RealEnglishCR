<?php $titulo_pagina = "Real English CR - Registrarse"; include_once '../LayoutExterno.php'; ImportCSS($titulo_pagina); PintarHeader(); ?>


		<!-- START SECTION TOP -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h1>Registro de Estudiante</h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / Registro</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<!-- END SECTION TOP -->

		<!-- START REGISTER -->
		<section class="register_area section-padding">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8 col-md-10 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
						<div class="register-form" style="background:#fff;padding:50px 40px;border-radius:10px;box-shadow:0 0 30px rgba(0,0,0,0.05);">
							<div class="text-center mb-4">
								<h3 style="margin-bottom:10px;">Crea tu cuenta de estudiante</h3>
								<p style="color:#777;">Comienza tu camino hacia el dominio del inglés con nosotros</p>
							</div>
							<form action="../../control/InicioController.php" method="POST">
								<div class="row">
									<div class="form-group col-md-6 mb-3">
										<label for="cedula">Cédula <span style="color:red;">*</span></label>
										<input type="text" name="cedula" id="cedula" class="form-control" placeholder="1-1234-5678" pattern="[18]-[0-9]{4}-[0-9]{4}" required>
										<small style="color:#999;">Formato: 1-XXXX-XXXX (nacionales) o 8-XXXX-XXXX (residentes)</small>
									</div>
									<div class="form-group col-md-6 mb-3">
										<label for="fecha_nacimiento">Fecha de nacimiento <span style="color:red;">*</span></label>
										<input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6 mb-3">
										<label for="nombre">Nombre <span style="color:red;">*</span></label>
										<input type="text" name="nombre" id="nombre" class="form-control" required>
									</div>
									<div class="form-group col-md-6 mb-3">
										<label for="apellido_p">Primer apellido <span style="color:red;">*</span></label>
										<input type="text" name="apellido_p" id="apellido_p" class="form-control" required>
									</div>
								</div>
								<div class="form-group mb-3">
									<label for="apellido_m">Segundo apellido</label>
									<input type="text" name="apellido_m" id="apellido_m" class="form-control">
								</div>
								<div class="row">
									<div class="form-group col-md-6 mb-3">
										<label for="correo">Correo electrónico <span style="color:red;">*</span></label>
										<input type="email" name="correo" id="correo" class="form-control" required>
									</div>
									<div class="form-group col-md-6 mb-3">
										<label for="telefono">Teléfono <span style="color:red;">*</span></label>
										<input type="tel" name="telefono" id="telefono" class="form-control" placeholder="8888-1234" pattern="[6-8][0-9]{3}-[0-9]{4}" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6 mb-3">
										<label for="clave">Contraseña <span style="color:red;">*</span></label>
										<input type="password" name="clave" id="clave" class="form-control" placeholder="Mínimo 8 caracteres" minlength="8" required>
										<small style="color:#999;">Al menos 8 caracteres. Con ella entrarás al sistema.</small>
									</div>
									<div class="form-group col-md-6 mb-3">
										<label for="clave2">Repetir contraseña <span style="color:red;">*</span></label>
										<input type="password" name="clave2" id="clave2" class="form-control" placeholder="Escríbela de nuevo" minlength="8" required>
									</div>
								</div>
								<div class="form-group mb-3">
									<label for="nivel_inicial">Nivel inicial estimado de inglés</label>
									<select name="nivel_inicial" id="nivel_inicial" class="form-control">
										<option value="">-- Todavía no lo sé / Solicitar prueba diagnóstica --</option>
										<option value="1">A1 - Principiante</option>
										<option value="2">A2 - Básico</option>
										<option value="3">B1 - Intermedio</option>
										<option value="4">B2 - Intermedio Alto</option>
										<option value="5">C1 - Avanzado</option>
										<option value="6">C2 - Dominio</option>
									</select>
								</div>
								<div class="form-group mb-3">
									<input type="checkbox" name="terminos" id="terminos" required>
									<label for="terminos" style="margin-left:5px;font-weight:normal;">
										Acepto los <a href="#">términos y condiciones</a> de Real English CR
									</label>
								</div>
								<button type="submit" name="btnRegistrar" class="btn_one w-100" style="width:100%;">Crear mi cuenta</button>
								<p class="text-center mt-3" style="margin-top:20px;">
									¿Ya tienes cuenta? <a href="IniciarSesion.php"><strong>Inicia sesión</strong></a>
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- END REGISTER -->
<?php PintarFooter(); ImportJS(); ?>
