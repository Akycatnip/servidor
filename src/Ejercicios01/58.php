<?php
//58.Crear un script PHP que asigna a una variable una frase. 
//Después genera aleatoriamente una letra y muestre en la pantalla cuántas veces aparece esa letra en la sentencia.
$frase = "una ranita iba caminando aha aha";
$num = random_int(65,90);//se ponen esos numeros porque corresponden al codigo asci de las letras en mayuscula
$caracter = strtolower(chr($num));
$total = substr_count($frase, $caracter);//strtolower pasa a minuscula
print "El caracter " . $caracter . " aparece " . $total . " veces en la cadena.";
?>
