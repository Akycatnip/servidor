# Respuestas – Práctica 4

- `$b = $a` no crea otro objeto: las dos variables apuntan al mismo objeto. Por eso `$a === $b` es `1`.
- `clone` crea otro objeto. Por eso `$a === $c` es `0`. Como inicialmente sus propiedades tienen los mismos valores, `$a == $c` es `1`.
- Sin `__clone()`, la propiedad `direccion` del clon seguiría apuntando al mismo objeto `Direccion` que la ficha original. Al implementar `__clone()` y clonar también la dirección, cada ficha tiene una dirección independiente.
- `mudar()` modifica el objeto recibido. Los objetos se pasan como referencias a objetos, así que no hace falta escribir `&`. Como `$a` y `$b` apuntan al mismo objeto, el cambio se ve desde ambas variables.
- Si dentro de `mudar()` se asignara al parámetro otra instancia de `Ficha`, eso cambiaría la variable local del parámetro, pero no haría que la variable del llamador apuntase a esa nueva instancia.
- `copiaEn()` clona la ficha y cambia la ciudad de la copia. El original conserva Sevilla.
- El destructor se ejecuta cuando ya no queda ninguna referencia al objeto. Al eliminar `$t1`, todavía existe `$t2`, así que no se destruye. Al eliminar `$t2`, se destruye el objeto y aparece `Testigo destruido` antes de `Fin`.
