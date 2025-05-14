<?php
    $host = "localhost";
    $bd = "Jose";
    $usuario = "root";
    $senha = "";
    //$usuario = "root";
    //$senha = "";

    $conn = mysqli_connect($host, $usuario, $senha, $bd);

    //$mysqli = new mysqli($host, $usuario, $senha, $bd);

    if ($conn ->connect_errno){
        echo "falha ao conectar (" . $mysqli->connect_errno . ")"
         . $mysqli->connect_errno;

    }else{
        //echo "Conectado com sucesso no banco Jose. $bd.";
    }
?>