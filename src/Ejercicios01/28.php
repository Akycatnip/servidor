<?php

/*28. Crea un script PHP que asigna dos números enteros positivos a dos variables,
 X y N. A continuación calcula y muestra la potencia N de X. (No utilizar el operador de Ppotencia).*/
$x = 8;
$n = 9;
$resultado = 1;
for ($i=1; $i<=$n; $i++){
   $resultado *=$x;
}
print $resultado;
?>