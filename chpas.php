<?php
include 'db_conexion.php'; // Asegúrate de que esta conexión esté bien configurada
require 'vendor/autoload.php';
use Twilio\Rest\Client;

session_start(); // Iniciar la sesión para usar variables de sesión

if (isset($_POST['recuperar'])) {
    $telefono = $_POST['telefono'];

    // Verificar si el número de teléfono existe en la base de datos y obtener el correo
    $sql = "SELECT id, correo FROM usuarios WHERE telefono = :telefono";
    $stmt = $cnnPDO->prepare($sql);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Obtener el correo electrónico del usuario
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $email = $resultado['correo'];

        // Guardar el correo electrónico en una variable de sesión
        $_SESSION['email'] = $email;

        // Generar un código aleatorio de 5 caracteres
        $codigo = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

        // Guardar el código en la base de datos con una fecha de expiración (opcional)
        $sql = "INSERT INTO codigos_recuperacion (codigo, fecha_expiracion) VALUES (:codigo, NOW() + INTERVAL 30 MINUTE)";
        $stmt = $cnnPDO->prepare($sql);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->execute();

        // Enviar el código a través de Twilio
        $sid = "AC0befad9c0f3f74a306fbe79d4c2be8ad"; // Reemplaza con tu SID
        $token = "0664a172d847006567ccf6a9263c3d77"; // Reemplaza con tu token
        $twilio = new Client($sid, $token);

        $telefono_formateado = '52' . $telefono; // Formatear el número de teléfono con el código de país

        $message = $twilio->messages
            ->create(
                "whatsapp:+$telefono_formateado", // Número del destinatario
                array(
                    "from" => "whatsapp:+14155238886", // Reemplaza con tu número de WhatsApp de Twilio
                    "body" => "Tu código de recuperación es: $codigo. Este código expirará en 30 minutos."
                )
            );

        echo 'El código de recuperación ha sido enviado a tu WhatsApp.';
        header("Location: recuperada.php");
    } else {
        echo 'Este número de teléfono no está registrado.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
</head>

<body>
    <form method="POST">
        <label>Número Telefónico:</label>
        <input type="text" name="telefono" id="telefono" required>
        <button type="submit" name="recuperar">Recuperar Contraseña</button>
    </form>
</body>

</html>