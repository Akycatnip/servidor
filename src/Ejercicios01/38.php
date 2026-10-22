<?php
// 38.Crear un script PHP que muestre los cuadrados y 
// cubos de dos números enteros generados aleatoriamente y con una diferencia entre ellos menor de 20. 
$num1 = random_int(1,500);
$num2 = random_int(1,500);
$cuadrado1 = $num1**2;
$cuadrado2 = $num2**2;
$cubo1 = $num1**3;
$cubo2 = $num2**3;
if ($num1 - $num2 <=20){
    print $num1 . " y " . $num2 . " Cuadrados: " . $cuadrado1 . " y " . $cuadrado2 . "<br>" . " y los cubos: " . $cubo1 . " y " . $cubo2;
}else{
    print "La diferencia entre los números es menos que 20.";
}
?>