<?php
//20.Crea un script PHP que genera aleatoriamente un número entero y muestre si es par o impar.

$numero = random_int(1,100);
if ($numero %2 == 0){
    echo $numero . " es par.";
}else {
    echo $numero . " es impar.";
}
?>