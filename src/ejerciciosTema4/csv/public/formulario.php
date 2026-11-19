<?php
require __DIR__ . "/../autenticar/sesion.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["usuario"])) {
    header("Location: /autenticar/login.php");
    exit();
}

if (!isset($_SESSION["ultima_actividad"]) || time() - $_SESSION["ultima_actividad"] > 900) {
    session_unset();
    session_destroy();
    header("Location: /autenticar/login.php");
    exit();
}

$_SESSION["ultima_actividad"] = time();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guardar CSV</title>
</head>
<body>
    <h1>Guardar un registro</h1>

    <form action="guardar.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <br>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>

        <br>

        <input type="submit" value="Guardar">
    </form>

    <p><a href="listar.php">Ver registros</a></p>
    <p><a href="descargar.php?id=guia">Descargar guía</a></p>
    <p><a href="descargar.php?id=csv">Descargar CSV</a></p>
    <p><a href="guia_stream.php">Descargar guía desde archivo</a></p>
</body>
</html>
