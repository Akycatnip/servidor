<?php
header("Content-type: application/json; charset=utf-8");
$mensaje = [
    "metodo"=> $_SERVER["REQUEST_METHOD"],
    "protocolo"=> $_SERVER["SERVER_PROTOCOL"],
    "uri"=> $_SERVER["REQUEST_URI"],
    "get"=> $_GET,
    "post"=> $_POST];
echo json_encode($mensaje);
?>