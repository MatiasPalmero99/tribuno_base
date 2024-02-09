<!doctype html>
<html lang="en">
  <head>
    <title>Club Tribuno</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/logo.png">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
      .bg{
        background-color: rgba(3, 171, 3, 0.927);
        margin-top: 35px;
      }
      .bg2{
        background-color: green;
        margin-top: 50px;
      }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  </head>
  
  <body class="bg2">
  
    <div class="container-fluid w-75 mt-4 rounded-5 rounded shadow">
          <div class="row">
            <div class="col-6 d-none d-lg-block rounded-start">
              <img src="../images/logo.png" class="rounded-start bg2" width="100%" height="90%" alt="">
            </div>

            <div class="col-12 col-md-6 bg-white p-3 p-lg-5 rounded-end">
                <div class="text-end">
                    <img src="../images/logo.png" width="70" class="m-0" alt="">
                </div>
                <h2 class="fst-italic fw-bold text-center pt-1 mb-2 mb-lg-4">Bienvenido</h2>
                <p>Este es un prototipo de sistema real del club "El Tribuno Basquet"</p>
                <p>Usuario: MatiPalm</p>
                <p>Clave: 1234</p>


                <form method="POST" action="login_funcionamiento.php">
                    <div class="mb-4 mb-lg-2">
                        <label for="user" class="form-label">Usuario:</label>   
                        <input type="user" class="form-control" name="user" required><br>
                    </div>
                    <div class="mb-4 mb-lg-5">
                        <label for="password" class="form-label">Contraseña: </label>   
                        <input type="password"  class="form-control" name="contra_usuario" required><br>
                    </div>
                    <!-- <div class="mb-4 mb-lg-2 form-check">
                      <input type="checkbox" name="connected" class="form-check-input" id="">
                      <label for="connected" class="form-check-label">Mantenerme conectado</label>
                    </div> -->
<?php   
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
                            
?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Usuario o Contraseña incorrecto, vuelva a intentar.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

<?php
                    }
?>
                    <div class="d-grid">
                      <button type="submit" class="btn btn-dark" name="enviar">Iniciar Sesión</button>
                    </div>
                    <div class="d-grid pt-2 mb-2">
                      <a href="../index.php"><button type="button" class="btn btn-secondary w-100">Ir a Página Principal</button></a>
                    </div>
<!--
                    <div class="my-3">
                      <span>No tienes cuenta? <a href="#">Regístrate</a></span>
                      <span><a href="#">Recuperar Contraseña</a></span>
                    </div>
-->
                </form>

                <!-- LOGIN CON REDES SOCIALES -->

                <!-- <div class="container w-100 my-2">
                  <div class="row text-center">
                    <div class="col-12 mb-3 mb-lg-2">
                      Iniciar Sesión
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <button class="btn btn-outline-primary w-100 my-1">
                        <div class="row align-items-center">
                          <div class="col-2 d-none d-md-block">
                            <img src="images/facebook.png" width="32" alt="">
                          </div>
                          <div class="col-12 col-md-10 text-center">
                            Facebook
                          </div>
                        </div>
                      </button>
                    </div>
                    <div class="col">
                      <button class="btn btn-outline-danger w-100 h-90 my-1">
                        <div class="row align-items-center">
                          <div class="col-2 d-none d-md-block">
                            <img src="images/google.png" width="55" alt="">
                          </div>
                          <div class="col-12 col-md-10 text-center">
                            Google
                          </div>
                        </div>
                      </button>
                    </div>
                  </div>

                </div> -->

            </div>
        </div>
    </div>

  </body>
</html>