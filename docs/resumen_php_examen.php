<?php
/*
===============================================================================
RESUMEN DE PHP PARA EXAMEN - DAW
Introducción a PHP + Programación en PHP + Formularios y funciones
===============================================================================

Este archivo es una GUÍA DE CONSULTA. Los ejemplos están comentados para que
no se ejecuten todos juntos. Copia y adapta los fragmentos al ejercicio.

ÍNDICE
1. Estructura de PHP, comentarios y salida
2. Variables y tipos de datos
3. Operadores
4. Condicionales
5. Bucles
6. Arrays y foreach
7. Funciones, parámetros y return
8. Formularios: GET, POST y formulario autoprocesado
9. Recibir datos, validar y mostrar con seguridad
10. Arrays de formularios: notas y casillas
11. Plantilla de ejercicio completo
12. Errores típicos que debes evitar
===============================================================================


===============================================================================
1. ESTRUCTURA DE PHP, COMENTARIOS Y SALIDA
===============================================================================

Un archivo PHP termina normalmente en .php.
El código PHP se escribe entre <?php y ?>.
Cada instrucción termina con punto y coma ;.
Las llaves { } agrupan instrucciones.

<?php
// Comentario de una línea.

/*
   Comentario de varias líneas.
*/

$nombre = "Marta";
$edad = 20;

echo "Hola";
echo $nombre;

// Concatenar textos y variables con el punto:
echo "Hola, " . $nombre;

// También se pueden interpolar variables con comillas dobles:
echo "Hola, $nombre";

// echo imprime contenido. Es lo más habitual para mostrar valores.
// print también imprime, pero en estos ejercicios usa normalmente echo.

// Fuera de PHP se puede escribir HTML directamente:
?>
<p>Este HTML se envía al navegador.</p>
<?php
// Forma corta de imprimir una variable dentro de HTML:
// <?= $nombre ?> equivale a <?php echo $nombre; ?>


===============================================================================
2. VARIABLES Y TIPOS DE DATOS
===============================================================================

Las variables empiezan por $ y distinguen mayúsculas de minúsculas.

$nombre = "Ana";       // string: texto
$edad = 25;            // int: número entero
$precio = 3.50;        // float: número decimal
$aprobado = true;      // bool: verdadero/falso
$sinValor = null;      // null: ausencia de valor
$notas = [7, 8, 9];    // array: conjunto de valores

// Conversión de texto a número: hazla después de comprobar que es numérico.
$texto = "12.5";
$numero = (float) $texto;
$entero = (int) $texto;

// trim() elimina espacios al principio y al final:
$nombre = trim($nombre);

// strlen() devuelve la longitud de una cadena:
$longitud = strlen("Hola"); // 4

// is_numeric() comprueba si un valor es numérico:
is_numeric("12.5"); // true
is_numeric("hola"); // false

// isset() comprueba que una variable/clave existe y no es null:
isset($nombre);

// empty() comprueba si un valor está vacío (también considera 0 como vacío).
// Para nombres, suele ser más claro usar trim() y comparar con "".

// Operador ?? (fusión de null): usa un valor por defecto si falta la clave
// o es null. Muy útil al leer formularios:
$nombre = $_POST["nombre"] ?? "";


===============================================================================
3. OPERADORES
===============================================================================

// Aritméticos:
$a + $b;   // sumar
$a - $b;   // restar
$a * $b;   // multiplicar
$a / $b;   // dividir (comprueba antes que $b no sea 0)
$a % $b;   // resto de una división entera

// Comparación:
$a == $b;   // iguales después de posibles conversiones
$a === $b;  // iguales en valor y tipo
$a != $b;   // distintos
$a !== $b;  // distintos en valor o tipo
$a > $b;
$a < $b;
$a >= $b;
$a <= $b;

// Lógicos:
$edad >= 18 && $tieneEntrada; // AND: ambas condiciones verdaderas
$edad < 18 || $tienePermiso;  // OR: alguna condición verdadera
!$aprobado;                   // NOT: invierte true/false

// Asignación:
$total = 10;
$total += 5; // equivale a $total = $total + 5;

// Concatenación de cadenas:
$nombreCompleto = $nombre . " " . $apellido;

// Ternario: versión corta de if/else para asignar un valor:
$mensaje = ($nota >= 5) ? "Aprobado" : "Suspenso";



