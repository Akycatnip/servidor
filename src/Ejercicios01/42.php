<?php
/*42.Crear un script PHP aleatoriamente 10 números enteros entre -50 y 150. Para cada
uno de ellos, muestre uno de los siguientes mensajes dependiendo de su valor:
• Hielo, si el número es igual o menor a 0
• Agua, si el número es mayor a 0 y menor a 100.
• Vapor, si el número es mayor a 100
*/

for ($i =1; $i<=10; $i++){
    $numero = random_int(-50,150);
    if($numero<=0) print $numero . " Hielo <br>";
    else if ($numero>0 && $numero<100) print $numero . " Agua <br>";
    else print $numero . " Vapor <br>";
}


?>