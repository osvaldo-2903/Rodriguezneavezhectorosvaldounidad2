<?php
session_start();
include 'db_conexion.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['email'])) {
    header("Location: prueba.php");
    exit;
}

$nombre = $_SESSION['nombre'];
$tipo = $_SESSION['tipo'];

echo "<h1>Bienvenido, $nombre</h1>";

switch($tipo) {
    case 1:
        echo "Contenido para Administrador";
        break;
    case 0:
        echo "Contenido para Usuario Regular";
        break;
    default:
        echo "Contenido para Usuarios Generales";
        break;
}

echo '<br><a href="logout.php">Cerrar Sesión</a>';
?>