<?php
//23.Crear un script PHP que genera aleatoriamente un número que corresponde a una
//edad entre 0 y 90 años. Después muestra un periodo dependiendo de la edad: 
//Infancia (0-3), Infantil (4-11), Adolescente (12-20), Adulto (21-65), Tercera edad (+65).
//Hay dos formas de enfocar este problema.

$numero = random_int(0,90);
if ($numero <=3){
    return "Infancia";
    }else if ($numero >3 && $numero <=11){
        return "Infantil";
    }else if($numero>=12 && $numero<=20){
        return "Adolescente";
    }else if($numero>=21 && $numero<=65){
        return "Adulto";
    }else if($numero>65){
        return "Viejoven";
    }

?>