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

function obtenerTarifa(string $habitacion): float
{
    $tarifas = ['individual' => 45.00, 'doble' => 70.00, 'suite' => 110.00];
    return $tarifas[$habitacion];
}
function calcularAlojamiento(float $tarifa, int $noches): float
{
    return $tarifa * $noches;
}
function calcularDescuento(float $alojamiento, int $noches): float
{
    return $noches >= 7 ? $alojamiento * 0.10 : 0.00;
}
function calcularDesayuno(bool $incluido, int $noches): float
{
    return $incluido ? 8.00 * $noches : 0.00;
}
$errores = [];
$nombre = '';
$habitacion = '';
$nochesTexto = '';
$desayuno = false;
$enviado = $_SERVER['REQUEST_METHOD'] === 'POST';
if ($enviado) {
    $nombre = texto('nombre', $errores);
    $habitacion = texto('habitacion', $errores);
    $nochesTexto = texto('noches', $errores);
    if ($nombre === '') { $errores[] = 'El nombre es obligatorio.'; }
    if (!in_array($habitacion, ['individual', 'doble', 'suite'], true)) {
        $errores[] = 'Habitación no permitida.';
    }
    $noches = filter_var($nochesTexto, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1, 'max_range' => 30]
    ]);
    if ($noches === false) { $errores[] = 'Noches: entero entre 1 y 30.'; }
    if (array_key_exists('desayuno', $_POST)) {
        if ($_POST['desayuno'] !== 'si') {
            $errores[] = 'Valor de desayuno incorrecto.';
        } else { $desayuno = true; }
    }
    if (!$errores) {
        $alojamiento = calcularAlojamiento(obtenerTarifa($habitacion), $noches);
        $descuento = calcularDescuento($alojamiento, $noches);
        $costeDesayuno = calcularDesayuno($desayuno, $noches);
        $total = $alojamiento - $descuento + $costeDesayuno;
    }
} elseif ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    header('Allow: GET, POST');
    $errores[] = 'Método no permitido.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Presupuesto de alojamiento</title></head>
<body>
<h1>Presupuesto de alojamiento</h1>
<?php if ($errores): ?>
    <ul><?php foreach ($errores as $error): ?>
        <li><?= escapar($error) ?></li>
    <?php endforeach; ?></ul>
<?php endif; ?>
<!-- El formulario siempre se muestra y conserva las entradas válidas de texto. -->
<form action="#" method="post">
    <p><label>Nombre: <input type="text" name="nombre"
        value="<?= escapar($nombre) ?>" required></label></p>
    <p><label>Habitación: <select name="habitacion" required>
        <option value="">Selecciona una habitación</option>
        <?php foreach (['individual', 'doble', 'suite'] as $opcion): ?>
            <option value="<?= escapar($opcion) ?>" <?= $habitacion === $opcion ? 'selected' : '' ?>>
                <?= escapar(ucfirst($opcion)) ?>
            </option>
        <?php endforeach; ?>
    </select></label></p>
    <p><label>Noches: <input type="number" name="noches" min="1" max="30" step="1"
        value="<?= escapar($nochesTexto) ?>" required></label></p>
    <p><label><input type="checkbox" name="desayuno" value="si"
        <?= $desayuno ? 'checked' : '' ?>> Incluir desayuno</label></p>
    <button type="submit">Calcular presupuesto</button>
</form>
<?php if ($enviado && !$errores): ?>
    <h2>Presupuesto para <?= escapar($nombre) ?></h2>
    <p>Habitación: <?= escapar($habitacion) ?>. Noches: <?= $noches ?>.</p>
    <p>Alojamiento: <?= number_format($alojamiento, 2, ',', '.') ?> €</p>
    <p>Descuento: <?= number_format($descuento, 2, ',', '.') ?> €</p>
    <p>Desayuno: <?= number_format($costeDesayuno, 2, ',', '.') ?> €</p>
    <p>Total: <?= number_format($total, 2, ',', '.') ?> €</p>
<?php endif; ?>
</body></html>
