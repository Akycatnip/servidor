<?php


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $num1 = ((float)$_POST["num1"] ?? "");
    $num2 = ((float)$_POST["num2"] ?? "");
    $operacion = ($_POST["operacion"] ?? "");


    switch ($operacion) {

    }
}


?>