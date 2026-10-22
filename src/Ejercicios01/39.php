<?php
/* 39. Crear un script PHP que genera hasta un máximo de 100 números aleatorios o hasta
la suma de sus cuadrados sea mayor que 10.000 y menor que 11.000. Al final, que
muestre también cuántos de ellos son impares. */

$suma = 0;
$impares = 0;
$i = 0;

while ($i < 100 && $suma <= 10000) {
    $num = random_int(1, 100);
    print $num . "<br>";
    $cuadrado = $num ** 2;
    if ($suma + $cuadrado < 11000) {
        $suma += $cuadrado;
        $i++;
        if ($num % 2 != 0) {
            $impares++;
        }
    }
}

print "Suma de los cuadrados: " . $suma . "<br>";
print "Cantidad de impares: " . $impares;
?>
