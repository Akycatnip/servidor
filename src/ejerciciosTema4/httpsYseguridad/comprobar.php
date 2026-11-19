<?php
// Comprobar que la petición utiliza HTTPS.
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    http_response_code(403);
    die("Acceso prohibido. Solo se admite HTTPS.");
}

// Configurar la cookie de sesión antes de iniciar la sesión.
ini_set('session.use_cookies', '1');
ini_set('session.use_only_cookies', '1');
ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_secure', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_lifetime', '0');

session_start();

// Comprobar que se ha enviado el formulario.
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['mensaje'])) {
    http_response_code(400);
    die("Faltan datos.");
}

// Validar que el mensaje recibido sea una cadena.
if (!is_string($_POST['mensaje'])) {
    http_response_code(400);
    die("El mensaje no es válido.");
}

// Escapar el contenido antes de mostrarlo.
$mensaje = htmlspecialchars($_POST['mensaje'], ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mensaje recibido</title>
</head>
<body>
    <h1>Mensaje recibido</h1>
    <p><?= $mensaje ?></p>
    <a href="segura.php">Volver</a>
</body>
</html>
