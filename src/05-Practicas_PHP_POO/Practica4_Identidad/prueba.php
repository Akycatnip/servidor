<?php

require_once "modelo.php";

$a = new Ficha("Ana", new Direccion("Córdoba"));
$b = $a;
$c = clone $a;

echo "a === b: " . ($a === $b ? "1" : "0") . PHP_EOL;
echo "a === c: " . ($a === $c ? "1" : "0") . PHP_EOL;
echo "a == c: " . ($a == $c ? "1" : "0") . PHP_EOL;

mudar($b, "Sevilla");

echo "Original: " . $a . PHP_EOL;
echo "Clon: " . $c . PHP_EOL;

$d = copiaEn($a, "Granada");

echo "Copia en Granada: " . $d . PHP_EOL;
echo "Original después de copiaEn: " . $a . PHP_EOL;

echo "Propiedades públicas de a:" . PHP_EOL;
foreach ($a as $propiedad => $valor) {
    if ($valor instanceof Direccion) {
        echo $propiedad . ": " . $valor->ciudad . PHP_EOL;
    } else {
        echo $propiedad . ": " . $valor . PHP_EOL;
    }
}

$t1 = new Testigo();
$t2 = $t1;

unset($t1);
echo "Todavía existe t2" . PHP_EOL;

unset($t2);
echo "Fin" . PHP_EOL;
