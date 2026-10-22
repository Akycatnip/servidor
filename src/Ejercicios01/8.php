<?php
// 8. Crea un script PHP que declare las variables a, b y c con valores 3.5, 6 y 4.25 respectivamente. 
// Luego calcule y muestre en pantalla la siguiente operación aritmética: ( a+2 2⋅b )⋅( c−4 2 a c
$a = 3.5;
$b = 6;
$c = 4.25;
$resultado = (($a + 2)/(2*$b))*((($c-4)/($a/$c))**2);
print number_format($resultado,2);

?>