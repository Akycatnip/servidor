<?php

// 56.Crear un script PHP que genera números aleatorios hasta el 0. 
// Finalmente, muestre en la pantalla el número más bajo y el más alto.
$numero = random_int(0, 30);
$masBajo = 30;
$masAlto = 0;//Lo hago así por si sale 0 de primeras
while ($numero != 0) {
    if ($numero < $masBajo) {
        $masBajo = $numero;
    }
    if ($numero > $masAlto) {
        $masAlto = $numero;
    }
    $numero = random_int(0, 30);
}
print "El número más bajo es: " . $masBajo. "<br>";
print "El número más alto es: " . $masAlto;
?>