<?php
function escapar(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function texto(string $campo, array &$errores): string
{
    $valor = $_POST[$campo] ?? '';
    if (!is_string($valor)) {
        $errores[] = "Formato incorrecto en $campo.";
        return '';
    }
    return trim($valor);
}

function sumar(float $a, float $b): float { return $a + $b; }
function restar(float $a, float $b): float { return $a - $b; }
function multiplicar(float $a, float $b): float { return $a * $b; }
function dividir(float $a, float $b): float { return $a / $b; }

$errores = [];
$resultado = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    $errores[] = 'Debes enviar el formulario mediante POST.';
} else {
    $aTexto = texto('a', $errores);
    $bTexto = texto('b', $errores);
    $operacion = texto('operacion', $errores);
    if (!is_numeric($aTexto) || !is_numeric($bTexto)) {
        $errores[] = 'Introduce dos números válidos.';
    } else {
        $a = (float) $aTexto;
        $b = (float) $bTexto;
        if (!is_finite($a) || !is_finite($b)) {
            $errores[] = 'Los números superan el rango admitido.';
        }
        if ($operacion === 'dividir' && $b == 0.0) {
            $errores[] = 'No se puede dividir entre cero.';
        }
    }
    if (!in_array($operacion, ['sumar', 'restar', 'multiplicar', 'dividir'], true)) {
        $errores[] = 'Operación no permitida.';
    }
    if (!$errores) {
        // Solo se llama a dividir tras comprobar el divisor.
        $valor = match ($operacion) {
            'sumar' => sumar($a, $b),
            'restar' => restar($a, $b),
            'multiplicar' => multiplicar($a, $b),
            'dividir' => dividir($a, $b)
        };
        if (!is_finite($valor)) {
            $errores[] = 'El resultado supera el rango admitido.';
        } else {
            $resultado = ["Primer número: $a", "Segundo número: $b",
                "Operación: $operacion", "Resultado: $valor"];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Resultado</title></head>
<body>
<?php if ($errores): ?>
    <h1>Revisa los datos</h1>
    <ul><?php foreach ($errores as $error): ?>
        <li><?= escapar($error) ?></li>
    <?php endforeach; ?></ul>
<?php else: ?>
    <h1>Resultado</h1>
    <ul><?php foreach ($resultado as $linea): ?>
        <li><?= escapar($linea) ?></li>
    <?php endforeach; ?></ul>
<?php endif; ?>
<p><a href="formulario.html">Volver al formulario</a></p>
</body></html>
