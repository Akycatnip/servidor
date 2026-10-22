<?php

/* 47. Crear un script PHP que genera aleatoriamente 3 números (entre 1 y 20) 5 veces.
Cada vez los números deben mostrarse en orden ascendente. */

$i = 1;

while ($i <= 5) {
    $numeros = [
        random_int(1, 20),
        random_int(1, 20),
        random_int(1, 20)
    ];
    sort($numeros);
    print $numeros[0] . " - " . $numeros[1] . " - " . $numeros[2] . "<br>";
    $i++;
}

?>