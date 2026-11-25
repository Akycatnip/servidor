# Respuestas – Práctica 1

- **No se puede instanciar `Envio`** porque es una clase abstracta. Sirve como clase base y declara el método abstracto `coste()`.
- **Una clase hija no puede acceder a `destino`** porque es `private`. La propiedad solo es accesible desde la propia clase `Envio`. `peso` sí es accesible desde las hijas porque es `protected`.
- **No se puede sobrescribir `resumen()`** porque está declarado como `final`.
- **No se puede heredar de `EnvioUrgente`** porque la clase también está declarada como `final`.
- Al llamar a `resumen()`, PHP ejecuta el método `coste()` del objeto real:
  - En `EnvioNormal`, calcula `BASE + 1.5 * peso`.
  - En `EnvioUrgente`, ejecuta su propio `coste()`, que reutiliza `parent::coste()` y suma el recargo.

La prueba muestra 6.00 EUR para el envío normal y 10.00 EUR para el urgente. El peso 0 produce una `InvalidArgumentException` controlada.
