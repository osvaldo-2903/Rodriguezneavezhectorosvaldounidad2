<?php
include 'db_conexion.php';
session_start();

if (isset($_POST['validar'])) {
    $codigo = $_POST['codigo'];

    // Preparar y ejecutar la consulta para buscar el código en la base de datos
    $query = $cnnPDO->prepare('SELECT * FROM codigos_recuperacion WHERE codigo = :codigo');
    $query->bindParam(':codigo', $codigo);
    $query->execute();

    // Verificar si se encontró el código
    if ($query->rowCount() > 0) {
        $campo = $query->fetch();

        // Puedes agregar lógica adicional para verificar la expiración del código aquí

        echo 'Contraseña Actualizada';
        header("Location: prueba.php");
        exit; // Asegúrate de detener la ejecución del script después de redirigir
    } else {
        echo 'Código incorrecto o expirado.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <label>Codigo:</label>
        <input type="text" name="codigo" id="codigo" required>
        <button type="submit" name="validar">Actualizar Contraseña</button>
    </form>
</body>

</html>