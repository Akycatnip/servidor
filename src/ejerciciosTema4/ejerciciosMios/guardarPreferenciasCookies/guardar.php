<?php
if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header ("Location: formulario.html");
    exit;
}
$modo = $_POST["modo"];
$idioma = $_POST["idioma"];

$modos = ["claro", "oscuro"];
$idiomas = ["en", "es"];

if(!is_string($modo)||!is_string($idioma)||!in_array($modo,$modos,true)|| !in_array($idioma,$idiomas,true)) {
    header("Location: formulario.html");
    exit;
}
//cookies

setcookie("modo",$modo,time() + (60*60*7*24), "/","", false, true);
setcookie("idioma",$idioma,time() + (60*60*7*24), "/","", false, true);

//Redirigimos
header("Location: ver.php");
exit;
?>