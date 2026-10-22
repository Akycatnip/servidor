<?php
/*29. Para pagar impuestos es necesario que las personas sean mayores de 16 años y
tengan un sueldo superior a 1000€ al mes. Crear un script PHP que asigne a una
variable un nombre y asigna aleatoriamente una edad y un sueldo anual. A
continuación muestra si se deben pagar */

$nombre = "Antonio";
$edad = random_int(1,100);
$sueldoAnual = random_int(100,5000);

if ($sueldoAnual >= 1000){
    print $nombre . " tiene que pagar impuestos.";
}else print $nombre . " no paga un duro."
?>