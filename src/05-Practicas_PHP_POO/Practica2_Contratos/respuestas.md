# Respuestas – Práctica 2

- `CanalConHistorial` exige los métodos `enviar(string $mensaje): string` e `historial(): array`. El primero lo hereda de `Canal` y el segundo lo añade.
- `ServicioAvisos` acepta los dos objetos porque ambos implementan la interfaz `Canal`. El servicio solo necesita llamar a `enviar()`.
- No puede asumir que cualquier `Canal` tiene `historial()`, porque ese método solo forma parte de `CanalConHistorial`, no de la interfaz general `Canal`.

La prueba utiliza el mismo aviso con los dos canales. Uno devuelve el prefijo `MEMORIA:` y el otro `PANTALLA:`. El historial pasa de un mensaje a cero al llamar a `reiniciar()`.
