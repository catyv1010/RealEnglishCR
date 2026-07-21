<?php
// Confirmacion de pago.
require_once __DIR__ . "/../../model/Catalogo.php";
require_once __DIR__ . "/../../model/CrudModel.php";
session_start();

$pagoId  = isset($_GET['pago']) ? preg_replace('/\D/', '', $_GET['pago']) : '';
$pago    = null;
$errorBD = null;

// requiere sesion
if (!isset($_SESSION['estudiante_id'])) {
    header('Location: IniciarSesion.php');
    exit();
}

try {
    if ($pagoId !== '') {
        $pago = CrudModel::obtener('pagos', $pagoId);

        // el pago debe ser del estudiante en sesion
        if ($pago !== null) {
            $matricula = CrudModel::obtener('matriculas', $pago['MATRICULA_ID']);
            if ($matricula === null ||
                (string) $matricula['ESTUDIANTE_ID'] !== (string) $_SESSION['estudiante_id']) {
                $pago = null;
            }
        }
    }
} catch (Exception $e) {
    $errorBD = $e->getMessage();
}

$titulo_pagina = "Real English CR - Gracias";
include_once "../LayoutExterno.php";
ImportCSS($titulo_pagina);
PintarHeader();
?>

	<section class="section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">

					<div style="background:#fff;border:1px solid #e5e8e8;border-radius:12px;padding:50px 40px;">
						<span class="ti-check-box" style="font-size:64px;color:#1e8449;"></span>
						<h1 style="color:#1e8449;margin-top:20px;"><?= $pago !== null ? '¡Listo, quedaste matriculada!' : 'Comprobante no disponible' ?></h1>

<?php if ($errorBD !== null) { ?>
						<p style="color:#c0392b;"><?= htmlspecialchars($errorBD) ?></p>
<?php } elseif ($pago !== null) { ?>
						<p style="font-size:18px;">
							Registramos tu pago de <b><?= Catalogo::colones($pago['MONTO']) ?></b>
							por <b><?= htmlspecialchars(strtolower($pago['METODO_PAGO'] ?? 'metodo pendiente')) ?></b>
							el <?= htmlspecialchars(Catalogo::fecha($pago['FECHA_PAGO'])) ?>.
						</p>
						<p style="color:#7f8c8d;">
							Comprobante n.º <?= htmlspecialchars($pago['PAGO_ID']) ?> &middot;
							Matrícula n.º <?= htmlspecialchars($pago['MATRICULA_ID']) ?> &middot;
							Estado: <b><?= htmlspecialchars($pago['ESTADO']) ?></b>
						</p>
						<p style="color:#7f8c8d;font-size:14px;margin-top:25px;">
							Te llega el detalle al correo con el que te registraste.
							Nos vemos en la primera lección.
						</p>
<?php } else { ?>
						<p>No encontramos ese comprobante a tu nombre. Revisá tus matrículas.</p>
<?php } ?>

						<a class="btn_one" href="Principal.php" style="margin-top:25px;">Volver al inicio</a>
						<a class="header-btn" href="Cursos.php" style="margin-top:25px;">Ver más cursos</a>
					</div>

				</div>
			</div>
		</div>
	</section>

<?php PintarFooter(); ImportJS(); ?>
