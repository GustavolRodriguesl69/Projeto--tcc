<?php
session_start();
if (empty($_SESSION)) {
    echo "<script>location.href='../login.php';</script>";
    exit();
}

include './conexao.php';

$id_produto = intval($_GET['id_produto'] ?? 0);
$quantidade = intval($_GET['quantidade'] ?? 0);
$id_cliente = intval($_SESSION['id_cliente'] ?? 0);

if ($id_produto <= 0 || $quantidade < 0 || $id_cliente <= 0) {
    echo "Produto, cliente ou quantidade inválidos.";
    exit();
}

$carrinhoResult = $conn->query("SELECT id_carrinho FROM tb_carrinhos WHERE id_cliente = $id_cliente");
if ($carrinhoResult->num_rows === 0) {
    echo "Carrinho não encontrado para o cliente.";
    $conn->close();
    exit();
}

$id_carrinho = $carrinhoResult->fetch_assoc()['id_carrinho'];

$pedidoResult = $conn->query("SELECT id_item, quantidade FROM tb_pedidos WHERE id_carrinho = $id_carrinho AND id_produto = $id_produto");
if ($pedidoResult->num_rows === 0) {
    echo "Produto não encontrado no carrinho.";
    $conn->close();
    exit();
}

$pedido = $pedidoResult->fetch_assoc();
if ($quantidade <= 0) {
    $sql = "DELETE FROM tb_pedidos WHERE id_item = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pedido['id_item']);
} else {
    $sql = "UPDATE tb_pedidos SET quantidade = ? WHERE id_item = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $quantidade, $pedido['id_item']);
}

if ($stmt->execute()) {
    echo "<script>location.href='../carrinho.php';</script>";
} else {
    echo "Erro: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
