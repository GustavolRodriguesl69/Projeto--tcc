<?php
session_start();
if (empty($_SESSION) || ($_SESSION["tipo"] && $_SESSION["tipo"] != "admin")) {
    echo "Não autorizado.";
    return;
}

include '../PHP/conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM tb_clientes WHERE id_cliente=$id";

if ($conn->query($sql) === TRUE) {
    echo "Registro excluído com sucesso";
} else {
    echo "Erro ao excluir registro: " . $conn->error;
}

$conn->close();
echo "<script>location.href='admin.php';</script>";
?>
