<?php
require_once "Rectangulo.php";

$A = new Rectangulo(5,3);
$B = new Rectangulo(2,4);

//Areas
$areaA = $A->calcularArea();
$areaB = $B->calcularArea();
echo "El área de A es $areaA y el de B es $areaB . <br>";

//Perímetros
$perimetroA = $A->calcularPerimetro();
$perimetroB = $B->calcularPerimetro();
echo "El perímetro de A es $perimetroA y el de B $perimetroB. <br>";


//cambiamos A 6*2
$A->cambiarMedidas(6,2);
$nuevoAreaA = $A->calcularArea();
$nuevoAreaB = $B->calcularArea();
$nuevoPerimetroA = $A->calcularPerimetro();
$nuevoPerimetroB = $B->calcularPerimetro();

echo "El nuevo área de A es $nuevoAreaA y el de B es $nuevoAreaB. <br>";
echo "El  nuevo perímetro de A es $nuevoPerimetroA y el de B $nuevoPerimetroB. <br>";

//cambiamos A 0*8
$A->cambiarMedidas(0,8);
$nuevoAreaA2 = $A->calcularArea();
$nuevoAreaB2 = $B->calcularArea();
$nuevoPerimetroA2 = $A->calcularPerimetro();
$nuevoPerimetroB2 = $B->calcularPerimetro();

echo "El nuevo área de A es $nuevoAreaA2 y el de B es $nuevoAreaB2. <br>";
echo "El  nuevo perímetro de A es $nuevoPerimetroA2 y el de B $nuevoPerimetroB2. <br>";