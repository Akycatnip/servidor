<?php

/* 44. Crear un script PHP que ingrese por teclado dos números y descubra si son amigos.
Dos números son amigos cuando ambos tienen la misma suma de sus divisores */

$num1 = random_int(1,100);
$num2 = random_int(1,100);
$suma1 = 0;
$suma2 = 0;

for ($i = 1; $i < $num1; $i++) {
    if ($num1 % $i == 0) {
        $suma1 = $suma1 + $i;
    }
}

for ($i = 1; $i < $num2; $i++) {
    if ($num2 % $i == 0) {
        $suma2 = $suma2 + $i;
    }
}

if ($suma1 == $num2 && $suma2 == $num1) {
    print $num1 . " y " . $num2 . " son amiguitos.";
} else {
    print $num1 . " y " . $num2 . " no se pueden ni ver.";
}
?>