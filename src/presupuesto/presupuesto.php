<?php

$enviado = false;
$error = "";
$nombre = "";
$tipo = "";
$noches = "";
$desayuno = false;
$tarifa = 0;
$alojamiento = 0;
$descuento = 0;
$importeDesayuno = 0;
$total = 0;

function obtenerTarifa(string $habitacion): float
{
    if ($habitacion == "individual") {
        return 45;
    } elseif ($habitacion == "doble") {
        return 70;
    } else {
        return 110;
    }
}

function calcularAlojamiento(float $tarifa, int $noches): float
{
    return $tarifa * $noches;
}

function calcularDescuento(float $alojamiento, int $noches): float
{
    if ($noches >= 7) {
        return $alojamiento * 0.10;
    } else {
        return 0;
    }
}

function calcularDesayuno(bool $incluido, int $noches): float
{
    if ($incluido) {
        return 8 * $noches;
    } else {
        return 0;
    }
}
// function calcularDesayuno(bool $incluido, int $noches): float{
//     return $incluido? 8* $noches : 0;
// }


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $enviado = true;

    $nombre = trim($_POST["nombre"] ?? "");
    $tipo = $_POST["tipo"] ?? "";
    $noches = $_POST["noches"] ?? "";

    if (isset($_POST["desayuno"])) {
        $desayuno = true;//comprobamos si está incluído
    }

    if ($nombre == "") {
        $error = "Debes introducir un nombre.";
    } elseif (
        $tipo != "individual" &&
        $tipo != "doble" &&
        $tipo != "suite"
    ) {
        $error = "Debes seleccionar un tipo de habitación válido.";
    } elseif (
        !is_numeric($noches) ||
        $noches < 1 ||
        $noches > 30 ||
        $noches != (int)$noches
    ) {
        $error = "El número de noches debe ser un entero entre 1 y 30.";
    }

    if ($error == "") {

        $tarifa = obtenerTarifa($tipo);

        $alojamiento = calcularAlojamiento(
            $tarifa,
            (int)$noches
        );

        $descuento = calcularDescuento(
            $alojamiento,
            (int)$noches
        );

        $importeDesayuno = calcularDesayuno(
            $desayuno,
            (int)$noches
        );

        $total = $alojamiento - $descuento + $importeDesayuno;
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presupuesto de alojamiento</title>
</head>

<body>
    <h1>Presupuesto de alojamiento</h1>

    <?php
    if ($enviado) {
        if ($error != "") {
            echo "<p>$error</p>";
        } else {
            echo "<h2>Presupuesto de alojamiento</h2>";
            echo "<p>Cliente: " . htmlspecialchars($nombre) . "</p>";
            echo "<p>Alojamiento: " . number_format($alojamiento, 2) . " €</p>";
            echo "<p>Descuento: " . number_format($descuento, 2) . " €</p>";
            echo "<p>Desayuno: " . number_format($importeDesayuno, 2) . " €</p>";
            echo "<p><strong>Total: " . number_format($total, 2) . " €</strong></p>";
        }
    }
    ?>

    <form action="" method="POST">
        <label for="nombre">Nombre del cliente:</label>
        <input type="text" id="nombre" name="nombre" required />
        <br><br>
        <label for="tipo">Tipo de habitación</label>
        <select id="tipo" name="tipo" required>
            <option value="">Selecciona el tipo de habitación</option>
            <option value="individual">Individual</option>
            <option value="doble">Doble</option>
            <option value="suite">Suite</option>
        </select>
        <br><br>
        <label>
            <input type="checkbox" name="desayuno" value="desayuno" />
            Desayuno
        </label>
        <br><br>
        <label for="noches">Número de noches(Máximo30)</label>
        <input type="number" id="noches" name="noches" min="1" max="30" required />
        <br><br>
        <input type="submit" value="Calcular presupuesto">
    </form>

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
            <td>Individual, 2 noches, sin desayuno</td>
            <td>90,00 €</td>
            <td>
                <?php
                $tarifaPrueba = obtenerTarifa("individual");
                $alojamientoPrueba = calcularAlojamiento($tarifaPrueba, 2);
                $descuentoPrueba = calcularDescuento($alojamientoPrueba, 2);
                $desayunoPrueba = calcularDesayuno(false, 2);

                $totalPrueba = $alojamientoPrueba - $descuentoPrueba + $desayunoPrueba;

                echo number_format($totalPrueba, 2) . " €";
                ?>
            </td>
        </tr>

        <tr>
            <td>Caso 2</td>
            <td>Doble, 7 noches, sin desayuno</td>
            <td>441,00 €</td>
            <td>
                <?php
                $tarifaPrueba = obtenerTarifa("doble");
                $alojamientoPrueba = calcularAlojamiento($tarifaPrueba, 7);
                $descuentoPrueba = calcularDescuento($alojamientoPrueba, 7);
                $desayunoPrueba = calcularDesayuno(false, 7);

                $totalPrueba = $alojamientoPrueba - $descuentoPrueba + $desayunoPrueba;

                echo number_format($totalPrueba, 2) . " €";
                ?>
            </td>
        </tr>

        <tr>
            <td>Caso 3</td>
            <td>Doble, 7 noches, con desayuno</td>
            <td>497,00 €</td>
            <td>
                <?php
                $tarifaPrueba = obtenerTarifa("doble");
                $alojamientoPrueba = calcularAlojamiento($tarifaPrueba, 7);
                $descuentoPrueba = calcularDescuento($alojamientoPrueba, 7);
                $desayunoPrueba = calcularDesayuno(true, 7);

                $totalPrueba = $alojamientoPrueba - $descuentoPrueba + $desayunoPrueba;

                echo number_format($totalPrueba, 2) . " €";
                ?>
            </td>
        </tr>
    </table>

</body>

</html>