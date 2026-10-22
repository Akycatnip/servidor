<?php
//52.Crear un script PHP que genera un número entero positivo y muestre en pantalla cada número impar desde 1 hasta ese número separado por coma.
$numero = random_int(1,100);
for ($i=0; $i<= $numero; $i++){
    if ($i%2 !== 0){
        print $i . " , ";
    }
}
?>
