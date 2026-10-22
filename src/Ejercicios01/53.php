<?php
// 53.Crear un script PHP que genera aleatoriamente un número entero positivo y muestre en pantalla 
// la cuenta regresiva desde ese número hasta 0, separados por coma.
$numero = random_int(1,60);
for($i = $numero; $i>=0; $i--):
    print $i . ", <br> ";
endfor;
?>