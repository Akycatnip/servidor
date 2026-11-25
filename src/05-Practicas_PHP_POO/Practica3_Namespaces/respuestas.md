# Respuestas – Práctica 3

- Los **namespaces** permiten agrupar clases y diferenciar clases que tienen el mismo nombre. En esta práctica existen dos clases `Usuario`, pero una pertenece a `Centro\Academia` y otra a `Centro\Biblioteca`.
- `use` permite importar un nombre y utilizarlo con un alias, como `Alumno` y `Lector`. No carga el fichero. La carga se realiza automáticamente mediante la función registrada con `spl_autoload_register()`.
- `nombre` no es una propiedad estática: cada objeto tiene su propio nombre. `readonly` impide modificar esa propiedad después de inicializarla; no significa que sea compartida por todos los objetos.
- La asignación comentada `$alumno2->nombre = "Marta";` produciría un error porque intenta modificar una propiedad `readonly` después de construir el objeto.

El contador mide las instancias creadas. Por eso continúa valiendo 2 después de `unset($alumno1)`: eliminar una variable no resta una creación del contador.