/*
-------------------------------------------------------------------------------
EXPLICACIÓN AMPLIADA: AND, &&, OR, || Y !
-------------------------------------------------------------------------------

AND significa "Y": TODAS las condiciones tienen que ser verdaderas.
También existe &&, que se utiliza mucho para expresar lo mismo.

Ejemplo:
$edad = 25;

if ($edad >= 18 AND $edad <= 30) {
    echo "Edad válida";
}

Para que aparezca el mensaje, la edad tiene que ser al menos 18 Y, además,
como máximo 30. Si una de las dos condiciones falla, no entra en el if.

La misma condición puede escribirse así:
if ($edad >= 18 && $edad <= 30) {
    echo "Edad válida";
}

OR significa "O": basta con que UNA de las condiciones sea verdadera.
También se puede escribir ||.

if ($dia == "sábado" || $dia == "domingo") {
    echo "Es fin de semana";
}

El mensaje aparece si el día es sábado O si es domingo.

! significa "NO": invierte una condición.
Por ejemplo, !$aprobado significa que NO está aprobado.

if (!$aprobado) {
    echo "No has aprobado";
}

EJEMPLO DEL TEMA SOBRE EL USUARIO:

$filtrado = array();

// mb_strlen() devuelve la longitud del texto.
$longitud = mb_strlen($_POST["usuario"]);

// ctype_alnum() comprueba que el texto contenga solo letras y números.
// AND une las condiciones: TODAS deben cumplirse.
if (
    ctype_alnum($_POST["usuario"])
    AND ($longitud > 0)
    AND ($longitud <= 32)
) {
    // Solo si cumple las tres condiciones, guardamos el usuario.
    $filtrado["usuario"] = $_POST["usuario"];
} else {
    // Si falla alguna condición, gestionamos el error.
}

¿Qué comprueba cada condición?
1. ctype_alnum(...): solo letras y números, sin espacios ni símbolos.
2. $longitud > 0: el texto no puede estar vacío.
3. $longitud <= 32: puede tener como máximo 32 caracteres.

Por tanto, "Marta123" pasaría esas comprobaciones; "Marta 123" no, porque
contiene un espacio; y un texto de más de 32 caracteres tampoco pasaría.

Funciones que aparecen en este ejemplo:
- array() crea un array vacío; también se puede escribir [].
- $_POST["usuario"] recoge el campo cuyo atributo HTML name es "usuario".
- mb_strlen() cuenta los caracteres de un texto.
- ctype_alnum() comprueba que solo haya letras y números.
- $filtrado["usuario"] guarda el dato validado en un array asociativo.

NOTA: AND y && tienen el mismo sentido lógico, pero en PHP tienen distinta
precedencia al mezclarse con otros operadores. En condiciones sencillas como
estas, puedes usar && si es la forma que habéis practicado en clase.

-------------------------------------------------------------------------------
FIN DE LA EXPLICACIÓN DE OPERADORES LÓGICOS
-------------------------------------------------------------------------------
*/


===============================================================================
4. CONDICIONALES
===============================================================================

// IF: una condición.
if ($nota >= 5) {
    echo "Aprobado";
}

// IF / ELSE: dos caminos.
if ($nota >= 5) {
    echo "Aprobado";
} else {
    echo "Suspenso";
}

// IF / ELSEIF / ELSE: varios casos.
if ($nota < 5) {
    echo "Suspenso";
} elseif ($nota < 6) {
    echo "Aprobado";
} elseif ($nota < 7) {
    echo "Bien";
} elseif ($nota < 9) {
    echo "Notable";
} elseif ($nota <= 10) {
    echo "Sobresaliente";
} else {
    echo "Nota incorrecta";
}

// IMPORTANTE: primero comprueba los casos más pequeños y usa rangos
// coherentes. Antes de calificar, valida que la nota esté entre 0 y 10.

// SWITCH: seleccionar entre opciones concretas.
switch ($operacion) {
    case "sumar":
        $resultado = $a + $b;
        break;
    case "restar":
        $resultado = $a - $b;
        break;
    case "multiplicar":
        $resultado = $a * $b;
        break;
    case "dividir":
        if ($b == 0) {
            $error = "No se puede dividir entre cero";
        } else {
            $resultado = $a / $b;
        }
        break;
    default:
        $error = "Operación no válida";
}

// match (PHP 8+) también permite elegir un valor, pero switch es suficiente
// si es el que habéis practicado:
$resultado = match ($operacion) {
    "sumar" => $a + $b,
    "restar" => $a - $b,
    "multiplicar" => $a * $b,
    default => 0
};


