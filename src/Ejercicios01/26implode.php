<?php

// 26.Crea un script PHP que asigna a tres variables números enteros aleatorios
//  y los muestra en orden ascendente. Además mostrará también si la generación aleatoria fue en orden. 
$a = random_int(1, 100);
$b = random_int(1, 100);
$c = random_int(1, 100);

$lista = [$a, $b, $c];
$ordenada = $lista;
sort($ordenada);
echo "Números generados: " . implode(", ", $lista) . "<br>"; //como el join con o sin separadores
echo "Números ordenados: " . implode(", ", $ordenada) . "<br>";
if ($lista == $ordenada) {
    echo "La generación aleatoria fue en orden.";
} else {
    echo "La generación aleatoria NO fue en orden.";
}
?>
