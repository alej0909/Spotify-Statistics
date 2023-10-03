<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php
        session_start();
        $us=$_SESSION["usuario"];
        if ($us==""){
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
          <a class="nav-link active" href="artista.php" aria-current="page" >Inicio</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="artista-canciones.php"  >Mis canciones</a>
        </li>
      </ul>
    </div>
  </div>
  <?php echo "<a class='nav-link' href='logout.php'>Logout $us</a>"; ?>
</nav>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">id notificacion</th>
        <th scope="col">usuario</th>
        <th scope="col">cancion</th>
        <th scope="col">artista</th>
        <th scope="col">calificacion</th>
        <th scope="col">opinion</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $nombre = str_replace(" ", "%20", $_SESSION["nombre"]);
        $servurl="http://localhost:3003/notificaciones/artista/". $nombre ;
        $curl=curl_init($servurl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response=curl_exec($curl);
       
        if ($response===false){
            curl_close($curl);
            die("Error en la conexion");
        }

        curl_close($curl);
        $resp=json_decode($response);
        $long=count($resp);
        for ($i=0; $i<$long; $i++){
            $dec=$resp[$i];
            $id_notificacion=$dec -> id_notificacion;
            $usuario=$dec->usuario;
            $cancion=$dec->cancion;
            $artista=$dec->artista;
            $calificacion=$dec->calificacion;
            $opinion=$dec->opinion;
     ?>
    
        <tr>
        <td><?php echo $id_notificacion; ?></td>
        <td><?php echo $usuario; ?></td>
        <td><?php echo $cancion; ?></td>
        <td><?php echo $artista; ?></td>
        <td><?php echo $calificacion; ?></td>
        <td><?php echo $opinion; ?></td>
        </tr>
     <?php 
        }
     ?>   
    </tbody>
    </table>

</body>