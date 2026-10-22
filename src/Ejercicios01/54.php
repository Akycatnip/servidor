<?php
// 54.Crear un script que muestre en pantalla la tabla de multiplicar del 1 al 10.
for($tabla = 1; $tabla <= 10; $tabla++):
    for($i = 1; $i <= 10; $i++):
        $total = $tabla * $i;
        print $tabla . " * " . $i . " = " . $total . "<br>";
    endfor;
endfor;
?>