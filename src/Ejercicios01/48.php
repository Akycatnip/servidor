<?php

/*48. Repetir el ejercicio anterior pero, se debe generar un número más que indique el tipo
de orden para mostrar los números (ascendente o descendente). */

$i = 1;

while ($i <= 5) {
    $numeros = [
        random_int(1, 20),
        random_int(1, 20),
        random_int(1, 20),
    ];
    $orden = random_int(1,20);
    if ($orden%2 == 0){
    sort($numeros);
    print $numeros[0] . " - " . $numeros[1] . " - " . $numeros[2] . "<br>";
    }else{rsort($numeros);
    print $numeros[0] . " - " . $numeros[1] . " - " . $numeros[2] . "<br>";
    }
    $i++;
}
?>