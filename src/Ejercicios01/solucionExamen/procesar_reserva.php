<?php
// Requiere PHP 8 y mbstring para contar caracteres UTF-8.
function escapar(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$errores = [];
$datos = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    $errores[] = 'Debes enviar los datos mediante el formulario (POST).';
} else {
    // Se comprueba el tipo antes de recortar, validar o contar caracteres.
    $campos = ['nombre', 'email', 'plazas', 'taller', 'observaciones', 'acepto'];
    foreach ($campos as $campo) {
        if (!array_key_exists($campo, $_POST)) {
            if ($campo === 'observaciones') {
                $datos[$campo] = '';
            } else {
                $errores[] = "Falta el campo obligatorio: $campo.";
            }
        } elseif (!is_string($_POST[$campo])) {
            $errores[] = "El campo $campo debe ser un texto, no un array.";
        } else {
            $datos[$campo] = $_POST[$campo];
        }
    }

    // Se validan los campos de tipo correcto aunque otros tengan errores.
    if (isset($datos['nombre'])) {
        $datos['nombre'] = trim($datos['nombre']);
        $longitud = mb_strlen($datos['nombre'], 'UTF-8');
        if ($longitud < 3 || $longitud > 60) {
            $errores[] = 'El nombre debe tener entre 3 y 60 caracteres.';
        }
    }
    if (isset($datos['email'])) {
        $datos['email'] = trim($datos['email']);
        if (filter_var($datos['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errores[] = 'El correo electrónico no tiene un formato válido.';
        }
    }
    if (isset($datos['plazas'])) {
        $plazas = filter_var($datos['plazas'], FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1, 'max_range' => 4]
        ]);
        if ($plazas === false) {
            $errores[] = 'Las plazas deben ser un entero entre 1 y 4.';
        }
    }

    // Las tarifas y nombres de los talleres se deciden en el servidor.
    $tarifas = ['php' => 12.00, 'web' => 10.00, 'seguridad' => 15.00];
    $nombresTaller = [
        'php' => 'PHP',
        'web' => 'Diseño web',
        'seguridad' => 'Seguridad web'
    ];
    if (isset($datos['taller']) &&
        !array_key_exists($datos['taller'], $tarifas)) {
        $errores[] = 'El taller seleccionado no está permitido.';
    }
    if (isset($datos['observaciones'])) {
        $datos['observaciones'] = trim($datos['observaciones']);
        if (mb_strlen($datos['observaciones'], 'UTF-8') > 200) {
            $errores[] = 'Las observaciones no pueden superar los 200 caracteres.';
        }
    }
    if (isset($datos['acepto']) && $datos['acepto'] !== 'si') {
        $errores[] = 'Debes aceptar las condiciones con el valor permitido.';
    }

    // Solo se calcula y prepara el resumen cuando toda la entrada es válida.
    if (!$errores) {
        $total = $tarifas[$datos['taller']] * $plazas;
        $observaciones = $datos['observaciones'] === ''
            ? 'Sin observaciones' : $datos['observaciones'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de la reserva</title>
</head>
<body>
    <?php if ($errores): ?>
        <h1>No se ha podido procesar la reserva</h1>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= escapar($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <h1>Datos de la reserva válidos</h1>
        <p>Nombre: <?= escapar($datos['nombre']) ?></p>
        <p>Correo: <?= escapar($datos['email']) ?></p>
        <p>Taller: <?= escapar($nombresTaller[$datos['taller']]) ?></p>
        <p>Plazas: <?= $plazas ?></p>
        <p>Observaciones: <?= escapar($observaciones) ?></p>
        <p>Total: <?= number_format($total, 2, ',', '.') ?> €</p>
        <p>Esta práctica no guarda la reserva.</p>
    <?php endif; ?>
    <p><a href="reserva.html">Volver al formulario</a></p>
</body>
</html>
