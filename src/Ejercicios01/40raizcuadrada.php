<?php

/*40.Crear un script PHP que genera números aleatorios entre 1 y 100 números hasta
uno que tenga raíz cuadrada entera. Mostrar todos los números con sus raíces
cuadradas. */

$num = random_int(1,100);
while(sqrt($num)!= floor(sqrt($num))){
    print $num . " : " . sqrt($num) . "<br>";
    $num = random_int(1,100);
    }
?>