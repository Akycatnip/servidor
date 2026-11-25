# Respuestas – Práctica 5

- `__set()` se activa al asignar una propiedad inaccesible. Solo admite `tema` e `idioma`, y guarda el texto después de quitar los espacios de los extremos.
- `__get()` se activa al leer una propiedad inaccesible. Si no existe en el array, devuelve `null`.
- `__isset()` se activa al utilizar `isset()` con una propiedad inaccesible.
- `__unset()` se activa al eliminar una propiedad inaccesible.
- `__call()` se activa al llamar a un método de instancia inexistente o inaccesible. En esta práctica permite únicamente `obtener` con un argumento.
- `__callStatic()` se activa al llamar a un método estático inexistente o inaccesible. Permite `Registro::crear()` sin argumentos.
- `__invoke()` se activa al utilizar el objeto como si fuera una función.
- `__toString()` se activa al convertir el objeto en una cadena.
- `__debugInfo()` proporciona los datos que muestra `var_dump()`.
- `__set_state()` se activa al reconstruir el objeto mediante la expresión generada por `var_export()`.

La prueba controla tres errores: asignar una propiedad no permitida, llamar a un método no permitido y llamar a `obtener()` sin el argumento requerido. El fichero exportado se carga con `require` y después se elimina.
