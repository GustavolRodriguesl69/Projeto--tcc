<?php
session_start();
if (empty($_SESSION)) {
    echo "<script>location.href='../login.php';</script>";
}

include '../PHP/conexao.php';

$id_produto = $_GET['id_produto'];

$sql = "DELETE FROM tb_pedidos WHERE id_produto = $id_produto";
if ($conn->query($sql) === TRUE) {
    echo "<script>location.href='../carrinho.php';</script>";
} else {
    echo "Erro ao remover item: " . $conn->error;
}

$conn->close();
?>
