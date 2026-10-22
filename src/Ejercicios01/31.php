<?php
//31. Crear un script PHP que obtenga el cociente y el resto de dos números enteros positivos mediante restas sucesivas. 
$num1 = 8;
$num2 = 3;
$cociente = 0;
while ($num1 >= $num2):
    $num1 -= $num2;
    $cociente++;
endwhile;
$resto = $num1;
print "Cociente: " . $cociente . "<br>";
print "Resto: " . $resto;
?>
