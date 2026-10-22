<?php
$dni = 30973901;
$letra = ["T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E"];
$numero = $dni%23;
$indice = $letra[$numero];
echo "El DNI completo es: $dni$indice";
?>

