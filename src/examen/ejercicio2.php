<?php
$productos = [
    ["nombre" => "Teclado", "precio" => 25.00, "stock" => 4],
    ["nombre" => "Ratón", "precio" => 15.50, "stock" => 0],
    ["nombre" => "Monitor", "precio" => 120.00, "stock" => 2],
    ["nombre" => "Cable USB", "precio" => 6.00, "stock" => 8]
];
//mostramos en tabla
foreach ($productos as $producto) {
    print"<table border='1'>";
    print "<td>$producto[nombre] </td>";
    print "<th>$producto[precio] €</th>";
    print "<th>$producto[stock] unidades.</th>";
    print "</table>";
}

//calculamos valor existencias
foreach ($productos as $producto) {
    $valor = $producto['precio'] * $producto['stock'];
}
//función para ver el estado actual de stock

function estadoStockint ($productos) {
    foreach ($productos as $producto) {
        if ($producto['stock'] <= 0){
            return  $producto['nombre'];
        }
            elseif($producto['stock'] <= 3){
                return "Necesitas reposición de " . $producto['nombre'];
            }

    }
}

foreach ($productos as $producto) {
    $acumulado = 0;
$valorTotal = $producto['precio'] * $producto['stock'];
$acumulado += $valorTotal;
    echo number_format($acumulado,2);}

$necesitanReposicion = estadoStockint($productos);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Control de existencias</title>
</head>
<body>
    <h1>Control de existencias</h1>
    <p><?php echo "El valor total del inventario es: $acumulado"?></p>
    <br>
    <p><?php echo "Los productos que requieren reposición son: $necesitanReposicion"?></p>

</body>
</html>