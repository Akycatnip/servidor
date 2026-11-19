<?php
session_start();
$catalogo = [
		"cuaderno" => [
				"nombre" => "Cuaderno",
				"precio" => 2.50
		],
		"lapiz" => [
				"nombre" => "Lápiz",
				"precio" => 0.80
		]
];
if(!isset($_SESSION["carrito"])){
    $_SESSION["carrito"] = [];
}

//contador de visitas
if(!isset($_SESSION["visitas"])){
    $_SESSION["visitas"] = 1;
}else{
    $_SESSION["visitas"] ++;
}

// Calculamos el total y preparamos las filas
$total = 0;
$filas = "";

foreach ($catalogo as $producto => $datos) {
	
	$cantidad = 0;
	if (isset($_SESSION["carrito"][$producto])) {
		$cantidad = $_SESSION["carrito"][$producto];
	}
	
	if ($cantidad > 0) {
		$subtotal = $datos["precio"] * $cantidad;
		$total += $subtotal;
		
		$filas .= "<tr>
            <td>{$datos['nombre']}</td>
            <td>{$cantidad}</td>
            <td>{$subtotal} €</td>
        </tr>";
	}
}

if ($filas == "") {
	$filas = '<tr><td colspan="3">El carrito está vacío</td></tr>';
}

// Cantidades actuales
$cantidadCuaderno = $_SESSION["carrito"]["cuaderno"] ;
$cantidadLapiz = $_SESSION["carrito"]["lapiz"] ;
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Mi carrito</title>
</head>
<body>

<h1>Mi carrito</h1>

<p>Visitas: <?= $_SESSION["visitas"] ?></p>

<h2>Mi carro antes de que me lo roben</h2>


<h2>Modificar cantidades</h2>

<form action="cambiar.php" method="POST">
	
	<p>Cuaderno:
		<input type="number" name="cantidades[cuaderno]"
		       min="0" max="10" value="<?= $cantidadCuaderno ?>">
	</p>
	
	<p>Lápiz:
		<input type="number" name="cantidades[lapiz]"
		       min="0" max="10" value="<?= $cantidadLapiz ?>">
	</p>
	<table border ="2">
		<tr>
			<th>Producto</th>
			<th>Cantidad</th>
			<th>Subtotal</th>
		</tr>
		
		<?= $filas ?>
	
	</table>
	
	<h3>Total: <?= $total ?> €</h3>
	
	
	<input type="submit" value="Actualizar carrito">

</form>

<form action="vaciar.php" method="POST">
	<input type="submit" value="Robar el carro">
</form>

</body>
</html>