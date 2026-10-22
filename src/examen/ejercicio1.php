<?php

$importeCompra = 65.00;
$zona = "peninsula";
$gastos = 0;
function calcularTotal($importeCompra, $zona)
{
    $gastos = 0;

//comprobar que el importe no sea negativo
    if ($importeCompra < 0) {
        return "El importe no es válido.";
    }

//comprobar zona
    elseif($zona !== "peninsula" && $zona !== "islas"){
        return "La zona no es válida.";
    }
    //comprobamos las 4 posibilidades
    elseif($zona == "peninsula" && $importeCompra >= 60){
        $gastos = 0;
    }
    elseif($zona == "islas" && $importeCompra >= 100){
        $gastos = 0;
    }
    elseif($zona == "peninsula" && $importeCompra < 60){
        $gastos = 5;
    }
    elseif($zona == "islas" && $importeCompra <100){
        $gastos = 12;
    }
    // calculamos el total
    if ($importeCompra > 0 ) {
        return $importeCompra + $gastos;
    }
}
//probamos la función
$total = calcularTotal(15, $zona ="islas");
echo "el importe es: " . $total;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicio1</title>
</head>
<body>
<h1>Ejercicio1</h1>
<p><?php echo "El importe de la compra es: $importeCompra"?></p>
<br>
<p><?php echo "La zona desde donde se hace el pedido es: $zona"?></p>
<br>
<p><?php echo "El total de la compra es: $total"?></p>
</body>
</html>
