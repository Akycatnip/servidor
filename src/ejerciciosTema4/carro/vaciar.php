<?php
session_start();

// Vaciamos el carrito
$_SESSION["carrito"] = array();

// Volvemos al carrito
header("Location: carrito.php");
exit();
