<?php
//51. Crear un script que genera aleatoriamente un año de nacimiento desde 1900 hasta 2000.y
//Después debe mostrar en pantalla cada año desde su año de nacimiento hasta el año actual.
$anio = random_int(1900,2026);
$actual = 2026;
for($i = $anio; $i<= 2026; $i++){
    print $i . "<br>";
}
?>