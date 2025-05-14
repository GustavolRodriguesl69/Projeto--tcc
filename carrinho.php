<?php
session_start();
if (empty($_SESSION)) {
    echo "<script>location.href='./login.php';</script>";
    exit();
}

include './PHP/conexao.php';

$id_cliente = $_SESSION["id_cliente"];

$sql = "SELECT p.id_item, pr.id_produto, pr.nome, pr.preco, SUM(p.quantidade) as quantidade
        FROM tb_pedidos p 
        INNER JOIN tb_carrinhos c ON p.id_carrinho = c.id_carrinho 
        INNER JOIN tb_produtos pr ON p.id_produto = pr.id_produto 
        WHERE c.id_cliente = ?
        GROUP BY p.id_item, pr.id_produto, pr.nome, pr.preco";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();

$total_geral = 0;
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Carrinho de Compras</title>
  <link href="./CSS/fontes.css" rel="stylesheet" type="text/css" />
  <link href="./CSS/style.css" rel="stylesheet" type="text/css" />
  <link href="./CSS/admin.css" rel="stylesheet" type="text/css" />
  <link href="./CSS/holo.css" rel="stylesheet" type="text/css" />
  <script>
    function atualizarQuantidade(id_produto, quantidade, acao) {
      const novaQuantidade = acao === 'aumentar' ? quantidade + 1 : Math.max(quantidade - 1, 0);
      window.location.href = `./PHP/atualizar_quantidade.php?id_produto=${id_produto}&quantidade=${novaQuantidade}`;
    }
  </script>
</head>

<body>
  <header class="header">
    <div class="header_top">
      <div>
        <img class="ht_img" src="./Icones/user.png">
        <?php
        echo '<span>' . htmlspecialchars($_SESSION["nome"]) . '</span>';
        ?>
      </div>
      <div onClick="window.location.href='PHP/logout.php'">
        <img class="ht_img" src="./Icones/sair.png">
        <span>Sair</span>
      </div>
    </div>
    <div class="header_bottom">
      <div class="hb_logo_container">
        <span class="hb_logo"> Drip <br> Culture </span>
      </div>
      <div class="hb_button_container">
        <div>
          <div class="hb_button selected">
            <span> Carrinho </span>
          </div>
        </div>
        <div></div>
        <div class="hb_icon_container">
          <img class="hb_icon" src="./Icones/home.png" onclick="window.location.href='./index.php'">
        </div>
      </div>
    </div>
  </header>
  <main class="main">
    <div class="add-button">
      <button onclick="window.location.href='./finalizar_compra.php'">Finalizar Compra</button>
    </div>
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Preço</th>
          <th>Quantidade</th>
          <th>Total</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
      <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $total_item = $row['quantidade'] * $row['preco'];
        $total_geral += $total_item;
        echo "<tr>
                <td>" . htmlspecialchars($row['nome']) . "</td>
                <td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>
                <td>
                  <button onclick=\"atualizarQuantidade({$row['id_produto']}, {$row['quantidade']}, 'diminuir')\">-</button>
                  " . htmlspecialchars($row['quantidade']) . "
                  <button onclick=\"atualizarQuantidade({$row['id_produto']}, {$row['quantidade']}, 'aumentar')\">+</button>
                </td>
                <td>R$ " . number_format($total_item, 2, ',', '.') . "</td>
                <td>
                  <img class='hb_icon_r' src='./Icones/deletar.png' onclick='window.location.href=\"./PHP/deletar_carrinho.php?id_produto=" . htmlspecialchars($row['id_produto']) . "\"'>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>Nenhum item no carrinho.</td></tr>";
}
$stmt->close();
$conn->close();
?>

        <tr>
          <td colspan="3" style="text-align: right;"><strong>Total Geral:</strong></td>
          <td><strong>R$ <?php echo number_format($total_geral, 2, ',', '.'); ?></strong></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </main>
  <footer class="footer">
    <div class="footer_top">
    </div>
    <div class="footer_bottom">
      <span>Copyright drip culture - 2024. Todos os direitos reservados.</span>
    </div>
  </footer>
  <script type="text/javascript" src="Javascript/holo.js"></script>
</body>

</html>