===============================================================================
5. BUCLES
===============================================================================

// FOR: cuando sabes cuántas veces repetir.
for ($i = 0; $i < 3; $i++) {
    echo $i;
}
// Empieza en 0; continúa mientras $i < 3; aumenta $i en 1.

// WHILE: repite mientras la condición sea verdadera.
$i = 0;
while ($i < 3) {
    echo $i;
    $i++;
}

// DO-WHILE: se ejecuta al menos una vez.
$i = 0;
do {
    echo $i;
    $i++;
} while ($i < 3);

// break termina el bucle.
// continue salta a la siguiente vuelta.


===============================================================================
6. ARRAYS Y FOREACH
===============================================================================

// Array numérico: las posiciones empiezan en 0.
$colores = ["rojo", "verde", "azul"];
echo $colores[0]; // rojo
echo count($colores); // número de elementos: 3

// Añadir un elemento:
$colores[] = "rosa";

// Recorrer un array con for:
for ($i = 0; $i < count($colores); $i++) {
    echo $colores[$i];
}

// Recorrer un array con foreach (muy útil para arrays):
foreach ($colores as $color) {
    echo $color;
}

// Array asociativo: cada elemento tiene una clave con nombre.
$precios = [
    "individual" => 45.00,
    "doble" => 70.00,
    "suite" => 110.00
];

echo $precios["doble"]; // 70

// Recorrer clave y valor:
foreach ($precios as $tipo => $precio) {
    echo $tipo . ": " . $precio;
}

// Array bidimensional: un array que contiene otros arrays.
$alumnos = [
    ["Ana", 8],
    ["Luis", 6],
    ["Eva", 9]
];
echo $alumnos[0][0]; // Ana
echo $alumnos[0][1]; // 8

// Array de formulario: en HTML se escribe name="notas[]".
// PHP recibe los valores en $_POST["notas"] como un array.


===============================================================================
7. FUNCIONES, PARÁMETROS Y RETURN
===============================================================================

// Una función agrupa instrucciones para reutilizarlas.
// Los parámetros son las variables que recibe.
// return devuelve el resultado al lugar desde el que se llamó.

function sumar(float $a, float $b): float
{
    return $a + $b;
}

$resultado = sumar(4, 3);
echo $resultado; // 7

function calcularAlojamiento(float $tarifa, int $noches): float
{
    return $tarifa * $noches;
}

// Una función que no necesita devolver un cálculo puede mostrar contenido,
// aunque en los ejercicios de cálculo se suele pedir return.

// Parámetro por defecto:
function saludar(string $nombre = "Invitado"): string
{
    return "Hola, " . $nombre;
}

// IMPORTANTE:
// - float $a indica que se espera un decimal.
// - int $noches indica un entero.
// - : float indica que la función devuelve un decimal.
// - return NO es lo mismo que echo.
//   return entrega el resultado para seguir calculando.
//   echo muestra algo al usuario.

// Ejemplo: calcular la media recorriendo un array.
function calcularMedia(array $notas): float
{
    $suma = 0;

    foreach ($notas as $nota) {
        $suma = $suma + $nota;
    }

    return $suma / count($notas);
}

// Ejemplo: obtener una calificación.
function obtenerCalificacion(float $media): string
{
    if ($media < 5) {
        return "Suspenso";
    } elseif ($media < 6) {
        return "Aprobado";
    } elseif ($media < 7) {
        return "Bien";
    } elseif ($media < 9) {
        return "Notable";
    } else {
        return "Sobresaliente";
    }
}

// Es buena idea que las funciones calculen y devuelvan el resultado.
// Leer $_POST y mostrar el HTML se hace normalmente fuera de las funciones.


===============================================================================
8. FORMULARIOS: GET, POST Y FORMULARIO AUTOPROCESADO
===============================================================================

En HTML:

<form action="procesar.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre">

    <label for="cantidad">Cantidad:</label>
    <input type="number" id="cantidad" name="cantidad">

    <button type="submit">Enviar</button>
</form>

- action: archivo que recibe el formulario.
- method: forma de envío (GET o POST).
- name: nombre con el que PHP encuentra el dato.
- id: identifica el campo y se relaciona con label.
- required, min, max y step ayudan en el navegador, pero PHP debe validar.

GET:
- Los datos aparecen en la URL.
- En PHP se leen con $_GET["campo"].
- Se suele usar para búsquedas o filtros.

