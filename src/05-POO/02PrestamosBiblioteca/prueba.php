<?php
require_once("Libro.php");
$libro1 = new Libro("Recetas Veggies", "Nero Moreno", false );
$libro2 = new Libro("Postres Ricos y Veggies", "Taro Moreno", false );

$ficha1 = $libro1->obtenerFicha();
$ficha2 = $libro2->obtenerFicha();
echo $ficha1;
echo $ficha2;

$libro1->prestar();
$libro1->prestar();

echo $libro1->obtenerFicha();

$libro1->devolver();
$libro1->devolver();

echo $libro1->obtenerFicha();
echo $libro2->obtenerFicha();



