<?php
$numeros = [12, 5, 28, 3, 17, 9];
$mayor = $numeros[0];
$menor = $numeros[0];


foreach ($numeros as $numero) {
    if ($numero > $mayor) {
        $mayor = $numero;
    }
}
print ($mayor . " es el mayor. ");

foreach ($numeros as $numero) {
    if ($numero < $menor) {
        $menor = $numero;
    }
}

print ($menor . " es el menor. <br>");



function calcularMedia(array $numeros){
    foreach ($numeros as $numero) {
        $total = 0;
        $total += $numero;}
        $media = $total / count($numeros);
    return $media;

    }
echo calcularMedia($numeros);



?>
