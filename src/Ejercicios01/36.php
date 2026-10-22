<?php
// 36.Crear un script PHP que genera aleatoriamente 15 veces un número y muestre un mensaje si el número 
// es divisible por 2, por 3 o por ninguno de ellos.

for ($i=1; $i<=15; $i++){
    $numeroAleatorio = random_int(1,100);
        if($numeroAleatorio%2==0){
        print $numeroAleatorio . " es divisible entre 2. <br>" ;
        }else if($numeroAleatorio%3==0){
        print $numeroAleatorio . " es divisible entre 3.<br>";
        }else{
        print $numeroAleatorio . " no es divisible entre 2 ni entre 3.<br>";
        }
}

?>