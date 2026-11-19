<?php

session_start();

session_unset();
session_destroy();

header('Location: login.html');
exit;

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Cerrar sesión</title>
</head>
<body>

<form action="salir.php" method="POST">
	<input type="submit" value="Cerrar sesión">
</form>

</body>
</html>