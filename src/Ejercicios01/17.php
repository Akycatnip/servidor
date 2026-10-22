<?php
// 17. Crea un script PHP que asigna a una variable una temperatura en ºC
//  y muestre en pantalla su equivalente en ºK y ºF.
$temperatura = 23;
$k = $temperatura + 276.15;
$f = ($temperatura*1.8)+32;
print "La temperatura es: ". $temperatura . " ºC, " . $k . " en ºK, y " . $f . " en 1 Farenheit. "
?>