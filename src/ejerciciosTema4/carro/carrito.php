<?php
session_start();

// Catálogo de productos (precios en céntimos)
$catalogo = array(
		"cuaderno" => array(
				"nombre" => "Cuaderno",
				"precio" => 250
		),
		"lapiz" => array(
				"nombre" => "Lápiz",
				"precio" => 80
		)
);

// Creamos el carrito si no existe
if (!isset($_SESSION["carrito"])) {
	$_SESSION["carrito"] = array();
}

// Contador de accesos
if (!isset($_SESSION["accesos"])) {
	$_SESSION["accesos"] = 1;
} else {
	$_SESSION["accesos"]++;
}

// Calculamos el total
$total = 0;
$articulos = array();

foreach ($catalogo as $producto => $datos) {
	
	$cantidad = 0;
	
	if (isset($_SESSION["carrito"][$producto])) {
		$cantidad = $_SESSION["carrito"][$producto];
	}
	
	if ($cantidad > 0) {
		
		$subtotal = $datos["precio"] * $cantidad;
		$total += $subtotal;
		
		$articulos[] = array(
				"nombre" => $datos["nombre"],
				"cantidad" => $cantidad,
				"subtotal" => $subtotal
		);
	}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Mi carrito</title>
</head>
<body>

<h1>Mi carrito</h1>

<p>Accesos a esta página: <?= $_SESSION["accesos"] ?></p>

<h2>Productos del carrito</h2>

<?php if (count($articulos) > 0): ?>
	
	<ul>
		<?php foreach ($articulos as $articulo): ?>
			
			<li>
				<?= $articulo["nombre"] ?> -
				Cantidad: <?= $articulo["cantidad"] ?> -
				Subtotal:
				<?= number_format($articulo["subtotal"] / 100, 2, ",", ".") ?> EUR
			</li>
		
		<?php endforeach; ?>
	</ul>

<?php else: ?>
	
	<p>El carrito está vacío.</p>

<?php endif; ?>

<h3>
	Total:
	<?= number_format($total / 100, 2, ",", ".") ?> EUR
</h3>

<hr>

<h2>Modificar cantidades</h2>

<form action="cambiar.php" method="POST">
	
	<?php foreach ($catalogo as $producto => $datos): ?>
		
		<p>
			<?= $datos["nombre"] ?> -
			<?= number_format($datos["precio"] / 100, 2, ",", ".") ?> EUR
			
			<input
					type="number"
					name="cantidades[<?= $producto ?>]"
					min="0"
					max="10"
					step="1"
					value="<?= isset($_SESSION["carrito"][$producto]) ? $_SESSION["carrito"][$producto] : 0 ?>"
			>
		</p>
	
	<?php endforeach; ?>
	
	<input type="submit" value="Actualizar carrito">

</form>

<form action="vaciar.php" method="POST">
	<input type="submit" value="Vaciar carrito">
</form>

</body>
</html>

