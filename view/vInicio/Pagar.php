<?php
// Pago de una matricula (recibe ?matricula=<id>)
require_once __DIR__ . "/../../model/Catalogo.php";
require_once __DIR__ . "/../../model/CrudModel.php";
session_start();

if (!isset($_SESSION['estudiante_id'])) {
    header('Location: IniciarSesion.php');
    exit;
}

$matriculaId = isset($_GET['matricula']) ? preg_replace('/\D/', '', $_GET['matricula']) : '';
$pago = null; $matricula = null; $grupo = null; $curso = null; $errorBD = null;

try {
    if ($matriculaId !== '') {
        $matricula = CrudModel::obtener('matriculas', $matriculaId);

        // no dejar pagar matricula ajena
        if ($matricula && (string) $matricula['ESTUDIANTE_ID'] !== (string) $_SESSION['estudiante_id']) {
            $matricula = null;
        }

        if ($matricula) {
            $grupo = Catalogo::grupo($matricula['GRUPO_ID']);
            $curso = $grupo ? Catalogo::curso($grupo['CURSO_ID']) : null;

            // El pago pendiente de esta matricula
            foreach (CrudModel::listar('pagos') as $p) {
                if ((string) $p['MATRICULA_ID'] === (string) $matriculaId) {
                    $pago = $p;
                    break;
                }
            }
        }
    }
} catch (Exception $e) {
    $errorBD = $e->getMessage();
}

if ($errorBD === null && $pago === null) {
    header('Location: Cursos.php');
    exit;
}

$titulo_pagina = "Real English CR - Pagar";
include_once "../LayoutExterno.php";
ImportCSS($titulo_pagina);
PintarHeader();
?>

		<!-- section top -->
		<section class="section-top">
			<div class="container">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
						<h1>Confirmá tu matrícula</h1>
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li> / Pago</li>
						</ul>
					</div>
				</div>
			</div>
		</section>

		<section class="section-padding">
			<div class="container">
<?php if ($errorBD !== null) { ?>
				<p style="color:#c0392b;">No se pudo cargar el pago: <?= htmlspecialchars($errorBD) ?></p>
<?php } else { ?>
				<div class="row">
					<div class="col-lg-7">
						<div style="background:#eafaf1;border:1px solid #a9dfbf;border-radius:10px;padding:22px;margin-bottom:28px;">
							<b style="color:#1e8449;">Tu matrícula quedó registrada</b><br>
							Tu matrícula es la <b>#<?= htmlspecialchars($matriculaId) ?></b>.
							Ya la base de datos apartó tu cupo en el grupo. Ahora solo falta el pago.
						</div>

						<h3>Resumen</h3>
						<table class="table">
							<tr>
								<td>Curso</td>
								<td><b><?= htmlspecialchars($curso ? $curso['NOMBRE'] : '') ?></b><br>
									<small style="color:#7f8c8d;"><?= htmlspecialchars($curso ? $curso['CODIGO'] : '') ?>
									&middot; <?= htmlspecialchars($curso ? Catalogo::nivelTexto($curso['NIVEL_ID']) : '') ?></small></td>
							</tr>
							<tr>
								<td>Grupo</td>
								<td><?= htmlspecialchars($grupo ? $grupo['CODIGO'] : '') ?>
									&middot; <?= htmlspecialchars($grupo ? $grupo['DIAS'] : '') ?>
									&middot; <?= htmlspecialchars($grupo ? $grupo['HORARIO'] : '') ?></td>
							</tr>
							<tr>
								<td>Inicio de lecciones</td>
								<td><?= htmlspecialchars($grupo ? Catalogo::fecha($grupo['FECHA_INICIO']) : '') ?></td>
							</tr>
							<tr>
								<td>Vence el</td>
								<td><?= htmlspecialchars(Catalogo::fecha($pago['FECHA_VENCIMIENTO'])) ?>
									<small style="color:#7f8c8d;">(8 días de plazo)</small></td>
							</tr>
							<tr>
								<td><b>Total a pagar</b></td>
								<td style="font-size:22px;font-weight:700;"><?= Catalogo::colones($pago['MONTO']) ?></td>
							</tr>
						</table>
						<p style="color:#7f8c8d;font-size:14px;">
							El monto no lo escribe la página: sale del precio que tiene el curso en la
							base de datos (<code>CURSOS.PRECIO_COLONES</code>).
						</p>
					</div>

					<div class="col-lg-5">
						<div style="background:#fff;border:1px solid #e5e8e8;border-radius:10px;padding:28px;">
							<h4>Método de pago</h4>
<?php if ($pago['ESTADO'] === 'PAGADO') { ?>
							<p style="color:#1e8449;"><b>Este pago ya está registrado como PAGADO.</b></p>
							<a href="Principal.php" class="btn_one">Volver al inicio</a>
<?php } else { ?>
							<form action="../../control/InicioController.php" method="POST">
								<input type="hidden" name="pago_id" value="<?= htmlspecialchars($pago['PAGO_ID']) ?>">

								<div style="margin:18px 0;">
									<label><input type="radio" name="metodo_pago" value="SINPE" checked> SINPE Móvil</label><br>
									<label><input type="radio" name="metodo_pago" value="TRANSFERENCIA"> Transferencia bancaria</label><br>
									<label><input type="radio" name="metodo_pago" value="TARJETA"> Tarjeta de crédito o débito</label><br>
									<label><input type="radio" name="metodo_pago" value="EFECTIVO"> Efectivo en la sede</label>
								</div>

								<button type="submit" name="btnPagar" class="btn_one" style="width:100%;">
									Confirmar y pagar <?= Catalogo::colones($pago['MONTO']) ?>
								</button>
							</form>
							<p style="color:#7f8c8d;font-size:13px;margin-top:16px;">
								Si preferís pagar después, tu cupo queda apartado hasta el
								<?= htmlspecialchars(Catalogo::fecha($pago['FECHA_VENCIMIENTO'])) ?>.
							</p>
<?php } ?>
						</div>
					</div>
				</div>
<?php } ?>
			</div>
		</section>

<?php PintarFooter(); ImportJS(); ?>
