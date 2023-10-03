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
  <style>
      .table-row-link {
        cursor: pointer;
        background-color: #f8f9fa;
      }

      .table-row-link:hover {
        background-color: #e9ecef;
      }
</style>
</head>

<body>
  <?php
  session_start();
  $us = $_SESSION["usuario"];
  if ($us == "") {
    header("Location: index.html");
  }
  ?>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Proyecto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="artista.php" aria-current="page" >Inicio</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" href="artista-canciones.php"  >Mis canciones</a>
        </li>
      </ul>
    </div>
  </div>
  <?php echo "<a class='nav-link' href='logout.php'>Logout $us</a>"; ?>
</nav>
<table id="datatable_users" class="table table-striped">
  <thead>
    <tr>
      <th scope="col">title</th>
      <th scope="col">artist</th>
      <th scope="col">top genre</th>
      <th scope="col">year</th>
    
    </tr>
  </thead>
  <tbody id="tableBody_users">
  
    <?php
    $nombre = str_replace(" ", "%20", $_SESSION["nombre"]);
    $servurl = "http://localhost:3002/canciones/artista/" . $nombre;
    $curl = curl_init($servurl);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);

    if ($response === false) {
      curl_close($curl);
      die("Error en la conexion");
    }
    
    curl_close($curl);
    $resp = json_decode($response);
    
    $resp = $resp;
    $long = count($resp);
    for ($i = 0; $i < $long; $i++) {
      $dec = $resp[$i];
      $title = $dec->title;
      $artist = $dec->artist;
      $genre = $dec->top_genre;
      $year = $dec->year;

      ?>

      <tr class="table-row-link" onclick="redirectToEstadisticas('<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>');">
        <td>
          <?php echo $title; ?>
        </td>
        <td>
          <?php echo $artist; ?>
        </td>
        <td>
          <?= $genre; ?>
        </td>
        <td>
          <?php echo $year; ?>
        </td>

      </tr>
      <?php
    }
    ?>
        


  </tbody> <!--Se referencia en js para que se llene las casillas de la tabla-->
</table>


  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    CREAR CANCION
  </button>
  <div class="modal" id="exampleModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">CREAR CANCION</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="crearCancion.php" method="post">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nombre de la cancion</label>
              <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">genero</label>
              <input type="text" name="genre" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">

            </div>
 
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Crear Cancion</button>
            </div>
        </div>
      </div>
    </div>
    <script>
    function redirectToEstadisticas(title) {
      // Redireccionar a estadisticas.php con el valor del título como parámetro

      window.location.href = 'artista-estadisticas.php?title=' + encodeURIComponent(title);
      
    }
</script>
 
  </body>