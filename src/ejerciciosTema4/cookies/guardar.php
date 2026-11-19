<?php
//Comprobamos el metodo pa variar
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: formulario.html");
    exit;
}

//Recogemos los datos enviados
$modo = $_POST["modo"] ?? null;
$idioma = $_POST["idioma"] ?? null;


//Definimos los valores permitidos

$modosPermitidos = ["claro", "oscuro"];
$idiomasPermitidos = ["es", "en"];

//Validamos los datos
if(
    !is_string($modo) ||
    !in_array($modo, $modosPermitidos, true) ||
    !is_string($idioma) ||
    !in_array($idioma, $idiomasPermitidos, true)
){
    //Si algún valor es inválido, no lo guardamos
    header("Location: formulario.html");
    exit;
}

//Preparamos las cookies: . Guarda las preferencias durante siete días, 
// con ámbito de ruta / y sin extender el dominio a subdominios.
// Impide el acceso desde JavaScript; prepara el envío exclusivo 
// por HTTPS cuando el entorno lo utilice

$opciones = [
    "expires" => time() + (60 *60 * 7 * 24),
    "path" => "/", //ambito de la ruta
   // "domain" => "", se omite pa no extender a subdominios
    "secure" => true, //solo se envía por HTTPS
    "httponly" => true, //no accesible desde JavaScript
    //"samesite" => "Lax" //no aparece en el enunciado, pero es una opción habitual de segurirdad
    //Permite el envío en el mismo sitio y en algunas navegaciones normales desde otros sitios, como seguir un enlace.
]
;
//Creamos las cookies

setcookie("modo", "$modo", $opciones);
setcookie("idioma", "$idioma", $opciones);

//Redirección

header("Location: ver.php");
exit;
?>