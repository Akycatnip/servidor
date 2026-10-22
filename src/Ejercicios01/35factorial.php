<?php

//35.Crear un script PHP que calcule y muestre el factorial de un número.Factorial = desde 1 a ese numero todos multiplicados
$numero = random_int(1,50);
$total=1;
for($i=$numero;$i>=1; $i--):
    $total *= $i;
endfor;
print "El factorial de " . $numero . " es: " . $total;
?>