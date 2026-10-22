<?php
//27. Crear un script PHP que asigna a una variable una nota entre 0 y 10. 
//Luego, transforma la nota en una calificación y muestra el resultado.

$nota = random_int(1,10);
if ($nota == 10){
    print "Que crack!";
}else if($nota <=9 && $nota >=8){
    print "Genial! Notable!";
}else if($nota<=7 && $nota >=6){
    print "Bien hecho!";
}else if($nota==5){
    print "Por los pelos";
}else print "Vaya tela...";

?>