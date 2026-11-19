<?php
session_start();
//comprobamos si el user ha iniciado sesión
if (!isset($_SESSION['usuario'])) {

    header('Location: login.html');
    exit;

}
//comprobamos si lleva más de 15 minutos
if (time() - $_SESSION['ultima_actividad'] > 900) {
    //destruimos sesión
    session_unset();
    session_destroy();

    header('Location: login.html');
    exit;

}

$_SESSION['ultima_actividad'] = time();

echo "Bienvenida, " . htmlspecialchars($_SESSION['usuario']);

?>