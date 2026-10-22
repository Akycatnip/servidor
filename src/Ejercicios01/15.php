<?php
// 15. Crea un script PHP que asigna a variables el peso (en Kg) y la altura (en metros). 
// Luego, calcule el índice de masa corporal. Finalmente, muestre en pantalla el enunciado 
// Tu índice de masa corporal es <imc>, donde <imc> es el índice de masa corporal calculado con dos dígitos decimales.

$peso = 68;
$altura = 1.69;
$imc = $peso/($altura**2);
print $imc;
?>