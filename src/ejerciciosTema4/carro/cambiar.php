<?php
session_start();

// Catálogo de productos
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

// Comprobamos que se han recibido cantidades
if (!isset($_POST["cantidades"]) || !is_array($_POST["cantidades"])) {
    header("Location: carrito.php");
    exit();
}

// Validamos las cantidades
foreach ($_POST["cantidades"] as $producto => $cantidad) {

    if (
        !isset($catalogo[$producto]) ||
        !is_numeric($cantidad) ||
        (int)$cantidad != $cantidad ||
        $cantidad < 0 ||
        $cantidad > 10
    ) {
        header("Location: carrito.php");
        exit();
    }
}

// Modificamos el carrito
foreach ($_POST["cantidades"] as $producto => $cantidad) {

    if ($cantidad == 0) {
        unset($_SESSION["carrito"][$producto]);
    } else {
        $_SESSION["carrito"][$producto] = (int)$cantidad;
    }
}

// Volvemos al carrito
header("Location: carrito.php");
exit();

