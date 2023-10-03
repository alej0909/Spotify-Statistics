<?php
// ID del producto que deseas eliminar
 // Cambia esto al ID del producto que deseas eliminar
 $cancion=$_POST["cancion"];
// URL de la solicitud DELETE con el ID del producto
$url = 'http://localhost:3002/canciones/' . $cancion;

// Inicializar cURL
$ch = curl_init();

// Configurar opciones de cURL para una solicitud DELETE
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la solicitud DELETE
$response = curl_exec($ch);


// Cerrar la conexión cURL
curl_close($ch);

$url = 'http://localhost:3002/estadisticas/' . $cancion;

// Inicializar cURL
$ch = curl_init();

// Configurar opciones de cURL para una solicitud DELETE
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la solicitud DELETE
$response = curl_exec($ch);

// Manejar la respuesta
if ($response === false) {
    header("Location:index.html");
} else {
    // La respuesta del servidor debe contener información sobre si la eliminación fue exitosa
    // Puedes manejar la respuesta según tus necesidades
    header("Location:artista-canciones.php");
}

// Cerrar la conexión cURL
curl_close($ch);



?>
