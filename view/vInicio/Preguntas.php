<?php $titulo_pagina = "Real English CR - Preguntas Frecuentes"; include_once '../LayoutExterno.php'; ImportCSS($titulo_pagina); PintarHeader(); ?>

		<!-- START SECTION TOP -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h1>Preguntas Frecuentes</h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / Preguntas</li>
						</ul>
					</div><!-- //.HERO-TEXT -->
				</div><!--- END COL -->
			</div><!--- END CONTAINER -->
		</section>	
		<!-- END SECTION TOP -->
		
		<!-- START FAQ -->
		<section class="faq_area section-padding">
			<div class="container">															
				<div class="row justify-content-center">		
					<div class="col-lg-7 col-sm-12 col-xs-12">
						<div class="accordion" id="accordionExample">
						  <div class="accordion-item">
							<h2 class="accordion-header" id="headingOne">
							  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								¿Cómo sé en qué nivel me tengo que matricular?
							  </button>
							</h2>
							<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
							  <div class="accordion-body">
								Si no estás segura de tu nivel, hacés una prueba diagnóstica gratuita en cualquiera de nuestras cinco sedes o en línea. La prueba evalúa comprensión de lectura, escucha y expresión oral, y con el resultado te ubicamos en el nivel del Marco Común Europeo que te corresponde, de A1 (principiante) hasta C2 (dominio). Si preferís, también podés matricularte directamente en A1 y avanzar desde cero.
							  </div>
							</div>
						  </div><!-- END ACCORDION ITEM  -->
						  <div class="accordion-item">
							<h2 class="accordion-header" id="headingTwo">
							  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								¿Los cursos entregan algún certificado?
							  </button>
							</h2>
							<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
							  <div class="accordion-body">
								Sí. Al aprobar cada nivel recibís un certificado de Real English CR con la nota final y las horas cursadas. Para aprobar necesitás una nota mínima de 70 y al menos un 80 % de asistencia. Además ofrecemos cursos de preparación para exámenes internacionales como TOEFL e IELTS, cuya certificación la emite el organismo correspondiente.
							  </div>
							</div>
						  </div><!-- END ACCORDION ITEM  -->
						  <div class="accordion-item">
							<h2 class="accordion-header" id="headingThree">
							  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								¿Cuánto dura cada curso y con qué frecuencia son las clases?
							  </button>
							</h2>
							<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
							  <div class="accordion-body">
								Cada nivel dura entre 60 y 72 horas, según el curso. Las clases son dos veces por semana en modalidad presencial, o con horario flexible en la modalidad virtual. En promedio, un nivel completo toma unos tres meses.
							  </div>
							</div>
						  </div><!-- END ACCORDION ITEM  -->
						  <div class="accordion-item">
							<h2 class="accordion-header" id="headingFour">
							  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
								¿Puedo llevar los cursos de forma virtual?
							  </button>
							</h2>
							<div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
							  <div class="accordion-body">
								Sí. Tenemos tres modalidades: presencial en nuestras sedes de San José, Heredia, Alajuela, Cartago y Liberia; virtual en vivo con el profesor; e híbrida, que combina las dos. Podés cambiar de modalidad entre un nivel y otro sin costo adicional.
							  </div>
							</div>
						  </div><!-- END ACCORDION ITEM  -->	
						  <div class="accordion-item">
							<h2 class="accordion-header" id="headingFive">
							  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
								¿Qué formas de pago aceptan?
							  </button>
							</h2>
							<div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
							  <div class="accordion-body">
								Podés pagar la matrícula y las mensualidades en efectivo, con tarjeta de débito o crédito, o por transferencia bancaria (SINPE Móvil incluido). El sistema registra cada pago y te avisa antes de la fecha de vencimiento; si un pago se atrasa, el estado cambia automáticamente a ATRASADO y la administración se pone en contacto con vos.
							  </div>
							</div>
						  </div><!-- END ACCORDION ITEM  -->					  
						</div>						
					</div><!-- END COL  -->	
					<div class="col-lg-5 col-sm-12 col-xs-12">
						<div class="faq_img">
							<img src="../../assets/img/faq.jpg" alt="faq image" />
						</div>
					</div>					
				</div><!--END  ROW  -->
			</div><!--- END CONTAINER -->
		</section>
		<!-- END FAQ -->				
		
<?php PintarFooter(); ImportJS(); ?>
