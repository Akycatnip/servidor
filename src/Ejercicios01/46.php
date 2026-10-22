<?php
/*46.Crear un script PHP que resuelva una ecuación de segundo grado(ax^2+bx+c=0). Para ello, se
asignan los coeficientes A, B y C y luego, se calculan las posibles soluciones. */

$a = random_int(1,100);
$b = random_int(1,100);
$c = random_int(1,100);

$discriminante = $b * $b - 4 * $a * $c; //es necesario porque puede tener dos soluciones

if ($discriminante > 0) {
    $x1 = (-$b + sqrt($discriminante)) / (2 * $a);
    $x2 = (-$b - sqrt($discriminante)) / (2 * $a);

    print "Solución 1 : " . $x1 . "<br>";
    print "Solución 2: " . $x2;

} elseif ($discriminante == 0) {
    $x = -$b / (2 * $a);

    print "Solución única: " . $x;

} else {
    print "No existen soluciones reales.";
}


?>