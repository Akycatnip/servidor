<?php
 //43. Crear un script PHP que asigna una frase a una cadena de caracteres y la muestra en sentido inverso. 
$cadena = "Mina mina shimawaaa atake he atama purpuru atama pokapoka aho baaaaka";
$longitud = strlen($cadena);
$invertida ="";
for ($i = $longitud-1; $i>=0; $i--){
    $invertida.= $cadena[$i];
}
print $invertida;
?>
