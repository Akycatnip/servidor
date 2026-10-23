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

function calcularMedia(array $notas): float
{
    $suma = 0.0;
    foreach ($notas as $nota) { $suma += $nota; }
    return $suma / count($notas);
}
function obtenerCalificacion(float $media): string
{
    if ($media < 5) { return 'Suspenso'; }
    if ($media < 6) { return 'Aprobado'; }
    if ($media < 7) { return 'Bien'; }
    if ($media < 9) { return 'Notable'; }
    return 'Sobresaliente';
}

$errores = [];
$resultado = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    $errores[] = 'Debes enviar el formulario mediante POST.';
} else {
    $nombre = texto('nombre', $errores);
    if ($nombre === '') { $errores[] = 'El nombre es obligatorio.'; }
    $recibidas = $_POST['notas'] ?? [];
    $notas = [];
    if (!is_array($recibidas) || count($recibidas) !== 3) {
        $errores[] = 'Debes enviar exactamente tres notas en un array.';
    } else {
        foreach ($recibidas as $nota) {
            if (!is_string($nota) || !is_numeric($nota)) {
                $errores[] = 'Cada nota debe ser numérica.';
            } else {
                $valor = (float) $nota;
                if (!is_finite($valor) || $valor < 0 || $valor > 10) {
                    $errores[] = 'Las notas deben estar entre 0 y 10.';
                } else { $notas[] = $valor; }
            }
        }
    }
    if (!$errores) {
        $media = calcularMedia($notas);
        // La calificación se calcula antes de formatear la media.
        $calificacion = obtenerCalificacion($media);
        $resultado = ["Alumno: $nombre",
            'Media: ' . number_format($media, 2, ',', '.'),
            "Calificación: $calificacion"];
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
