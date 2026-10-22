<?php
//22.Crea un script PHP asigna a variables el número de personas adultas y niños que compran un billete para un viaje en globo. ,
//Cada adulto pesa 75Kg y cada niño 20Kg. Si la cesta del globo solo soporta 1000 libras, 
//muestra en pantalla si pueden subir juntas al globo o deben dividirse en dos viajes. Una libra son 453,5923699993531 gramos.

$adultos = random_int(2,10);
$ninos= random_int(2,20);
$totalkg = 453.59;
$pesonino = 25;
$pesoadult = 75;
$totalpeso = (($pesonino*$ninos)+($pesoadult*$adultos));
if ($totalpeso < $totalkg) print "Caben todos";
else print "No caben.";
?>
