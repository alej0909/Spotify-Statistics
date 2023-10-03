<?php
    $user=$_POST["usuario"];
    $pass=$_POST["password"];

    $servurl="http://localhost:3001/usuarios/$user/$pass";
    $curl=curl_init($servurl);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response=curl_exec($curl);
    curl_close($curl);

    if ($response===false){
        header("Location:index.html");
    }

    $resp = json_decode($response);
    $nom = $resp[0] ->nombre;
    $rol = $resp[0] ->rol;

    if (count($resp) != 0){
        session_start();
        $_SESSION["usuario"]=$user;
        $_SESSION["nombre"] = $nom;
        $_SESSION["rol"] = $rol;
        
        if ($rol === "artista"){ 
            echo "artista";
            header("Location:artista.php");
        } 
        else { 
            echo "usuario";
            header("Location:usuario.php");
        } 
    }
    else {
    header("Location:index.html"); 
    }

?>