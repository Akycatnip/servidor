<?php
/*37. Crear un script PHP que genera aleatoriamente un color RGB en hexadecimal.
Mostrar el resultado con ese color de fondo y el texto “Este es el color generado
aleatoriamente”. ¡Cuidado! El texto debe poder verse en el color de fondo. */

$color = sprintf("#%06X", random_int(0, 0xFFFFFF));// el str "rellena" el valor para que se adapte al formato hexadecimal

print "<p style='color: $color'>Vaya ejercicio Antonio, le hemos preguntado todos a la IA, estaba claro...</p>";

?>