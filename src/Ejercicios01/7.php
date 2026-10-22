<?php
//7. Crea un script PHP que calcule y muestre la siguiente operación aritmética: ( 3+2 2 2⋅5 )
$resultado = ((3 + 2) / (2 * 5)) ** 2;
echo "$resultado<br>";

$resultado2 = 0;
$a = 3.5;
$b = 6;
$c=4.25;
$resultado2 =(($a+2)/(2*$b))*((($c-4)/($a/$c))**2);
echo $resultado2; 

?>