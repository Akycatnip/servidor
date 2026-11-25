<?php
require_once ("Producto.php");
require_once ("Carrito.php");

$cuaderno= new Producto("C01", "cuaderno", 250,10);
$lapiz = new Producto("L01", "lapiz", 80,20);
$carrito= new Carrito();



echo "Añadir 2 cuadernos " . ($carrito-> agregar($cuaderno,2) ? "true" : "false"). "<br>";
echo "Añadir 3 lápices " . ($carrito-> agregar($lapiz,3)? "true" : "false") .  "<br>";
echo "Total " . ($carrito-> calcularTotal()) . "<br>";

echo "Añadir 1 cuaderno " . ($carrito-> agregar($cuaderno,1)? "true" : "false") .  "<br>";
echo "Unidades en el carro " . ($carrito-> contarUnidades() . "unidades. Total = " . $carrito->calcularTotal() ) . "<br>";


echo "Añadir 8 cuadernos " . ($carrito-> agregar($cuaderno,8)? "true" : "false") .  "<br>";
echo "Añadir 0 lápices " . ($carrito-> agregar($lapiz,0)? "true" : "false") .  "<br>";

echo "Eliminar L01 " . ($carrito-> eliminar("L01")? "true" : "false") .  "<br>";

echo "Eliminar un código inexistente " . ($carrito-> eliminar("X99")? "true" : "false") .  "<br>";

echo "Unidades " . ($carrito-> contarUnidades()) . " s. Total = " . $carrito->calcularTotal() .  "<br>";

echo "Stock cuadernos " . ($cuaderno->getStock()) .  "<br>";
?>