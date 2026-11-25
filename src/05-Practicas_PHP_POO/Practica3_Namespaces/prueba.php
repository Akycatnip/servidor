<?php

require_once "autoload.php";

use Centro\Academia\Usuario as Alumno;
use Centro\Biblioteca\Usuario as Lector;

$alumno1 = new Alumno("Ana");
$alumno2 = new Alumno("Luis");
$lector = new Lector("Eva");

echo $alumno1->nombre . ": " . Alumno::ROL . PHP_EOL;
echo $lector->nombre . ": " . Lector::ROL . PHP_EOL;
echo "Alumnos creados: " . Alumno::totalCreados() . PHP_EOL;

unset($alumno1);

echo "Alumnos creados después de unset: " . Alumno::totalCreados() . PHP_EOL;

// Esta asignación produciría un error porque nombre es readonly:
// $alumno2->nombre = "Marta";
