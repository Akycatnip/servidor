<?php
require_once ("Producto.php");

$cuaderno= new Producto("C01", "cuaderno", 250,10);

$cuaderno->vender(3);
echo "Vendemos 3: " . $cuaderno->calcularValorStock() . "<br>";
$cuaderno->reponer(5);
echo "Reponemos 5: " . $cuaderno->calcularValorStock() . "<br>";
$cuaderno->vender(20);
echo "Vendemos 20: " . $cuaderno->calcularValorStock(). "<br>";
$cuaderno->reponer(-2);
echo "Reponemos -2: " . $cuaderno->calcularValorStock(). "<br>";
$cuaderno->vender(0);
echo "Vendemos 0: " . $cuaderno->calcularValorStock(). "<br>";
?>