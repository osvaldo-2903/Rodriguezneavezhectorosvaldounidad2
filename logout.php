<?php
include 'db_conexion.php';
session_start();

// Obtener el token de sesión actual
$session_token = session_id();

// Eliminar la sesión actual de la base de datos
$sql = "DELETE FROM sesiones WHERE session_token = :session_token";
$stmt = $cnnPDO->prepare($sql);
$stmt->bindParam(':session_token', $session_token, PDO::PARAM_STR);
$stmt->execute();

// Destruir la sesión actual
session_unset();
session_destroy();

// Redirigir al usuario a la página de inicio de sesión
header("Location: prueba.php");
exit;
?>