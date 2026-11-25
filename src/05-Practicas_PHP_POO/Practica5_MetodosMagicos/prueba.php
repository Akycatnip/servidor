<?php

require_once "Registro.php";

$r = Registro::crear();

$r->tema = "  oscuro  ";
$r->idioma = "  español  ";

echo "Tema guardado: " . $r->tema . PHP_EOL;
echo "Idioma: " . $r->idioma . PHP_EOL;
echo "Existe tema: " . (isset($r->tema) ? "true" : "false") . PHP_EOL;
echo "Obtener tema: " . $r->obtener("tema") . PHP_EOL;
echo "Invocar para leer tema: " . $r("tema") . PHP_EOL;
echo "Como texto: " . $r . PHP_EOL;

var_dump($r);

unset($r->idioma);
echo "Existe idioma después de borrar: " . (isset($r->idioma) ? "true" : "false") . PHP_EOL;
echo "Leer idioma después de borrar: ";
var_dump($r->idioma);

try {
    $r->color = "azul";
} catch (InvalidArgumentException $e) {
    echo "Error de propiedad: " . $e->getMessage() . PHP_EOL;
}

try {
    $r->desconocido();
} catch (BadMethodCallException $e) {
    echo "Error de método: " . $e->getMessage() . PHP_EOL;
}

try {
    $r->obtener();
} catch (BadMethodCallException $e) {
    echo "Error de argumentos: " . $e->getMessage() . PHP_EOL;
}

// var_export genera una expresión que llama a Registro::__set_state().
$contenido = "<?php\nreturn " . var_export($r, true) . ";\n";
file_put_contents("registro_exportado.php", $contenido);

$recuperado = require "registro_exportado.php";
echo "Tema del registro reconstruido: " . $recuperado->tema . PHP_EOL;

unlink("registro_exportado.php");
