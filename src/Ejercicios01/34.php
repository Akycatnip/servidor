<?php
/*34. Crear un script PHP que asigna a variables dos números enteros positivos N y M, y
luego calcule y muestre los múltiplos de N menor que M */
$n = random_int(1,100);
$m = random_int(1,100);

for ($i = 1; $n * $i < $m; $i++) {
    print $n * $i . ", ";
}

$i=1;
while ($n*$i<$m){
    print $n * $i . ", ";
    $i++;
}
?>