POST:
- Los datos se envían en el cuerpo de la petición.
- En PHP se leen con $_POST["campo"].
- Es el método habitual en estos ejercicios de formularios.

Formulario en un único archivo PHP:
<form action="" method="post">
    ...
</form>

action="" significa que se envía al mismo archivo.

Para saber si se ha enviado el formulario:
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Procesar datos solo después de pulsar Enviar.
}

Así no aparecen errores antes del primer envío.


===============================================================================
9. RECIBIR DATOS, VALIDAR Y MOSTRAR CON SEGURIDAD
===============================================================================

// Recuperar un dato y dar un valor por defecto si no existe:
$nombre = $_POST["nombre"] ?? "";

// Eliminar espacios al principio y al final:
$nombre = trim($nombre);

// Validar que el nombre no esté vacío:
if ($nombre === "") {
    $error = "El nombre es obligatorio";
}

// Comprobar si un dato es numérico ANTES de convertirlo:
$numeroTexto = $_POST["numero"] ?? "";

if (is_numeric($numeroTexto)) {
    $numero = (float) $numeroTexto;
} else {
    $error = "Debes introducir un número";
}

// Para un entero, también puedes comprobar que el texto represente un entero
// y luego revisar el rango. Una forma sencilla para ejercicios básicos:
$cantidadTexto = $_POST["cantidad"] ?? "";

if (filter_var($cantidadTexto, FILTER_VALIDATE_INT) === false) {
    $error = "La cantidad debe ser un número entero";
} else {
    $cantidad = (int) $cantidadTexto;

    if ($cantidad < 1 || $cantidad > 10) {
        $error = "La cantidad debe estar entre 1 y 10";
    }
}

// Validar una opción permitida:
$habitacion = $_POST["habitacion"] ?? "";

if ($habitacion !== "individual"
    && $habitacion !== "doble"
    && $habitacion !== "suite") {
    $error = "Tipo de habitación no válido";
}

// Validar correo electrónico:
$email = $_POST["email"] ?? "";
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $error = "Correo no válido";
}

// Escapar textos antes de introducirlos en HTML:
echo htmlspecialchars($nombre, ENT_QUOTES, "UTF-8");

// ¿Por qué? Para que caracteres como < y > escritos por el usuario no se
// interpreten como etiquetas HTML.

// Formatear un decimal con dos decimales SOLO al mostrarlo:
echo number_format($total, 2, ",", "."); // 1.234,50
// En los cálculos conserva el número sin convertirlo en texto.

// Acumular varios errores:
$errores = [];

if ($nombre === "") {
    $errores[] = "El nombre es obligatorio";
}

if (!is_numeric($numeroTexto)) {
    $errores[] = "El número no es válido";
}

if (count($errores) > 0) {
    foreach ($errores as $error) {
        echo "<p>" . htmlspecialchars($error, ENT_QUOTES, "UTF-8") . "</p>";
    }
}

// IMPORTANTE: los atributos required/min/max del HTML no sustituyen la
// validación en PHP, porque el navegador se puede saltar.


===============================================================================
10. ARRAYS DE FORMULARIOS: NOTAS Y CASILLAS
===============================================================================

A) TRES NOTAS

HTML:
<input type="number" name="notas[]" step="any">
<input type="number" name="notas[]" step="any">
<input type="number" name="notas[]" step="any">

PHP:
$notas = $_POST["notas"] ?? [];

// Antes de calcular, comprueba:
// 1. Que $notas sea un array.
// 2. Que tenga exactamente 3 elementos.
// 3. Que cada elemento sea numérico.
// 4. Que cada nota esté entre 0 y 10.

if (!is_array($notas) || count($notas) !== 3) {
    $error = "Debes introducir exactamente tres notas";
} else {
    $notasValidas = true;

    foreach ($notas as $nota) {
        if (!is_numeric($nota) || $nota < 0 || $nota > 10) {
            $notasValidas = false;
        }
    }

    if (!$notasValidas) {
        $error = "Cada nota debe ser numérica y estar entre 0 y 10";
    } else {
        // Convertir las notas a float antes de calcular.
        $notasNumericas = [];

        foreach ($notas as $nota) {
            $notasNumericas[] = (float) $nota;
        }

        $media = calcularMedia($notasNumericas);
        $calificacion = obtenerCalificacion($media);
    }
}

B) CHECKBOXES / CASILLAS

