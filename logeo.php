<?php
include 'db_conexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['entrar'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Nota: La contraseña debe estar en texto claro y no estar hasheada
    $sql = "SELECT id, nombre, password, tipo FROM usuarios WHERE email = :email";
    $stmt = $cnnPDO->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Comparar la contraseña ingresada con la contraseña almacenada en texto claro
        if ($password === $row['password']) {
            // Establecer variables de sesión
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $email;
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['tipo'] = $row['tipo'];

            // Generar token de sesión
            $session_token = session_id();

            // Obtener IP y User Agent
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];

            // Guardar la sesión en la base de datos
            $sql = "INSERT INTO sesiones (user_id, session_token, ip_address, user_agent) 
                    VALUES (:user_id, :session_token, :ip_address, :user_agent)";
            $stmt = $cnnPDO->prepare($sql);
            $stmt->bindParam(':user_id', $row['id'], PDO::PARAM_INT);
            $stmt->bindParam(':session_token', $session_token, PDO::PARAM_STR);
            $stmt->bindParam(':ip_address', $ip_address, PDO::PARAM_STR);
            $stmt->bindParam(':user_agent', $user_agent, PDO::PARAM_STR);
            $stmt->execute();

            session_regenerate_id(true); // Regenerar ID de sesión

            // Redirigir al usuario a la interfaz
            header("Location: interface.php");
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>