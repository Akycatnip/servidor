<?php

// 57. Crear un script PHP que genera aleatoriamente una cadena de caracteres y
//  luego muestre en la pantalla cada letra de la cadena comenzando con la última 
//  hasta la primera. Pista: función chr().
$lista =[];
for($i=0; $i<15;$i++){
    $num = random_int(65,90);
    $enletra = chr($num);
    $lista[] = $enletra;}
for($i=14; $i>0;$i--){
    print $lista[$i] . " , ";
}

?>
