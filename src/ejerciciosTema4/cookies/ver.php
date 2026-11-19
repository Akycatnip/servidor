<?php
// Recuperamos las cookies
$modo = $_COOKIE["modo"] ?? "claro";
$idioma = $_COOKIE["idioma"] ?? "es";

// Definimos los valores permitidos
$modosPermitidos = ["claro", "oscuro"];
$idiomasPermitidos = ["es", "en"];

// Validamos las cookies
if (!is_string($modo) || !in_array($modo, $modosPermitidos, true)) {
    $modo = "claro";
}

if (!is_string($idioma) || !in_array($idioma, $idiomasPermitidos, true)) {
    $idioma = "es";
}

// Definimos los colores desde el servidor
if ($modo === "oscuro") {
    $fondo = "#330066";
    $texto = "#ccffff";
} else {
    $fondo = "#ffccff";
    $texto = "#9900cc";
}

// Definimos el saludo
if ($idioma === "en") {
    $saludo = "Hello! I´m Muzzy's";
} else {
    $saludo = "¡Hola! Bienvenido a mi super web.";
}

?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($idioma) ?>">

<head>
    <meta charset="UTF-8">
    <title>Mis preferencias</title>
</head>

<body style="background-color: <?= $fondo ?>; color: <?= $texto ?>;">

<h1><?= htmlspecialchars($saludo) ?></h1>

<p>Modo seleccionado: <?= htmlspecialchars($modo) ?></p>

<p>Idioma seleccionado: <?= htmlspecialchars($idioma) ?></p>

<a href="formulario.html">Cambiar preferencias</a>

<form action="borrar.php" method="POST">
    <button type="submit">Borrar preferencias</button>
</form>

</body>
</html>