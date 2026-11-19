<?php

$numeros = [];
$contador = 0;
$suma = 0;
for ($i =1; $i<=10; $i++) {
    $num = random_int(1,100);
    $numeros[] = $num; //añade el num al array

}
echo "<br><br>" . implode(',', $numeros); //imprime los num del array separados por ,

foreach ($numeros as $numero) {
    $media = 0;
    $total = 0;
    $total+=$numero;
    $media = $total/count($numeros);
}

echo "<br><br>La media es $media y el total es $total";
function esPrimo($numero)
{
    if ($numero < 2) {
        return false;
    }

    for ($i = 2; $i < $numero; $i++) {
        if ($numero % $i == 0) {
            return false;
        }
    }

    return true;
}



foreach($numeros as $numero) {
    if (esPrimo($numero)) {
        $contador += 1;
        $suma += $numero;
    }
}
echo "<br><br>Hay $contador números primos y su suma es: $suma";