HTML:
<input type="checkbox" name="extras[]" value="queso"> Queso
<input type="checkbox" name="extras[]" value="tomate"> Tomate
<input type="checkbox" name="extras[]" value="salsa"> Salsa

Si no se marca ninguna casilla, normalmente la clave "extras" NO aparece
en $_POST. Por eso:
$extras = $_POST["extras"] ?? [];

Precios guardados en el servidor (no confiar en precios enviados por HTML):
$preciosExtras = [
    "queso" => 0.50,
    "tomate" => 0.30,
    "salsa" => 0.20
];

Suma de extras:
function calcularPrecioExtras(array $extras): float
{
    $precios = [
        "queso" => 0.50,
        "tomate" => 0.30,
        "salsa" => 0.20
    ];

    $suma = 0;

    foreach ($extras as $extra) {
        // Comprobar que la opción existe antes de usarla.
        if (isset($precios[$extra])) {
            $suma = $suma + $precios[$extra];
        }
    }

    return $suma;
}

Validación importante: si se recibe "extras", comprueba que sea un array y que
cada opción pertenezca a la lista permitida antes de calcular.


===============================================================================
11. PLANTILLA DE EJERCICIO COMPLETO (UN SOLO ARCHIVO PHP)
===============================================================================

Este es el orden típico para un formulario que se procesa en el mismo archivo.
Adáptalo al enunciado. El ejemplo es orientativo y no sustituye las validaciones
específicas que pida cada ejercicio.

<?php
// 1. FUNCIONES: cálculos separados del formulario.
function obtenerTarifa(string $habitacion): float
{
    if ($habitacion === "individual") {
        return 45.0;
    } elseif ($habitacion === "doble") {
        return 70.0;
    } elseif ($habitacion === "suite") {
        return 110.0;
    } else {
        return 0.0;
    }
}

function calcularAlojamiento(float $tarifa, int $noches): float
{
    return $tarifa * $noches;
}

function calcularDescuento(float $alojamiento, int $noches): float
{
    if ($noches >= 7) {
        return $alojamiento * 0.10;
    } else {
        return 0.0;
    }
}

function calcularDesayuno(bool $incluido, int $noches): float
{
    if ($incluido) {
        return 8.0 * $noches;
    } else {
        return 0.0;
    }
}

// 2. VALORES INICIALES: no mostrar errores antes del envío.
$nombre = "";
$habitacion = "";
$nochesTexto = "";
$desayuno = false;
$errores = [];
$enviado = false;

$alojamiento = 0.0;
$descuento = 0.0;
$precioDesayuno = 0.0;
$total = 0.0;

