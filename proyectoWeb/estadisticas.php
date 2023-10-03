<?php 
$currentURL = $_SERVER["REQUEST_URI"];
$title = substr($currentURL, 36); // Obtener una subcadena a partir del índice 20 hasta el final
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radial Progress Bars</title>
    <!-- Incluye la biblioteca ProgressBar.js -->
    <script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/1.0.1/dist/progressbar.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        /* Estilo para el contenedor principal */
        .progress-container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        /* Estilo para cada círculo de progreso */
        .circle-container {
            text-align: center;
            position: relative;
            margin: 10px;
        }

        /* Estilo para el texto de porcentaje */
        .percentage-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: sans-serif;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .song-title {
            font-size: 36px;
            font-weight: bold;
        }

        .artist {
            font-size: 24px;
            color: #6e806e;
        }

        .info-card {
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            padding: 5px 30px;
            margin: 20px;
            display: inline-block;
        }

        .info-card-calification {
            text-align: center;
            background-color: #16361a;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            padding: 20px;
            margin: 20px;
            display: inline-block;
        }

        /*info cards con fondo verde */
        .green-background {
            font-size: 17px;
            background-color: #208454; 
            color: white; 
            border-radius: 10px;
            padding: 5px 30px;
            margin: 10px;
            display: inline-block;
        }

        /* Estilo para la animación de cambio de color */
        .beat-indicator {
            width: 20px;
            height: 20px; 
            background-color: white; /* Color inicial (blanco) */
            border-radius: 50%; /* Para hacerlo circular */
            display: inline-block;
            margin-left: 10px; /* Espacio entre el BPM y el indicador de beat */
        }

        .black-background {
        background-color: black;
        color: white;
        border-radius: 10px;
        padding: 0.5px 30px;
        margin: 10px;
        font-size: 14px; /* Ajusta el tamaño de fuente según tu preferencia */
        }

        .song-title,
        .black-background {
            display: inline-block;
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
          <a class="nav-link" href="usuario.php">Inicio</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="usuario-top.php"  >Top 10 canciones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="usuario-noti.php" aria-current="page">Mi perfil</a>
        </li>
      </ul>
    </div>
  </div>
  <?php echo "<a class='nav-link' href='logout.php'>Logout $us</a>"; ?>
</nav>
  <?php
    $servurl = "http://localhost:3004/estadisticas/" . $title;
    $curl = curl_init($servurl);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);

    if ($response === false) {
      curl_close($curl);
      die("Error en la conexion");
    }
    
    curl_close($curl);
    $resp = json_decode($response);
    
    $resp = $resp[0];
    $title = $resp->title;
    $artist = $resp->artist;
    $genre = $resp->top_genre;
    $year = $resp->year;
    $bpm = $resp->bpm;
    $energy = $resp->energy;
    $danceability = $resp->danceability;
    $dB = $resp->dB;
    $liveness = $resp->liveness;
    $valence = $resp->valence;
    $acousticness = $resp->acousticness;
    $speechiness = $resp->speechiness;
    $cantidadop = $resp->cantidadop;
    $calificacion = $resp->calificacion;
    $popularity =$resp->popularity;
    

    ?>

    <div class="info-card green-background">
        <p><b> Calificación</b></p>
        <p> <?=$calificacion?> </p>
    </div>

    <div class="info-card">
        <p> <b> Opiniones: </b> </p>
        <p> <?=$cantidadop?> </p>  
    </div>
    

    <div class="title-info-container">
        <div class="song-title"><?=$title?></div>
        <div class="black-background">
            <p><?=$year?></p>
        </div>
        <div class="black-background">
            <p><?=$genre?></p>
        </div>
    </div>


    
    <div class="artist"><?=$artist?></div>

    
    <div class="info-card">
        <p> <b> <?=$bpm?> </b> </p>
        <p>BPM</p>
        <div class="beat-indicator"> </div>
    </div>


    
    <div class="progress-container">
        <!-- Círculo de progreso principal -->

        <div class="circle-container">
            <div id="popularity-container"></div>
            <div> <br> Popularity</div>
        </div>
        
        <div class="circle-container">
            <div id="progress-container"></div>
            <div> <br> Energy </div>
        </div>

        <!-- Otros círculos de progreso -->
        <div class="circle-container">
            <div id="danceability-container"></div>
            <div> <br> Danceability</div>
        </div>
        <div class="circle-container">
            <div id="db-container"></div>
            <div> <br> Loudness</div>
        </div>
        <div class="circle-container">
            <div id="liveness-container"></div>
            <div> <br> Liveness</div>
        </div>
        <div class="circle-container">
            <div id="valence-container"></div>
            <div> <br> Valence</div>
        </div>
        <div class="circle-container">
            <div id="acousticness-container"></div>
            <div> <br> Acousticness</div>
        </div>
        <div class="circle-container">
            <div id="speechiness-container"></div>
            <div> <br> Speechiness</div>
        </div>
        
    </div>
   
        <div class="modal-header">
          <h5 class="modal-title">OPINAR CANCION</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="calificarCancion.php" method="post">
            <input type="hidden" name="cancion"value="<?=$title?>">
            <input type="hidden" name="artista"value="<?=$artist?>">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Calificación</label>
              <input type="number" max="10" min="1" name="calificacion" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Opinión</label>
              <input type="text" name="opinion" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">

            </div>
 
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Crear opinión</button>
            </div>
        </div>
      </div>
    </div>
    <script>
        // Función para crear un círculo de progreso
        function createProgressBar(containerId, startValue, text) {
            var progressBar = new ProgressBar.Circle(containerId, {
                strokeWidth: 5, // Ancho de la línea de progreso (más pequeño)
                easing: 'easeInOut', // Tipo de animación
                duration: 2000, // Duración de la animación en milisegundos
                color: '#4CAF50', // Color de la barra de progreso
                trailColor: '#f0f0f0', // Color del fondo de la barra de progreso
                trailWidth: 5, // Ancho del fondo de la barra de progreso (más pequeño)
                text: {
                    autoStyleContainer: false // Desactiva el estilo automático del texto
                },
                from: { color: '#4ec78d' }, // Color inicial
                to: { color: '#208454' }, // Color final
                step: function(state, circle) {
                    circle.path.setAttribute('stroke', state.color); // Cambia el color de la línea de progreso
                    circle.setText(Math.round(circle.value() * 100) + '%'); // Actualiza el texto con el porcentaje
                }
            });

            progressBar.animate(startValue); // Inicia la animación con el valor inicial

            // Centra el texto de porcentaje en el medio del círculo
            progressBar.text.style.fontSize = '20px';
            progressBar.text.style.color = '#173b2a'; // Color del texto
            progressBar.text.style.fontWeight = 'bold'
            progressBar.text.style.top = '40%'
        }

        // Crear círculos de progreso
        createProgressBar('#popularity-container', <?=$popularity?>/100, 'Popularity');
        createProgressBar('#progress-container', <?=$energy?>/100, 'Energy');
        createProgressBar('#danceability-container', <?=$danceability?>/100, 'Danceability');
        createProgressBar('#db-container', <?=$dB?>/100, 'dB');
        createProgressBar('#liveness-container', <?=$liveness?>/100, 'Liveness');
        createProgressBar('#valence-container', <?=$valence?>/100, 'Valence');
        createProgressBar('#acousticness-container',<?=$acousticness?>/100, 'Acousticness');
        createProgressBar('#speechiness-container', <?=$speechiness?>/100, 'Speechiness');
        

        // Obtén el elemento del indicador de beat
        var beatIndicator = document.querySelector('.beat-indicator');

        // Define el BPM (cambia esto según tu BPM real)
        var bpm = <?=$bpm?>;

        // Calcula el tiempo de espera entre cada beat en milisegundos
        var beatInterval = 60000 / bpm; // 60000 ms en un minuto

        // Función para cambiar el color del indicador de beat y luego volver a blanco
        function toggleBeatIndicatorColor() {
            beatIndicator.style.backgroundColor = 'green'; // Cambia a verde
            setTimeout(function () {
                beatIndicator.style.backgroundColor = 'white'; // Cambia a blanco después de un breve período
            }, 100); // 100 ms para el breve destello verde (ajusta según tu preferencia)
        }

        // Inicia la animación de cambio de color
        setInterval(toggleBeatIndicatorColor, beatInterval);
    </script>
</body>
</html>