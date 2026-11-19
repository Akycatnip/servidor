<?php
session_start();
$_SESSION["carrito"] = [];

//volver al carro
header("Location: carrito.php");
exit;
