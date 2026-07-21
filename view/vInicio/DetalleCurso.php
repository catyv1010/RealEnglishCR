<?php
// Detalle de un curso desde Oracle (recibe ?id=<curso_id>)
require_once __DIR__ . "/../../model/Catalogo.php";
session_start();

$id      = isset($_GET['id']) ? preg_replace('/\D/', '', $_GET['id']) : '';
$curso   = null;
$grupos  = [];
$errorBD = null;

try {
    if ($id !== '') {
        $curso  = Catalogo::curso($id);
        $grupos = $curso ? Catalogo::gruposDeCurso($id) : [];
    }
} catch (Exception $e) {
    $errorBD = $e->getMessage();
}

// sin curso valido volvemos al catalogo
if ($errorBD === null && $curso === null) {
    header('Location: Cursos.php');
    exit;
}

$titulo_pagina = "Real English CR - " . ($curso ? $curso['NOMBRE'] : 'Curso');
include_once "../LayoutExterno.php";
ImportCSS($titulo_pagina);
PintarHeader();
?>

		<!-- section top -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
						<h1><?= htmlspecialchars($curso ? $curso['NOMBRE'] : 'Curso') ?></h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / <a href="Cursos.php">Cursos</a></li>
							<li> / <?= htmlspecialchars($curso ? $curso['CODIGO'] : '') ?></li>
						</ul>
					</div>
				</div>
			</div>
		</section>

		<section class="section-padding">
			<div class="container">
