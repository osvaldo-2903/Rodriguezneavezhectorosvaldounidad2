<?php
include 'db_conexion.php';
session_start();
if (isset($_POST['entrar'])) {
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    $query = $cnnPDO->prepare('SELECT * from usuarios WHERE email=:email and password=:password');
    $query->bindParam(':email', $_SESSION['email']);
    $query->bindParam(':password', $_SESSION['password']);
    $query->execute();
    $count = $query->rowCount();
    $campo = $query->fetch();
    if ($count) {
        $_SESSION['email'] = $campo['email'];
        $_SESSION['password'] = $campo['password'];
        header("location:administradores.php");
    } else {
        echo "<p>Datos Erroneos, verifique que el correo tanto como la contraseña sean correctos</p>";
        echo "</div>";
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
    <div class="prueba">
        <center>
            <form method="post">
                <h5>Email</h5>
                <input name="email" placeholder="Email" type="email" style="width: 250px">
                <br>
                <h5>Password</h5>
                <input name="password" placeholder="Password" type="password" style="width: 250px">
                <br>
                <br>
                <button type="submit" name="entrar" id="entrar"> Enviar</button>
            </form>
        </center>
    </div>
    <style>
        .prueba {
            margin-top: 15%;
        }
    </style>
</body>

</html>