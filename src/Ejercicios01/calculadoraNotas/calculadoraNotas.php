<?php

$todoOk = false;
$nombre = "";
$media = null;
$error = "";
$calificacion = null;

function calcularMedia(array $notas): float
{
    $suma = 0;

    foreach ($notas as $nota) {
        $suma += $nota;
    }
    return $suma / count($notas);
}

function obtenerCalificacion(float $media)
{
    if ($media >= 0 && $media < 5) {
        return "Muy mal todo.";
    } elseif ($media >= 5 && $media < 6) {
        return "Por los pelos!";
    } elseif ($media >= 6 && $media < 7) {
        return "Está bien.";
    } elseif ($media >= 7 && $media < 9) {
        return "Tienes un notable, genial!";
    } else {
        return  "Eres un crack!";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $notas = $_POST["notas"] ?? [];

    if ($nombre === "") { //si nombre está vacío
        echo "Tienes que introducir un nombre";
    } elseif (!is_array($notas) || count($notas) !== 3) {//si las notas no van en array o no hay 3
        echo "Introduce tres notas";
    } else {
        $todoOk = true;

        foreach ($notas as $nota) { //si las notas están entre 1 y 10
            if (!is_numeric($nota) || $nota < 0 || $nota > 10) {
                $todoOk = false;
                $error = "Revisa las notas.";
            }
        }
    }

    if ($todoOk) {
        $media = calcularMedia($notas);
        $calificacion = obtenerCalificacion($media);
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media de las notas</title>
</head>

<body>
    <h1>Nota media</h1>
        <p>
            La nota media de <?= $nombre ?> es:
            <?= number_format($media, 2) ?>
            , así que: <?= $calificacion ?>
        </p>
    <a href="calculadoraNotas.html">Volver a la calculadora</a>

    
<br><br>
<table border="1">
    <tr>
        <th>Prueba</th>
        <th>Entrada</th>
        <th>Resultado esperado</th>
        <th>Resultado obtenido</th>
    </tr>
    <tr>
        <td>Caso 1</td>
        <td>4,5, y 6</td>
        <td>5, Por los pelos!</td>
        <td><? $prueba = calcularMedia([4,5,6]) ;?>
        <? obtenerCalificacion($prueba);?> </td>
    </tr>
    <tr>
        <td>Caso 2</td>
        <td>8,9 y 10</td>
        <td>9 Eres un crack!</td>
        <td><? $prueba = calcularMedia([8,9,10]) ;?>
        <? obtenerCalificacion($prueba);?></td>
    </tr>
    <tr>
        <td>Caso 3</td>
        <td>7,-1 y 8</td>
        <td>error</td>
        <td><?
    $notasPrueba = [7, -1, 8];
    $valido = true;

    foreach ($notasPrueba as $nota) {
        if ($nota < 0 || $nota > 10) {
            $valido = false;
        }
    }

    if ($valido) {
        $prueba = calcularMedia($notasPrueba);
        echo number_format($prueba, 2);
        echo " - ";
        echo obtenerCalificacion($prueba);
    } else {
        echo "Error: notas incorrectas";
    }
    ?></td>
    </tr>
    
</table>
</body>

</html>