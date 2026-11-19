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
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobar HTTPS</title>
</head>
<body>
    <h1>Comprobar HTTPS y seguridad</h1>

    <form action="comprobar.php" method="POST">
        <label for="mensaje">Escribe un mensaje:</label>
        <input type="text" id="mensaje" name="mensaje" required>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
