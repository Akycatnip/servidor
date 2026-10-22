<?php
/*24.Crear un script PHP asigna a variables un nombre del usuario
 y un número entero. Luego muestre el nombre del usuario en tantas líneas 
 como indique el número.*/
$nombreUsuario = "Marta";
$veces = random_int(1,45);

for ($i=1; $i<=$veces; $i++){
   print $nombreUsuario . "<br>";
}

?>


