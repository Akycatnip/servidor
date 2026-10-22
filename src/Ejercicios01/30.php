<?php
//30.Crear un script PHP que obtenga el producto de dos números enteros positivos mediante sumas sucesivas.
$a = 5;
$b = 5;
$resultado = 0;
for ($i = 1; $i<=$b;$i++){
   $resultado +=$a;
   }
print $resultado;