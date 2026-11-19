<?php
$modo = $_COOKIE["modo"];
$idioma = $_COOKIE["idioma"];

//modos
if($modo === "oscuro"){
    $fondo = "#330066";
    $texto = "#ccffff";
}else{
    $fondo = "#ffccff";
    $texto = "#9900cc";
}
//idiomas
if($idioma === "es"){
    $saludo = "Holi caracoli!!";
}else{
    $saludo = "Hello, I'm Muzzy!";
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
