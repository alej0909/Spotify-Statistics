<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    $us = $_SESSION["usuario"];
    if ($us == "") {
        header("Location: index.html");
    }
    ?>

                
    
  <!--Barra de incio sesion-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Proyecto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="usuario.php">Inicio</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="usuario-top.php">Top 10 canciones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="usuario-noti.php">Mi perfil</a>
        </li>
      </ul>
    </div>
  </div>
  <?php echo "<a class='nav-link' href='logout.php'>Logout $us</a>"; ?>
</nav>

<div class="container py-4">
  <div class="">
    <div class="w-25 float-start">
      
      <form action="usuario-canciones.php" method="POST">
      <input type="hidden" name="top_genre" value="pop">
      <img src="https://cdn.pixabay.com/photo/2016/03/04/08/36/dance-1235584_1280.jpg" class="img-fluid py-4">
      <button type="submit" id="boton" class="btn btn-success btn-lg text-white w-100 mt-4 fw-semibold shadow-sm">POP</button>
      </form>

      <form action="usuario-canciones.php" method="POST">
      <input type="hidden" name="top_genre" value="dance%20pop">
      <img src="https://cdn.pixabay.com/photo/2013/11/03/08/05/cheers-204742_1280.jpg" class="img-fluid py-4">
      <button type="submit" id="boton" class="btn btn-success btn-lg text-white w-100 mt-4 fw-semibold shadow-sm">DANCE POP</button>
      </form>

      <form action="usuario-canciones.php" method="POST">
      <input type="hidden" name="top_genre" value="atl%20hip%20hop">
      <img src="https://cdn.pixabay.com/photo/2017/08/07/11/02/street-dancer-2602633_1280.jpg" class="img-fluid py-4">
      <button type="submit" id="boton" class="btn btn-success btn-lg text-white w-100 mt-4 fw-semibold shadow-sm">HIP HOP</button>
      </form>
    </div>
    <div class="w-25 float-end btn-sm">
    <form action="usuario-canciones.php" method="POST">
      <input type="hidden" name="top_genre" value="alternative%20metal">
      <img src="https://cdn.pixabay.com/photo/2016/12/17/16/59/guitar-1913837_1280.jpg" class="img-fluid py-4">
      <button type="submit" id="boton" class="btn btn-success btn-lg text-white w-100 mt-4 fw-semibold shadow-sm">ALTERNATIVE METAL</button>
      </form>

      <form action="usuario-canciones.php" method="POST">
      <input type="hidden" name="top_genre" value="edm">
      <img src="https://cdn.pixabay.com/photo/2018/06/10/11/38/festival-3466251_1280.jpg" class="img-fluid py-4">
      <button type="submit" id="boton" class="btn btn-success btn-lg text-white w-100 mt-4 fw-semibold shadow-sm">EDM</button>
      </form>

      <form action="usuario-canciones.php" method="POST">
      <input type="hidden" name="top_genre" value="reggaeton">
      <img src="https://cdn.pixabay.com/photo/2021/01/28/13/33/rabbit-5958033_1280.jpg" class="img-fluid py-4">
      <button type="submit" id="boton" class="btn btn-success btn-lg text-white w-100 mt-4 fw-semibold shadow-sm">REGGAETON</button>
      </form>

    </div>
  </div>
</div>

      <!-- <div class="container py-4" >
        <div class="w-25 float-start"> -->
          <!-- <img src="https://cdn.pixabay.com/photo/2023/08/19/13/42/water-8200504_1280.jpg" class="img-fluid"> -->
        <!-- </div> -->
        <!-- <div class="w-25 float-end"> -->
          <!-- <img src="https://cdn.pixabay.com/photo/2023/08/19/13/42/water-8200504_1280.jpg" class="img-fluid"> -->
        <!-- </div>
      </div> -->

      <!-- <div class="container py-4" >
        <div class="w-25 ">
          <img src="https://cdn.pixabay.com/photo/2023/08/19/13/42/water-8200504_1280.jpg" class="img-fluid">
        </div>
        <div class="w-25 float">
          <img src="https://cdn.pixabay.com/photo/2023/08/19/13/42/water-8200504_1280.jpg" class="img-fluid">
        </div>
      </div> -->

    <!-- Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Custom JS -->
    <script src="tablas.js"></script>

</body>

</html>