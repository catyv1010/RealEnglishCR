<?php $titulo_pagina = "Real English CR - Detalle del Blog"; include_once '../LayoutExterno.php'; ImportCSS($titulo_pagina); PintarHeader(); ?>

		<!-- section top -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h1>Detalle del Blog</h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / Detalle del Blog</li>
						</ul>
					</div>
				</div>
			</div>
		</section>	
		
	<!-- blog -->
	<section class="blog-page section-padding">
		<div class="container">	
			<div class="row">
				<div class="col-lg-7 col-sm-12 col-xs-12">
					<div class="arti_single">
						<div class="arti_img_two">
							<img src="../../assets/img/blog/3.jpg" class="img-fluid" alt="Blog image" />
						</div>
						<div class="arti_content ">
							<p>Cuando empecé a estudiar inglés me costaba mucho entender lo que escuchaba. Lo que más me ayudó fue practicar todos los días un rato corto, ver series con subtítulos en inglés y no tener miedo a equivocarme al hablar. Poco a poco fui ganando confianza y hoy puedo mantener una conversación sin problema. La clave es la constancia, no estudiar muchas horas un solo dia.</p>
						</div>
						<div class="arti_sp">
							<h2>La importancia de practicar el inglés todos los días</h2>
							<img src="../../assets/img/blog/2.jpg" class="img-fluid" alt="Blog image" />
							<p>Otro consejo útil es repasar el vocabulario nuevo en contexto y no como una lista suelta. Anota frases completas, repitelas en voz alta y usalas en tus propias oraciones. Así se te quedan mucho mejor y las vas a poder usar cuando hables.</p>
						</div>
						<div class="share_sp">
							<h4>Compartir</h4>
							<ul>
								<li><a href="#"><span class="ti-facebook"></span> Facebook</a></li>
								<li><a href="#"><span class="ti-twitter"></span> Twitter</a></li>
								<li><a href="#"><span class="ti-instagram"></span> Instagram</a></li>
								<li><a href="#"><span class="ti-linkedin"></span> Linkedin</a></li>
							</ul>
						</div>
					</div>	
					<div class="author_part">
						<h3 class="blog_head_title">Acerca del autor</h3>
						<div class="single_author">
							<img src="../../assets/img/blog/author.jpg" alt="" />
							<h4>Marcela Jiménez</h4>
							 <p>Aprende inglés de la manera más efectiva. Con práctica constante y buenas técnicas de estudio vas a notar el avance en pocas semanas. Lo importante es perderle el miedo a hablar y equivocarse.</p> 
						</div>
					</div>
					<div class="comments_part">
						<h3 class="blog_head_title">Comentarios</h3>
						<div class="single_comment">
							<img src="../../assets/img/blog/c1.jpg" alt="" />
							<h4>Mariana Cordero</h4>
							<p>Muy buen artículo. Lo de repasar el vocabulario en contexto y no como lista suelta me cambió la forma de estudiar.</p>
						</div>
						<div class="single_comment sc_left">
							<img src="../../assets/img/blog/c3.jpg" alt="" />
							<h4>Bryan Mendoza</h4>
							<p>Coincido con lo de la constancia. Yo estudio 20 minutos diarios y avancé más que cuando hacía maratones de tres horas los domingos.</p>
						</div>
						<div class="single_comment single_comment_mbnone">
							<img src="../../assets/img/blog/c2.jpg" alt="" />
							<h4>Adrián Garro</h4>
							<p>Lo del miedo a equivocarse es lo más difícil. En clase de conversación fue donde por fin lo solté.</p>
						</div>
					</div>	
					<div class="comment_form">
						<h3 class="blog_head_title">Agregar comentario</h3>
						<div class="contact comment-box">
							<form id="contact-form" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="form-group col-md-6">
										<input type="text" name="name" class="form-control" id="first-name" placeholder="Nombre" required="required">
									</div>
									<div class="form-group col-md-6">
										<input type="email" name="email" class="form-control" id="first-email" placeholder="Correo" required="required">
									</div>
									<div class="form-group col-md-12">
										<input type="text" name="subject" class="form-control" id="subject" placeholder="Asunto" required="required">
									</div>
									<div class="form-group col-md-12">
										<textarea rows="6" name="message" class="form-control" id="description" placeholder="Tu mensaje" required="required"></textarea>
									</div>
									<div class="col-md-12">
										<div class="actions">
											<button type="submit" value="Enviar mensaje" name="submit" id="submitButton" class="btn btn_one" title="Enviar tu mensaje!">Enviar comentario</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>						
				</div>		
				<div class="col-lg-5 col-sm-12 col-xs-12">
					<div class="sidebar-post">
						<div class="blog_search">
							<input type="text" class="form-control" placeholder="Escribe y presiona Enter">
						</div>				
					</div>
					<div class="sidebar-post">
						<div class="newsletter-form">
							<h4>Suscribite para recibir novedades</h4>
							<p>Aprende inglés de la manera más efectiva con nuestros cursos</p>
							<form action="#" class="subscribe">
								<input type="text" class="subscribe__input" placeholder="Correo electrónico">
								<button type="button" class="sub_btn">Suscribirse</button>
							</form>
						</div>						
					</div>
					<div class="sidebar-post">
						<div class="sidebar_title"><h4>Artículos populares</h4></div>
						<div class="single_popular">
							<a href="DetalleBlog.php"><img src="../../assets/img/blog/blog-1.png" alt="" /></a>
							<h5><a href="DetalleBlog.php">Beneficios de aprender inglés en Costa Rica</a></h5>
						</div>
						<div class="single_popular">
							<a href="DetalleBlog.php"><img src="../../assets/img/blog/blog-2.png" alt="" /></a>
							<h5><a href="DetalleBlog.php">Por qué el inglés te abre más puertas laborales</a></h5>
						</div>
						<div class="single_popular">
							<a href="DetalleBlog.php"><img src="../../assets/img/blog/blog-3.png" alt="" /></a>
							<h5><a href="DetalleBlog.php">Errores comunes al aprender inglés y cómo evitarlos</a></h5>
						</div>
						<div class="single_popular">
							<a href="DetalleBlog.php"><img src="../../assets/img/blog/blog-4.png" alt="" /></a>
							<h5><a href="DetalleBlog.php">Cómo organizar tu tiempo para estudiar inglés</a></h5>
						</div>
						<div class="single_popular">
							<a href="DetalleBlog.php"><img src="../../assets/img/blog/blog-5.png" alt="" /></a>
							<h5><a href="DetalleBlog.php">Lo que necesitas saber antes de presentar el TOEFL</a></h5>
						</div>	
					</div>					
					<div class="sidebar-post">
						<div class="sidebar_title"><h4>Síguenos</h4></div>
						<div class="single_social">
							<ul>
								<li><div class="social_item b_facebook"><a href="#" title="facebook"><i class="fa fa-facebook"></i><span class="item-list">150K Me gusta</span></a></div></li>
								
								<li><div class="social_item b_twitter"><a href="#" title="twitter"><i class="fa fa-twitter"></i><span class="item-list">138K Seguidores</span></a></div></li>
								
								<li><div class="social_item b_youtube"><a href="#" title="youtube"><i class="fa fa-youtube"></i><span class="item-list">90K Suscriptores</span></a></div></li>
								
								<li><div class="social_item b_pinterest"><a href="#" title="pinterest"><i class="fa fa-pinterest"></i><span class="item-list">350K Seguidores</span></a></div></li>
								
								<li><div class="social_item b_tumblr"><a href="#" title="rss"><i class="fa fa-tumblr"></i><span class="item-list">901 Seguidores</span></a></div></li>
								
								<li><div class="social_item b_rss"><a href="#" title="rss"><i class="fa fa-rss"></i><span class="item-list">411 Seguidores</span></a></div></li>
							</ul>
						</div>
					</div>							
					<div class="sidebar-post">
						<div class="sidebar_title"><h4>CATEGORIAS</h4></div>
						<div class="single_category">
							<ul>
								<li><a href="#">Educación <sup>11</sup></a></li>
								<li><a href="#">Pronunciación <sup>44</sup></a></li>
								<li><a href="#">Vocabulario <sup>33</sup></a></li>
								<li><a href="#">Negocios <sup>14</sup></a></li>
								<li><a href="#">Gramática <sup>21</sup></a></li>
								<li><a href="#">Exámenes <sup>01</sup></a></li>
							</ul>
						</div>
					</div>
					<div class="sidebar-post">
						<div class="tag">
							<div class="sidebar_title"><h4>Etiquetas populares</h4></div>
							<a href="#">A1 Principiante</a>
							<a href="#">Cursos</a>
							<a href="#">Pronunciación</a>
							<a href="#">Vocabulario</a>
							<a href="#">Gramática</a>
							<a href="#">Conversación</a>
							<a href="#">Preparación TOEFL</a>
							<a href="#">Todos los proyectos</a>
							
						</div>					
					</div>					
					<div class="sidebar-post">
						<div class="sidebar_title"><h4>Publicidad</h4></div>
						<div class="sidebar-banner">
							<a href="#"><img src="../../assets/img/blog/banner.jpg" class="img-fluid" alt="" /></a>
						</div>
					</div>		
				</div>					
			</div>
		</div>
	</section>
		
<?php PintarFooter(); ImportJS(); ?>
