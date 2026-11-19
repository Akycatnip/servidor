<?php

function obtenerPrecioBocadillo(string $tipo): float
{

    $precios = [
        "pollo" => 4.50,
        "tortilla" => 3.50,
        "vegetal" => 4.00
    ];

    foreach ($precios as $nombre => $precio) {
        if ($tipo == $nombre) { //se comprueba q el tipo d ebocadillo está en el array
            return $precio;
        }
    }

    return -1;
}
function calcularPrecioExtras(array $extras): float
{

    $precios = [
        "queso" => 0.50,
        "tomate" => 0.30,
        "salsa" => 0.20
    ];

    $totalExtras = 0;

    foreach ($extras as $extra) {

        $encontrado = false; //por si no hay extras

        foreach ($precios as $nombre => $precio) {

            if ($extra == $nombre) { //si el extra existe se suma
                $totalExtras += $precio;
                $encontrado = true;
            }
        }

        if ($encontrado == false) {
            return -1; //-1 sería el error para detectarlo luego
        }
    }

    return $totalExtras;
}


// Calcular el total del pedido
function calcularTotal(
    float $precioBase,
    float $precioExtras,
    int $cantidad
): float {

    return ($precioBase + $precioExtras) * $cantidad;
}


$error = "";
$nombre = "";
$tipo = "";
$cantidad = 0;
$precioUnidad = 0;
$total = 0;
$pedidoCorrecto = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"] ?? "";
    $tipo = $_POST["tipo"] ?? "";
    $cantidadTexto = $_POST["cantidad"] ?? "";
    $extras = $_POST["extras"] ?? [];


    
    if (!is_string($nombre) || trim($nombre) == "") {// Validar nombre

        $error = "Debes introducir un nombre.";

        
    } elseif (
        !is_string($tipo) ||
        obtenerPrecioBocadillo($tipo) == -1// Validar tipo de bocadillo y si es -1 es error
    ) {

        $error = "El tipo de bocadillo no es válido.";

        
    } elseif (
        !is_numeric($cantidadTexto) ||
        $cantidadTexto < 1 ||
        $cantidadTexto > 10 ||
        (int)$cantidadTexto != $cantidadTexto // Validar cantidad
    ) {

        $error = "La cantidad debe ser un entero entre 1 y 10.";

       
    } elseif (!is_array($extras)) { // Comprobar que los extras sean un array

        $error = "Los extras no son válidos.";
    } else {

        $cantidad = (int)$cantidadTexto;

        $precioBase = obtenerPrecioBocadillo($tipo);
        $precioExtras = calcularPrecioExtras($extras);


        
        if ($precioExtras == -1) {// Comprobar que todos los extras sean válidos

            $error = "Hay algún extra que no es válido.";
        } else {

            $precioUnidad = $precioBase + $precioExtras;

            $total = calcularTotal(
                $precioBase,
                $precioExtras,
                $cantidad
            );

            $pedidoCorrecto = true;
        }
    }
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen del pedido</title>
</head>

<body>

    <h1>Resumen del pedido</h1>

    <?php if ($error != "") { ?>

        <p><?php echo $error; ?></p>

    <?php } elseif ($pedidoCorrecto == true) { ?>

        <p>Cliente: <?php echo $nombre; ?></p>

        <p>Bocadillo: <?php echo $tipo; ?></p>

        <p>
            Precio por unidad con extras:
            <?php echo number_format($precioUnidad, 2); ?> €
        </p>

        <p>Cantidad: <?php echo $cantidad; ?></p>

        <p>
            Total del pedido:
            <?php echo number_format($total, 2); ?> €
        </p>

    <?php } ?>

    <p><a href="pedido.html">Volver al formulario</a></p>

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
            <td>2 bocadillos de pollo con queso y salsa</td>
            <td>(4,50 + 0,50 + 0,20) × 2 = 10,40 €</td>
            <td>
                <?php
                $precioBase = obtenerPrecioBocadillo("pollo");
                $precioExtras = calcularPrecioExtras(["queso", "salsa"]);

                $prueba = calcularTotal($precioBase, $precioExtras, 2);

                echo number_format($prueba, 2);
                echo " €";
                ?></td>
        </tr>
        <tr>
            <td>Caso 2</td>
            <td>1 bocadillo de tortilla sin extras</td>
            <td>3,50 €</td>
            <td>
                <?php
                $precioBase = obtenerPrecioBocadillo("tortilla");
                $precioExtras = calcularPrecioExtras([]);

                $prueba = calcularTotal($precioBase, $precioExtras, 1);

                echo number_format($prueba, 2);
                echo " €";
                ?>
            </td>
        </tr>
        <tr>
            <td>Caso 3</td>
            <td>11 bocadillos de pollo</td>
            <td>Error: cantidad entre 1 y 10</td>
            <td>
                <?php
                $cantidadPrueba = 11;

                if ($cantidadPrueba < 1 || $cantidadPrueba > 10) {
                    echo "Error: cantidad incorrecta";
                } else {
                    $precioBase = obtenerPrecioBocadillo("pollo");
                    $precioExtras = calcularPrecioExtras([]);

                    $prueba = calcularTotal(
                        $precioBase,
                        $precioExtras,
                        $cantidadPrueba
                    );

                    echo number_format($prueba, 2);
                    echo " €";
                }
                ?>
            </td>
        </tr>

    </table>

</body>

</html>