<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = trim($_POST["nombre"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $plazas = trim($_POST["plazas"] ?? "");
    $taller = trim($_POST["taller"] ?? "");
    $observaciones = trim($_POST["observaciones"] ?? "");
    $acepto = trim($_POST["acepto"] ?? "");
    $error = [];
    $tarifa = 0;
    $totalImporte = 0;
    if ($nombre == "" || $email == "" || $plazas == "" || $taller == "") {
        $error = "No se puede dejar un campo requewrido en blanco.";
    }
        else if (count_chars($nombre)<3 || count_chars($nombre)>60){
            $error = "El nombre debe tener al menos 3 caracteres y no superar los 60.";
        }
        else if  (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "El email debe ser válido.";
        }else if($plazas !==""){
            $plazas = (int)$plazas;
        }
        else if ($plazas <1 || $plazas >4) {
            $error = "El número de plazas debe estar entre 1 y 4. ";

        }else if ($taller !== "php" || $taller !== "web" || $taller !== "reguridad") {
            $error = "Ese nombre de taller no existe. ";

        }else if ($observaciones == "") {
            $observaciones = "Sin observaciones.";
        }else if (count_chars($observaciones)>200){
            $error = "El campo observaciones debe tener un máximo de 200 caracteres.";
        }
        else if($acepto !== "si"){
            $error = "Debes aceptar las condiciones de la actividad.";

        }
        else if ($error !==[]) {
            return $error;
        }
        else if($taller == "php"){
            $tarifa = 12.00;
        }
        else if($taller == "web"){
            $tarifa = 10.00;
        }
        else if($taller == "seguridad"){
            $tarifa = 15.00;
        }
        else{
            return "$nombre  . $email .  $plazas .  $taller . $tarifa";
            $totalImporte = $tarifa*$plazas;
            return $totalImporte;
        }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Procesar Reserva</title>
</head>
<body>
<h1>Reserva</h1>
<p><?php echo "Reserva aceptada para $nombre"?></p>
<br>
<p><?php echo "El taller al que te has inscrito es: $taller"?></p>
<br>
<p><?php echo "El total del importe sería: $totalImporte"?></p>
</body>
</html>
