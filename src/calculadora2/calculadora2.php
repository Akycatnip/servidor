<?php

$resultado = 0;
$error = "";

function sumar(float $a, float $b)
{
    return $a + $b;
}

function restar(float $a, float $b)
{
    return $a - $b;
}

function multiplicar(float $a, float $b)
{
    return $a * $b;
}

function dividir(float $a, float $b)
{
    return $a / $b;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = (float) $_POST["num1"];
    $num2 = (float) $_POST["num2"];
    $operacion = $_POST["operacion"];

    switch ($operacion) {
        case "sumar":
            $resultado = sumar($num1, $num2);
            break;

        case "restar":
            $resultado = restar($num1, $num2);
            break;

        case "multiplicar":
            $resultado = multiplicar($num1, $num2);
            break;

        case "dividir":
            if ($num2 == 0) {
                $error = "No se puede dividir entre cero.";
            } else {
                $resultado = dividir($num1, $num2);
            }
            break;

        default:
            $error = "La operación no está permitida.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>

<body>
    <h1>Resultado:</h1>
    <p>El resultado es: <?= $resultado ?></p>
    <a href="calculadora2.html">Volver a la calculadora</a>

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
        <td>8 y 2; dividir</td>
        <td>4</td>
        <td><?echo $prueba = dividir(8,4) ;?> </td>
    </tr>
    <tr>
        <td>Caso 2</td>
        <td>2.5 y 3; multiplicar</td>
        <td>7.5</td>
        <td><?echo $prueba = multiplicar(2.5,3) ;?></td>
    </tr>
    <tr>
        <td>Caso 3</td>
        <td>8 y 0; dividir</td>
        <td>error</td>
        <td><?echo $prueba = dividir(8,0) ;?></td>
    </tr>
    
</table>

</body>
</html>
