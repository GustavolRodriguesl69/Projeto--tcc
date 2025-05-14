<?php
session_start();
if (empty($_SESSION)) {
    header("Location: ../login.php");
    exit();
}

include './conexao.php';

$id_produto = intval($_POST['id_produto'] ?? 0);
$id_cliente = intval($_SESSION['id_cliente'] ?? 0);

if ($id_produto > 0 && $id_cliente > 0) {
    $result = $conn->query("SELECT id_carrinho FROM tb_carrinhos WHERE id_cliente = $id_cliente");

    if ($result->num_rows > 0) {
        $id_carrinho = $result->fetch_assoc()['id_carrinho'];
    } else {
        if ($conn->query("INSERT INTO tb_carrinhos (id_cliente) VALUES ($id_cliente)")) {
            $id_carrinho = $conn->insert_id;
        } else {
            echo "Erro ao criar carrinho: " . $conn->error;
            exit();
        }
    }

    $result = $conn->query("SELECT id_item, quantidade FROM tb_pedidos WHERE id_carrinho = $id_carrinho AND id_produto = $id_produto");

    if ($result->num_rows > 0) {
        $pedido = $result->fetch_assoc();
        $nova_quantidade = $pedido['quantidade'] + 1;
        $sql = "UPDATE tb_pedidos SET quantidade = $nova_quantidade WHERE id_item = {$pedido['id_item']}";
    } else {
        $sql = "INSERT INTO tb_pedidos (id_carrinho, id_produto, quantidade) VALUES ($id_carrinho, $id_produto, 1)";
    }

    if ($conn->query($sql)) {
        echo "Produto adicionado ao carrinho com sucesso.";
        echo "<script>location.href='../carrinho.php';</script>";
    } else {
        echo "Erro ao adicionar produto ao carrinho: " . $conn->error;
    }
} else {
    echo "Produto ou cliente inválido.";
}

$conn->close();
?>