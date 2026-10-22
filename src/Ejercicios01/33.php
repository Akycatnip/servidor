<?php

// 33. Crear un script PHP que muestre la lista de intereses y el capital acumulado producido 
// cada año por un capital inicial C, con un interés anual R durante N años. El interés obtenido 
// anualmente se calcula con la fórmula: I=C⋅R 100 Supongamos que el capital inicial es 1.000.000€, 
// el interés anual del 4% y se aplica durante 20 años. El capital se incrementa 
// con el interés producido cada año.
$c = 1000000;
$r = 0.04;
$n = 20;
for ($i= 1; $i<= $n; $i++){
    $interes = $c*$r;
    $c = $c + $interes;
    print "Año " . $i . " Interés = ". number_format($interes,2) . " €. Total: " . number_format($c,2) . "<br>";
}
?>