// 3. PROCESAR SOLO SI SE HA ENVIADO EL FORMULARIO.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $enviado = true;

    // 4. LEER DATOS.
    $nombre = trim($_POST["nombre"] ?? "");
    $habitacion = $_POST["habitacion"] ?? "";
    $nochesTexto = $_POST["noches"] ?? "";
    $desayuno = isset($_POST["desayuno"]);

    // 5. VALIDAR.
    if ($nombre === "") {
        $errores[] = "El nombre es obligatorio.";
    }

    if ($habitacion !== "individual"
        && $habitacion !== "doble"
        && $habitacion !== "suite") {
        $errores[] = "Selecciona una habitación válida.";
    }

    if (filter_var($nochesTexto, FILTER_VALIDATE_INT) === false) {
        $errores[] = "Las noches deben ser un número entero.";
    } else {
        $noches = (int) $nochesTexto;

        if ($noches < 1 || $noches > 30) {
            $errores[] = "Las noches deben estar entre 1 y 30.";
        }
    }

    // 6. CALCULAR SOLO SI NO HAY ERRORES.
    if (count($errores) === 0) {
        $tarifa = obtenerTarifa($habitacion);
        $alojamiento = calcularAlojamiento($tarifa, $noches);
        $descuento = calcularDescuento($alojamiento, $noches);
        $precioDesayuno = calcularDesayuno($desayuno, $noches);

        $total = $alojamiento - $descuento + $precioDesayuno;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Presupuesto</title>
</head>
<body>
    <h1>Presupuesto de alojamiento</h1>

    <!-- El formulario se envía a este mismo archivo. -->
    <form action="" method="post">
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre"
                   value="<?= htmlspecialchars($nombre, ENT_QUOTES, "UTF-8") ?>">
        </p>

        <p>
            <label for="habitacion">Habitación:</label>
            <select id="habitacion" name="habitacion">
                <option value="individual">Individual</option>
                <option value="doble">Doble</option>
                <option value="suite">Suite</option>
            </select>
        </p>

        <p>
            <label for="noches">Noches:</label>
            <input type="number" id="noches" name="noches" min="1" max="30"
                   value="<?= htmlspecialchars($nochesTexto, ENT_QUOTES, "UTF-8") ?>">
        </p>

        <p>
            <input type="checkbox" id="desayuno" name="desayuno" value="si">
            <label for="desayuno">Incluir desayuno</label>
        </p>

        <button type="submit">Calcular</button>
    </form>

    <?php
    // Mostrar errores solo después de enviar el formulario.
    if ($enviado && count($errores) > 0) {
        foreach ($errores as $error) {
            echo "<p>" . htmlspecialchars($error, ENT_QUOTES, "UTF-8") . "</p>";
        }
    }

    // Mostrar resultados solo si se envió y no hay errores.
    if ($enviado && count($errores) === 0) {
        echo "<h2>Resultado</h2>";
        echo "<p>Nombre: " . htmlspecialchars($nombre, ENT_QUOTES, "UTF-8") . "</p>";
        echo "<p>Alojamiento: " . number_format($alojamiento, 2, ",", ".") . " €</p>";
        echo "<p>Descuento: " . number_format($descuento, 2, ",", ".") . " €</p>";
        echo "<p>Desayuno: " . number_format($precioDesayuno, 2, ",", ".") . " €</p>";
        echo "<p>Total: " . number_format($total, 2, ",", ".") . " €</p>";
    }
    ?>
</body>
</html>

<?php
function sumar(int $a, int $b): int {
    return $a + $b;
}

function multiplicar(int $a, int $b): int {
    return $a * $b;
}
?>

<h2>Resultados</h2>

<ol>
    <li>La suma es: <?php echo sumar(5, 3); ?></li>
    <li>La multiplicación es: <?php echo multiplicar(5, 3); ?></li>
</ol>

NOTA SOBRE LA PLANTILLA:
- En un examen, adapta nombres, tarifas y condiciones al enunciado.
- Para conservar una opción seleccionada en un <select>, añade selected cuando
  el valor coincida con la variable recibida.
- Para conservar una casilla marcada, comprueba la variable booleana y añade
  checked. No es imprescindible si el enunciado no pide conservar los valores.


===============================================================================
12. ERRORES TÍPICOS QUE DEBES EVITAR
===============================================================================

1. Olvidar el punto y coma ; al final de una instrucción.
2. Escribir una variable sin $.
3. Leer $_POST["nota1"] cuando el HTML realmente usa name="notas[]".
   Si el HTML usa name="notas[]", se recibe $_POST["notas"] como array.
4. Calcular antes de validar los datos.
5. Usar un valor recibido del formulario sin comprobar que existe.
   Usa, por ejemplo: $_POST["nombre"] ?? "".
6. No comprobar que una división tenga divisor distinto de cero.
7. Usar echo dentro de una función de cálculo cuando el ejercicio pide return.
8. Comparar un texto con números sin comprobar primero que el dato es numérico.
9. Olvidar que las casillas no marcadas no suelen aparecer en $_POST.
10. Confiar solo en required, min o max del HTML: valida también en PHP.
11. Mostrar directamente texto escrito por el usuario. Usa htmlspecialchars().
12. Redondear la media antes de obtener la calificación. Calcula con el valor real
    y aplica number_format() solo al mostrarlo.
13. Olvidar que calcularDescuento() debe devolver el importe del descuento,
    no el total final.
14. Mostrar errores antes de que se haya enviado el formulario.
15. No comprobar el rango pedido: por ejemplo, notas 0-10, cantidad 1-10,
    noches 1-30.

ORDEN MENTAL PARA EL EXAMEN
1. Leer el enunciado y localizar entradas, reglas y cálculos.
2. Escribir las funciones que pide el enunciado.
3. Inicializar variables, resultados y array de errores.
4. Comprobar si el método de envío es POST.
5. Leer los datos de $_POST usando ?? para valores por defecto.
6. Validar los datos y acumular errores.
7. Si no hay errores, convertir los datos y llamar a las funciones.
8. Escribir el HTML.
9. Mostrar errores o resultados.
10. Probar un caso válido, uno incorrecto y uno límite.

===============================================================================
FIN DEL RESUMEN
===============================================================================
*/
?>
