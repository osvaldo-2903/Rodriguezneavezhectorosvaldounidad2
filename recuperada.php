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
  <meta charset="utf-8">
  <title>JetPriv</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/avion.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800"
    rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/ceb3be7809.js" crossorigin="anonymous"></script>
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/venobox/venobox.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <!-- UIkit CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.9/dist/css/uikit.min.css" />

  <!-- UIkit JS -->
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.9/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.9/dist/js/uikit-icons.min.js"></script>

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="css/toggle.css">

  <!-- ReCaptcha script -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>



  <!-- =======================================================
    Theme Name: TheEvent
    Theme URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <!-- Uncomment below if you prefer to use a text logo -->
        <!-- <h1><a href="#main">C<span>o</span>nf</a></h1>-->
        <a href="index.html" class="scrollto"
          style="color: white; font-family: Raleway, sans-serif; font-weight: bold; font-size: 20px;"><img
            src="img/avion_3.png" alt="" title=""> JetPriv</a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#intro">Home</a></li>
          <li><a href="#about">Nosotros</a></li>
          <li><a href="#schedule">Calendario</a></li>
          <li><a href="#venue">Evento</a></li>
          <li><a href="#hotels">Reserva</a></li>
          <li><a href="#gallery">Galeria</a></li>
          <li><a href="#supporters">Sponsors</a></li>
          <li><a href="#contact">Contactanos</a></li>
          <li class="buy-tickets"><a href="#buy-tickets">Comprar Boletos</a></li>
          <button class="switch" id="switch">
            <span><i class="fa-regular fa-sun"></i></span>
            <span><i class="fa-regular fa-moon"></i></span>
            <style>
              .switch {
                background: #343D5B;
                border-radius: 1000px;
                border: none;
                position: relative;
                cursor: pointer;
                display: flex;
                outline: none;

                &::after {
                  content: "";
                  display: block;
                  width: 30px;
                  height: 30px;
                  position: absolute;
                  background: #F1F1F1;
                  top: 0;
                  left: 0;
                  right: unset;
                  border-radius: 100px;
                  transition: .3s ease all;
                  box-shadow: 0px 0px 2px 2px rgba(0, 0, 0, .2);
                }

                &.active {
                  background: orange;
                  color: #000;

                  &::after {
                    right: 0;
                    left: unset;
                  }
                }

                span {
                  width: 30px;
                  height: 30px;
                  line-height: 30px;
                  display: block;
                  background: none;
                  color: #fff;
                }
              }
            </style>
            <script>
              const btnSwitch = document.querySelector('#switch');

              btnSwitch.addEventListener('click', () => {
                document.body.classList.toggle('dark');
                btnSwitch.classList.toggle('active');
              });
            </script>
          </button>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">
    <div class="intro-container wow fadeIn">
      <div style="width: 30%; height: 80%; background-color: white; border-radius: 20px;">
        <br>
        <br>
        <img src="img/avion_3.png" alt="" title="" width="70px" height="50px"></a>
        <p class="mb-4 pb-0" style="color: black; margin-top: 1%;">Recupera tu contraseña</p>
        <div class="formulario" style="width: 85%; height: 100%; margin: auto;">
            <br>
            <br>
          <form method="post">
            <div class="uk-margin">
              <div class="uk-inline" style="width: 120%;">
               
                <span class="uk-form-icon" uk-icon="icon: user" style="color: rgb(31, 227, 31);"></span>
                <input class="uk-input" type="text" aria-label="Not clickable icon" placeholder="Codigo de verificacion" id="codigo" name="codigo" required>
              </div>
            </div>
            <div class="uk-margin">
              <div class="uk-inline" style="width: 120%;">
                
                
              </div>
            </div>
            <button class="uk-button uk-button-secondary uk-width-1-1" name="validar" type="submit">Actualizar contraseña</button>
            <br>
            <br>
            <br>
            <h4 style="color: black; font-family: arial: font-size: 20px:">Nota: Al poner el codigo podras hacer la recuperacion de tu contraseña, en caso de que no te llegue el codigo, puedes volver a intentarlo.</h4>
          </form>
          
         
        
          </form>
        </div>
      </div>
    </div>
  </section>

  
  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/venobox/venobox.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <!-- Add Bootstrap JS (required for modal functionality) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>



</body>

</html>