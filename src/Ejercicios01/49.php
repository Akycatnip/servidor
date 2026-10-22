<?php

/* 49. Crear un script PHP genera aleatoriamente un número y muestre si es perfecto. Un
número es perfecto cuando es igual a la suma de sus divisores. */

$num =  random_int(1,1000);
$suma = 0;

for ($i = 1; $i < $num; $i++) {
    if ($num % $i == 0) {
        $suma += $i;
    }
}
if ($suma == $num) print $num . " es perfecto.";
else print $num . " no es perfecto.";

?>