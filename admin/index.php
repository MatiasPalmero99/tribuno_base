<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- LOGO PAGINA -->
    <link rel="icon" href="images/logo.png">

    <!-- Bootstrap CSS -->
    <link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!-- Mi estilo CSS -->
    <link rel="stylesheet" href="css/estilo.css">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;400;500&family=Roboto:ital,wght@0,400;0,700;1,500;1,700&display=swap" rel="stylesheet">

    <title>EL TRIBUNO BASQUET</title>
  </head>
  <body>

    <!-- CONTACTO -->
    <div class="fixed-top sps sps--abv">
      <div class="contact">
          <div class="container-fluid">
              <div class="d-flex justify-content-end">
                  <p>CONTACTO: </p>
                  <a href="https://www.facebook.com/tribuno.basquet/"><i class="bi bi-facebook"></i></a>
                  <a href="https://www.instagram.com/tribuno.basquet/"><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-whatsapp"></i></a>
                  <a href=""><i class="bi bi-twitter"></i></a>
              </div>
          </div>
      </div>

    <!-- MENU -->
      <div class="menu">
        <nav class="navbar navbar-expand-lg navbar-dark" >
            <div class="container">
                    <a class="navbar-brand" href="#">
                        <img class="logotipo" src="images/logo.png" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.html">INICIO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">SOBRE NOSOTROS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#mapa">COMO LLEGAR</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="panel_admin.php">
                                PANEL ADM
                                </a>
                            </li>
                            <li class="nav-item ">
                              <a class="nav-link" href="cards_index.php">
                                CARDS
                              </a>
                          </li>
                        </ul>
                        <div class="iniciar-sesion">
                            <div class="d-inline-flex p-2">
                                <a class="d-flex justify-content-end" href="LogIn/login_index.html">Iniciar Sesión</a>
                            </div>
                        </div>
                    </div>
                    
            </div><!-- FIN CONTAINER -->   
        </nav>
      </div>
    </div>
    <!-- SLIDER -->
    <div class="carrusel">
      
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
          
          
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner">
              

              <div class="carousel-item active">
                <img src="images/pic_fondo2.jpg" class="d-block w-100" alt="Fondo-carrusel">
                <div class="carousel-caption d-none d-md-block">

                  <section class="secthead">
                    <div class="escudo">
                      <img src="images/logo.png" alt="">
                    </div>
                  </section>
                  
                  <h5>PRIMER TITULO EL TRIBUNO</h5>
                  <p>Some representative placeholder content for the first slide.</p>
                </div>
              </div>

              <div class="carousel-item">
                <img src="images/pic_fondo2.jpg" class="d-block w-100" alt="Fondo-carrusel">
                <div class="carousel-caption d-none d-md-block">

                  <section class="secthead">
                    <div class="escudo">
                      <img src="images/logo.png" alt="">
                    </div>
                  </section>

                  <h5>SEGUNDO TITULO EL TRIBUNO</h5>
                  <p>Some representative placeholder content for the second slide.</p>
                </div>
              </div>

              <div class="carousel-item">
                <img src="images/pic_fondo2.jpg" class="d-block w-100" alt="Fondo-carrusel">
                <div class="carousel-caption d-none d-md-block">

                  <section class="secthead">
                    <div class="escudo">
                      <img src="images/logo.png" alt="">
                    </div>
                  </section>

                  <h5>TERCER TITULO EL TRIBUNO</h5>
                  <p>Some representative placeholder content for the third slide.</p>
                </div>
              </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>


    </div>

    <!-- MAIN -->

    <main>

      <section class="categorias">

        <div class="container">
          <div class="row">

            <!-- <div class="col-12 col-sm-4 text-center"> -->
            <div class="card text-center " style="width: 25rem;">
              <img class="img-fluid w-100" src="images/categorias/cat1.jpg" width="300px" alt="">
              <div class="card-body">
                <h5>CATEGORIA 1</h5>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
              </div>
            </div>

            <div class="card text-center " style="width: 25rem;">
                <img class="img-fluid w-100" src="images/categorias/cat2.jpg" width="300px" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-text">CATEGORIA 2</h5>
                  <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>

            <div class="card text-center col-12" style="width: 25rem;">
                <img class="img-fluid w-100 card-img-top" src="images/categorias/cat3.jpg" width="300px" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-text">CATEGORIA 3</h5>
                  <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
          </div>
        </div>

      </section>
      <section>
        <div class="container">
          <div class="row g-6">
            <div class="seccion2 col-lg-12">
              <div class="card col-lg-6" style="width: 18rem;">
                <img src="images/categorias/cat4.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Gran triundo en Primera vs 20 Febrero</h5>
                  <p class="card-text">Gran triunfo del Tribuno Básquet en Primera  vs 20 de Febrero y despedida de un jugador de la casa Mauro Giron , 
                  toda la familia verdolaga te desea lo mejor en esta nueva etapa de tu carrera!! Por siempre del Tribuno Basquet!!</p>
                  <a href="<iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Ftribuno.basquet%2Fposts%2Fpfbid02TuDdn2s54URDr2aH1W54Zki968J8gA2b6jsBvy1nj37jCCC1Uq1ajhcnmcAyHTNXl&show_text=true&width=500">
            </div>
          </div>


          <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Ftribuno.basquet%2Fposts%2Fpfbid02TuDdn2s54URDr2aH1W54Zki968J8gA2b6jsBvy1nj37jCCC1Uq1ajhcnmcAyHTNXl&show_text=true&width=500" width="500" height="703" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
          <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Ftribuno.basquet%2Fposts%2Fpfbid0B1c2469jBBUe4Acd6u9AHnmtKnyFgoPULMRpGMmWVeN7H8zpmEzS87Pz8hpVHmREl&show_text=true&width=500" width="500" height="648" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
          <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Ftribuno.basquet%2Fposts%2Fpfbid02xVaFfYWnMS6HgwMmprfBZKp5LQUKS5QLhauNJi1uzw9yLTSN7uJYT57afeJ3UvFPl&show_text=true&width=500" width="500" height="629" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
            <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Ftribuno.basquet%2Fposts%2Fpfbid02z6cxNyufUvvnevb6RByeg1AtZG9SzrbYPHs8jxMPq7A6e547jy3PAn9XTHL4Kqkbl&show_text=true&width=500" width="500" height="423" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
        </div>
      </section>

      <section class="ubicacionContactos" id="mapa">
        <div class="container">
          <div class="row">
            <!--Mapa de ubicacion-->
            <div class="col-6 col-sm-4">
                <div>
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d231462.7047551611!2d-65.70716693805403!3d-24.979558433271563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x941bc2cdd8cc00f1%3A0xe1fb1540062e82c4!2sComplejo%20Deportivo%20Nicolas%20Vitale!5e0!3m2!1ses!2sar!4v1657207825050!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
                </div>
            </div>
            <!--Contactos-->
            <div class="col-6 col-sm-8 text-center">
              <div>
                  <h3>CONTACTANOS: </h3>
                  <p id="atencion">ATENCIÓN:</p>
                  <p>De Lunes a Viernes de 8am a 22pm y Sabados y feriados de 11am a 19pm.</p>
                  <p id="direccion">DIRECCIÓN:</p>
                  <p>Roque Saenz Peña 60,Rosario de Lerma,Salta</p>
                  <p id="contactos">CONTACTOS:</p>
                  <p>3876131423 / 4932562</p>
                  <p id="web">NUESTRA WEB:</p>
              </div>
            </div>
          </div>
        </div>
      </section>


    </main>




    <!--Bootstrap JS-->
    <script src="libs/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- MENU SCROLL -->
    <script src="js/scrollPosStyler.min.js"></script>
  </body>
</html>