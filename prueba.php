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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>


<body>
<section style="background-image: url(img/subscribe-bg.jpg); width: 100%; height: 100vh; background-repeat: no-repeat; background-size: cover;">">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 2rem;">
          <div class="card-body p-5 text-center">
    <div class="prueba">
        
            <h2 style="color: red">INICIO DE SESION</h2> <br>
            
            <form method="post">
            <label for="exampleInputEmail1" class="form-label"><h5>Email</h5></label> <br>
            <input name="email" class="form-control" type="email" type="email" aria-describedby="emailHelp">
                <br>
            <label for="exampleInputPassword1" class="form-label"><h5>Contraseña</h5></label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                <br>
                <button type="submit" name="entrar" id="entrar" class="btn btn-primary">Enviar</button>
            </form>
        
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>