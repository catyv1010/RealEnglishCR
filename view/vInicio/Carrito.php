<?php $titulo_pagina = "Real English CR - Carrito"; include_once '../LayoutExterno.php'; ImportCSS($titulo_pagina); PintarHeader(); ?>


		<!-- START SECTION TOP -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h1>Mi Carrito de Matrícula</h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / Carrito</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<!-- END SECTION TOP -->

		<!-- START CART -->
		<section class="cart_area section-padding">
			<div class="container">
				<div class="row wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
					<div class="col-lg-8 col-md-12">
						<div class="cart-table" style="background:#fff;padding:30px;border-radius:10px;box-shadow:0 0 30px rgba(0,0,0,0.05);">
							<h3 style="margin-bottom:25px;">Resumen de Matrícula</h3>
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Curso</th>
										<th>Nivel</th>
										<th>Horario</th>
										<th>Precio</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="cartItems">
									<!-- Las filas se cargan dinamicamente desde el SP listar_carrito() -->
									<tr>
										<td><strong>Inglés Intermedio General</strong><br><small>Sede San Jose - Profe: Andres Vargas</small></td>
										<td><span class="badge" style="background:#5B6FFC;color:#fff;padding:4px 10px;border-radius:5px;">B1</span></td>
										<td>L-Mi-V 18:00-20:00</td>
										<td><strong>&#8353; 95,000</strong></td>
										<td><a href="#" style="color:#ff5252;"><i class="fa-solid fa-trash"></i></a></td>
									</tr>
								</tbody>
							</table>
							<div style="margin-top:30px;text-align:center;">
								<a href="Cursos.php" style="color:#5B6FFC;">+ Agregar otro curso</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-12">
						<div class="cart-summary" style="background:#fff;padding:30px;border-radius:10px;box-shadow:0 0 30px rgba(0,0,0,0.05);">
							<h4 style="margin-bottom:20px;">Total a Pagar</h4>
							<div style="display:flex;justify-content:space-between;margin-bottom:10px;">
								<span>Subtotal:</span>
								<strong>&#8353; 95,000</strong>
							</div>
							<div style="display:flex;justify-content:space-between;margin-bottom:10px;">
								<span>Descuento:</span>
								<strong style="color:#28a745;">- &#8353; 0</strong>
							</div>
							<hr>
							<div style="display:flex;justify-content:space-between;margin-bottom:20px;font-size:18px;">
								<strong>Total:</strong>
								<strong style="color:#5B6FFC;">&#8353; 95,000</strong>
							</div>
							<form action="Pagar.php" method="GET">
								<button type="submit" class="btn_one w-100" style="width:100%;">Proceder al Pago</button>
							</form>
							<p style="margin-top:15px;text-align:center;color:#999;font-size:13px;">
								Pago seguro con SINPE Movil, tarjeta o transferencia
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- END CART -->
<?php PintarFooter(); ImportJS(); ?>
