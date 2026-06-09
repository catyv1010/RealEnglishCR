<?php $titulo_pagina = "Real English CR - Pagar"; include_once '../LayoutExterno.php'; ImportCSS($titulo_pagina); PintarHeader(); ?>


		<!-- START SECTION TOP -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h1>Procesar Pago</h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / Pago</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<!-- END SECTION TOP -->

		<!-- START CHECKOUT -->
		<section class="checkout_area section-padding">
			<div class="container">
				<div class="row wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
					<div class="col-lg-8 col-md-12">
						<div class="checkout-form" style="background:#fff;padding:30px;border-radius:10px;box-shadow:0 0 30px rgba(0,0,0,0.05);">
							<h3 style="margin-bottom:25px;">Informacion de Pago</h3>
							<form action="procesar_pago.php" method="POST">
								<h5 style="margin-top:20px;margin-bottom:15px;">Metodo de Pago</h5>
								<div class="row" style="margin-bottom:25px;">
									<div class="col-md-3 col-6 mb-2">
										<label style="display:block;border:2px solid #eee;padding:15px;border-radius:8px;cursor:pointer;text-align:center;" class="metodo-pago">
											<input type="radio" name="metodo" value="SINPE" required style="display:none;">
											<i class="fa-solid fa-mobile-screen" style="font-size:30px;color:#5B6FFC;display:block;margin-bottom:5px;"></i>
											<strong>SINPE Movil</strong>
										</label>
									</div>
									<div class="col-md-3 col-6 mb-2">
										<label style="display:block;border:2px solid #eee;padding:15px;border-radius:8px;cursor:pointer;text-align:center;" class="metodo-pago">
											<input type="radio" name="metodo" value="TARJETA" style="display:none;">
											<i class="fa-solid fa-credit-card" style="font-size:30px;color:#5B6FFC;display:block;margin-bottom:5px;"></i>
											<strong>Tarjeta</strong>
										</label>
									</div>
									<div class="col-md-3 col-6 mb-2">
										<label style="display:block;border:2px solid #eee;padding:15px;border-radius:8px;cursor:pointer;text-align:center;" class="metodo-pago">
											<input type="radio" name="metodo" value="TRANSFERENCIA" style="display:none;">
											<i class="fa-solid fa-building-columns" style="font-size:30px;color:#5B6FFC;display:block;margin-bottom:5px;"></i>
											<strong>Transferencia</strong>
										</label>
									</div>
									<div class="col-md-3 col-6 mb-2">
										<label style="display:block;border:2px solid #eee;padding:15px;border-radius:8px;cursor:pointer;text-align:center;" class="metodo-pago">
											<input type="radio" name="metodo" value="EFECTIVO" style="display:none;">
											<i class="fa-solid fa-money-bill-wave" style="font-size:30px;color:#5B6FFC;display:block;margin-bottom:5px;"></i>
											<strong>Efectivo</strong>
										</label>
									</div>
								</div>

								<h5 style="margin-bottom:15px;">Datos del Estudiante</h5>
								<div class="row">
									<div class="form-group col-md-6 mb-3">
										<label>Cedula <span style="color:red;">*</span></label>
										<input type="text" name="cedula" class="form-control" placeholder="1-1234-5678" required>
									</div>
									<div class="form-group col-md-6 mb-3">
										<label>Nombre completo <span style="color:red;">*</span></label>
										<input type="text" name="nombre" class="form-control" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6 mb-3">
										<label>Correo electronico <span style="color:red;">*</span></label>
										<input type="email" name="correo" class="form-control" required>
									</div>
									<div class="form-group col-md-6 mb-3">
										<label>Telefono <span style="color:red;">*</span></label>
										<input type="tel" name="telefono" class="form-control" placeholder="8888-1234" required>
									</div>
								</div>

								<h5 style="margin-top:20px;margin-bottom:15px;">Datos de Facturacion</h5>
								<div class="row">
									<div class="form-group col-md-6 mb-3">
										<label>Provincia</label>
										<select name="provincia" class="form-control">
											<option>San Jose</option>
											<option>Heredia</option>
											<option>Cartago</option>
											<option>Alajuela</option>
											<option>Guanacaste</option>
											<option>Puntarenas</option>
											<option>Limon</option>
										</select>
									</div>
									<div class="form-group col-md-6 mb-3">
										<label>Direccion</label>
										<input type="text" name="direccion" class="form-control" placeholder="Direccion exacta">
									</div>
								</div>

								<div class="form-group mb-3">
									<input type="checkbox" name="aceptar" required>
									<label style="margin-left:5px;font-weight:normal;">
										Confirmo que la informacion es correcta y autorizo el cobro
									</label>
								</div>
								<button type="submit" class="btn_one w-100" style="width:100%;">Confirmar y Pagar</button>
							</form>
						</div>
					</div>

					<div class="col-lg-4 col-md-12">
						<div class="order-summary" style="background:#fff;padding:30px;border-radius:10px;box-shadow:0 0 30px rgba(0,0,0,0.05);">
							<h4 style="margin-bottom:20px;">Detalle de tu Orden</h4>
							<div style="border-bottom:1px solid #eee;padding-bottom:15px;margin-bottom:15px;">
								<strong>Ingles Intermedio General</strong><br>
								<small style="color:#777;">Nivel B1 - Sede San Jose</small><br>
								<small style="color:#777;">L-Mi-V 18:00-20:00</small><br>
								<span style="font-size:18px;color:#5B6FFC;font-weight:bold;">&#8353; 95,000</span>
							</div>
							<div style="display:flex;justify-content:space-between;margin-bottom:10px;">
								<span>Subtotal:</span>
								<strong>&#8353; 95,000</strong>
							</div>
							<div style="display:flex;justify-content:space-between;margin-bottom:10px;">
								<span>Descuento:</span>
								<strong style="color:#28a745;">- &#8353; 0</strong>
							</div>
							<hr>
							<div style="display:flex;justify-content:space-between;font-size:20px;">
								<strong>Total:</strong>
								<strong style="color:#5B6FFC;">&#8353; 95,000</strong>
							</div>
							<p style="margin-top:20px;text-align:center;color:#999;font-size:13px;">
								<i class="fa-solid fa-lock"></i> Tu pago esta protegido
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- END CHECKOUT -->
<?php PintarFooter(); ImportJS(); ?>
