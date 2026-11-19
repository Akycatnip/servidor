<?php
//cargamos el archivo del user
require '../privado/usuarios.php';

$authOK = false;
//comprobamos si existen las dos variables de autenticación
if (
    isset($_SERVER['PHP_AUTH_USER']) &&
    isset($_SERVER['PHP_AUTH_PW'])
) {
    $usuario = $_SERVER['PHP_AUTH_USER'];
    $clave = $_SERVER['PHP_AUTH_PW'];
        //comprobamos q el user es marta
    if (
        $usuario === 'marta' &&
        //comprobamos la contraseña
        password_verify($clave, $usuarios['marta'])
    ) {
        $authOK = true;
    }
}

if (!$authOK) {

    header('WWW-Authenticate: Basic realm="Acceso restringido"');
    header('HTTP/1.0 401 Unauthorized');

    die("Acceso denegado");
}

echo "Bienvenida, " . htmlspecialchars($usuario);

?>