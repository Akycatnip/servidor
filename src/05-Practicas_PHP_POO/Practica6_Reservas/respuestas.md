# Respuestas – Práctica 6

- Los intentos fallidos no consumen plazas porque `reservar()` comprueba primero que la cantidad sea positiva y que haya plazas suficientes. La resta solo se realiza después de superar las dos comprobaciones.
- `finally` se utiliza para mostrar las plazas disponibles después de cada intento, tanto si la operación termina correctamente como si se produce una excepción.
- El `try` interior captura `PlazasAgotadasException`, registra la incidencia y vuelve a lanzar la excepción con `throw`. Así puede capturarla el `catch` exterior.
- Al deserializar no se ejecuta el constructor. En este caso `__unserialize()` valida los datos y restaura las propiedades necesarias.
- `__serialize()` devuelve un array asociativo con los datos que se quieren guardar. `__unserialize()` recibe ese array y reconstruye el objeto.
- En el mecanismo legado, `__sleep()` devuelve los nombres de las propiedades que se serializan y `__wakeup()` se ejecuta al recuperar el objeto para restaurar el estado temporal.
- El constructor con -1 produce `InvalidArgumentException`. La restauración con `plazas` igual a `"tres"` produce `UnexpectedValueException`.

La reserva termina con 3 plazas: la petición de 2 se acepta; la de 0 se rechaza por ser un dato incorrecto; y la de 4 se rechaza por falta de plazas. La restauración moderna muestra `3 - restaurada` y una identidad distinta. La variante legada también muestra `3 - restaurada`.
