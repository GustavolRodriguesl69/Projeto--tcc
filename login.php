<?php
    session_start();
    if(empty($_POST) or (empty($_POST["email"]) or (empty($_POST["senha"])))){
        echo "<script> location.href='../index.php';</script>";
    }
    include("conexao.php");
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $sql = "select * from tb_clientes where email = '{$email}'
    AND senha ='{$senha}'";
    $res = $conn->query($sql) or die($conn->error);   
    $row = $res->fetch_object();
    $qtd = $res->num_rows;
    if($qtd > 0){
        $_SESSION["email"] = $email;
        $_SESSION["id_cliente"] = $row->id_cliente;
        $_SESSION["nome"] = $row->nome;
        $_SESSION["tipo"] = $row->tipo;

        echo"<script> location.href='../index.php';</script>";
    }else{
        echo"<script>alert('email ou senha invalido');</script>";
        echo"<script>location.href='../index.php';</script>";
    }
?>  