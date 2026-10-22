<?php

//59.Crear un script PHP para buscar los primeros 5 números perfectos.

$num = 1;
$perfecto = 0;

while ($perfecto < 5) {
    $suma = 0;

    for ($i = 1; $i < $num; $i++) {
        if ($num % $i == 0) {
            $suma += $i;
        }
    }

    if ($suma == $num) {
        print $num . "<br>";
        $perfecto++;
    }
    $num++;
}//no da tiempo a q se ejecute porque tarda en buscar el 5

?>