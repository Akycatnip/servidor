<?php
session_start();
$catalogo  = [
    "cuaderno"=> 2.50,
    "lapiz" =>0.80
];
if(!isset($_POST["cantidades"]) || !is_array($_POST["cantidades"])){
    header("Location: carrito.php");
    exit;
}

foreach($_POST["cantidades"] as $producto => $cantidad){
    if(!isset($catalogo[$producto]) || !is_numeric($cantidad) || (int)$cantidad != $cantidad || $cantidad <0 || $cantidad >10){
    header("Location: carrito.php");
    exit;}
}

foreach($_POST["cantidades"] as $producto => $cantidad){
    if($cantidad ==0){
        unset($_SESSION["carrito"][$producto]);

    }else{
        $_SESSION["carrito"][$producto] = (int)$cantidad;
    }
}
//redirigimos al carrito
header("Location:carrito.php");
exit;