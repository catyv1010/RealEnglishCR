<?php
// Controlador del modulo de inicio para Real English CR
// Cada formulario se reconoce por el name del boton de submit.
// Por ahora solo muestro lo que llega; la conexion con Oracle la armamos en el Avance 2.

// iniciar sesion
if (isset($_POST["btnLogin"])) {

    $correo     = $_POST['correo'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    echo "Datos recibidos: " . htmlspecialchars($correo);
    echo "<br><br>Esta parte queda lista para el Avance 2 cuando conectemos con Oracle.";
    echo "<br><a href='../view/vInicio/IniciarSesion.php'>Volver</a>";
}

// registrar usuario
if (isset($_POST["btnRegistrar"])) {

    $cedula = $_POST['cedula'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';

    echo "Datos recibidos: " . htmlspecialchars($nombre) . " - " . htmlspecialchars($cedula);
    echo "<br><br>Falta conectar con la base, eso lo terminamos en el Avance 2 con Oracle.";
    echo "<br><a href='../view/vInicio/RegistrarUsuarios.php'>Volver</a>";
}

// contacto
if (isset($_POST["btnContacto"])) {

    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    echo "Mensaje recibido de: " . htmlspecialchars($name) . " (" . htmlspecialchars($email) . ")";
    echo "<br>Asunto: " . htmlspecialchars($subject);
    echo "<br><br>El guardado del mensaje en la base queda para el Avance 2 con Oracle.";
    echo "<br><a href='../view/vInicio/Contacto.php'>Volver</a>";
}
