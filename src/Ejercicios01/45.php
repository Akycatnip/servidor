<?php
// 45.Crear un script PHP asigna a una variable el nombre de un usuario usuario y luego lo muestre tres veces.
//  Primero con el nombre completo en mayúsculas, luego en minúsculas y finalmente con la letra inicial del nombre 
// y el apellido en mayúsculas. Por supuesto, el nombre del usuario puede contener cualquier tipo de letra.
$nombreUsuario = "marta moreno";
print strtoupper($nombreUsuario) . "<br>";
print strtolower($nombreUsuario) . "<br>";
print ucwords($nombreUsuario);

?>