<?php

/*55.Crear un script PHP que genera un número aleatorio entre 1 y 19, y muestra en
pantalla un triángulo rectángulo como el de la figura. */

$num = random_int(1,19);
$impar = 1;

for ($i = 1; $i <= $num; $i++) {
    $impar += 2;

    for ($m = $impar - 2; $m >= 1; $m -= 2) {
        print $m . " ";
    }print "<br>";
}
?>