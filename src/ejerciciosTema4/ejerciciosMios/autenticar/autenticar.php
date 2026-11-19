<?php
session_start();

require '../privado/usuarios.php';

$usuario = $_POST['usuario'] ?? '';
$clave = $_POST['clave'] ?? '';

if (
    $usuario === 'marta' &&
    password_verify($clave, $usuarios['marta'])
) {
//guardamos user y hora visita en el servidor
    $_SESSION['usuario'] = $usuario;
    $_SESSION['ultima_actividad'] = time();
//recordar user durante 7 días
    if (isset($_POST['recordar'])) {
        setcookie('usuario', $usuario, time() + (60 * 60 * 24 * 7), '/');
    }

    header('Location: privada.php');
    exit;

} else {

    echo "Usuario o contraseña incorrectos.";

}

?>
