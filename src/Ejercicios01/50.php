<?php

// 50.Crear un script PHP que genera un número aleatoriamente y muestre si es primo. 
// Un número es primo si no tiene divisores menores que su raíz cuadrada, excepto el 1.

$numero = random_int(1,100);
$raiz = sqrt($numero);
$esPrimo = True;
for($i=2; $i<$raiz;$i++){
    if ($numero%$i==0){
    $esPrimo = False;
    }}
if ($esPrimo){
    print $numero . " Es primo.";
    }else{
        print $numero . " No es primo.";
    }
?>