<?php if ($errorBD !== null) { ?>
				<p style="color:#c0392b;">No se pudo cargar el curso: <?= htmlspecialchars($errorBD) ?></p>
<?php } else { ?>
				<div class="row">

					<!-- columna izquierda -->
					<div class="col-lg-8">
						<img src="<?= Catalogo::imagenCurso($curso['CURSO_ID']) ?>" class="img-fluid"
						     style="border-radius:10px;width:100%;"
						     alt="<?= htmlspecialchars($curso['NOMBRE']) ?>">

						<h3 style="margin-top:30px;">Sobre este curso</h3>
						<p><?= htmlspecialchars($curso['DESCRIPCION'] ?: 'Curso del programa regular de Real English CR.') ?></p>

						<div class="row" style="margin-top:30px;">
							<div class="col-6 col-md-3"><b>Código</b><br><?= htmlspecialchars($curso['CODIGO']) ?></div>
							<div class="col-6 col-md-3"><b>Nivel MCER</b><br><?= htmlspecialchars(Catalogo::nivelTexto($curso['NIVEL_ID'])) ?></div>
							<div class="col-6 col-md-3"><b>Duración</b><br><?= htmlspecialchars($curso['DURACION_HORAS']) ?> horas</div>
							<div class="col-6 col-md-3"><b>Modalidad</b><br><?= htmlspecialchars($curso['MODALIDAD']) ?></div>
						</div>

						<!-- grupos abiertos -->
						<h3 style="margin-top:45px;">Grupos con matrícula abierta</h3>
<?php if (count($grupos) === 0) { ?>
						<p>Ahora mismo no hay grupos abiertos para este curso.
						   Escribinos por <a href="Contacto.php">Contacto</a> y te avisamos cuando abra el próximo.</p>
<?php } else { ?>
						<form action="../../control/InicioController.php" method="POST">
							<input type="hidden" name="curso_id" value="<?= htmlspecialchars($curso['CURSO_ID']) ?>">
							<table class="table table-hover" style="margin-top:15px;">
								<thead>
									<tr>
										<th></th>
										<th>Grupo</th>
										<th>Días</th>
										<th>Horario</th>
										<th>Inicio</th>
										<th>Cupos libres</th>
										<th>Profesor</th>
									</tr>
								</thead>
								<tbody>
<?php   foreach ($grupos as $g) {
            $prof  = Catalogo::profesor($g['PROFESOR_ID']);
            $libre = Catalogo::cupoDisponible($g);
?>
									<tr>
										<td>
											<input type="radio" name="grupo_id"
											       value="<?= htmlspecialchars($g['GRUPO_ID']) ?>"
											       <?= $libre === 0 ? 'disabled' : '' ?> required>
										</td>
										<td><?= htmlspecialchars($g['CODIGO']) ?></td>
										<td><?= htmlspecialchars($g['DIAS']) ?></td>
										<td><?= htmlspecialchars($g['HORARIO']) ?></td>
										<td><?= htmlspecialchars(Catalogo::fecha($g['FECHA_INICIO'])) ?></td>
										<td>
<?php       if ($libre === 0) { ?>
											<span style="color:#c0392b;">Lleno</span>
<?php       } else { ?>
											<b style="color:#1e8449;"><?= $libre ?></b> de <?= htmlspecialchars($g['CUPO_MAX']) ?>
<?php       } ?>
										</td>
										<td>
<?php       if ($prof) { ?>
											<a href="PerfilProfesor.php?id=<?= urlencode($prof['EMPLEADO_ID']) ?>">
												<?= htmlspecialchars($prof['NOMBRE'] . ' ' . $prof['APELLIDO_P']) ?>
											</a>
<?php       } else { echo '&mdash;'; } ?>
										</td>
									</tr>
<?php   } ?>
								</tbody>
							</table>

							<button type="submit" name="btnMatricular" class="btn_one" style="margin-top:10px;">
								Matricularme en el grupo seleccionado
							</button>
<?php   if (!isset($_SESSION['estudiante_id'])) { ?>
							<p style="margin-top:12px;color:#7f8c8d;">
								Para matricularte necesitás <a href="IniciarSesion.php">iniciar sesión</a>.
								¿Primera vez? <a href="RegistrarUsuarios.php">Creá tu cuenta</a>.
							</p>
<?php   } ?>
						</form>
<?php } ?>
					</div>

					<!-- columna derecha -->
					<div class="col-lg-4">
						<div style="background:#fff;border:1px solid #e5e8e8;border-radius:10px;padding:28px;">
							<div class="price" style="font-size:26px;font-weight:700;">
								<?= Catalogo::colones($curso['PRECIO_COLONES']) ?>
							</div>
							<p style="color:#7f8c8d;margin-top:4px;">Precio total del curso</p>
							<hr>
							<p><span class="ti-medall-alt"></span> Nivel <?= htmlspecialchars(Catalogo::nivelCodigo($curso['NIVEL_ID'])) ?></p>
							<p><span class="ti-alarm-clock"></span> <?= htmlspecialchars($curso['DURACION_HORAS']) ?> horas de clase</p>
							<p><span class="ti-blackboard"></span> Modalidad <?= htmlspecialchars(strtolower($curso['MODALIDAD'])) ?></p>
							<p><span class="ti-user"></span> <?= count($grupos) ?> grupo(s) con matrícula abierta</p>
							<hr>
							<p style="color:#7f8c8d;font-size:14px;">
								Al matricularte, la base de datos genera automáticamente el pago
								con vencimiento a 8 días. Podés cancelarlo por SINPE, transferencia,
								tarjeta o en efectivo en la sede.
							</p>
						</div>

						<div style="margin-top:25px;">
							<h4>Otros cursos del mismo nivel</h4>
<?php
$relacionados = array_filter(Catalogo::cursos(), function ($o) use ($curso) {
    return $o['CURSO_ID'] != $curso['CURSO_ID'] && $o['NIVEL_ID'] == $curso['NIVEL_ID'];
});
if (count($relacionados) === 0) { ?>
							<p style="color:#7f8c8d;">Es el único curso de este nivel.</p>
<?php } else { foreach (array_slice($relacionados, 0, 3) as $o) { ?>
							<p>
								<a href="DetalleCurso.php?id=<?= urlencode($o['CURSO_ID']) ?>"><?= htmlspecialchars($o['NOMBRE']) ?></a><br>
								<small style="color:#7f8c8d;"><?= Catalogo::colones($o['PRECIO_COLONES']) ?></small>
							</p>
<?php } } ?>
						</div>
					</div>

				</div>
<?php } ?>
			</div>
		</section>

<?php PintarFooter(); ImportJS(); ?>
