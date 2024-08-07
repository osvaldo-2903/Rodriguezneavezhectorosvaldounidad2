<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<!-- Icono del Sitio Web -->
</head>

<body>

	<?php


	/* Conectar a una base de datos de MySQL Local */
	$utf8 = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

	$host = "localhost"; // Cambia esto por tu host de la base de datos
	$usuario = "root"; // Cambia esto por tu nombre de usuario de la base de datos
	$contrasena = ""; // Cambia esto por tu contraseña de la base de datos
	$base_de_datos = "jetpriv"; // Cambia esto por el nombre de tu base de datos
	
	try {
		/* Conectar a una base de datos de MySQL Local */
		$cnnPDO = new PDO("mysql:host=" . $host . "; dbname=" . $base_de_datos, $usuario, $contrasena, $utf8);

	} catch (PDOException $e) {

		echo 'Error al conectar con la base de datos';
	}

	?>

</body>

</html>