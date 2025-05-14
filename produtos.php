<?php
session_start();
if (empty($_SESSION)) {
    echo "<script>location.href='login.php';</script>";
}
if ($_SESSION["tipo"] && $_SESSION["tipo"] != "admin") {
    echo "Não autorizado.";
    return;
}

include '../PHP/conexao.php';

$sql = "SELECT id_produto, nome, descricao, preco, categoria, ativo FROM tb_produtos";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>replit</title>
  <link href="../CSS/fontes.css" rel="stylesheet" type="text/css" />
  <link href="../CSS/style.css" rel="stylesheet" type="text/css" />
  <link href="../CSS/admin.css" rel="stylesheet" type="text/css" />
  <link href="../CSS/holo.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <header class="header">
    <div class="header_top">
      <div>
        <img class="ht_img" src="../Icones/user.png">
        <?php
        print '<span>' . $_SESSION["nome"] . '</span>';
        ?>
      </div>
      <div onClick="window.location.href='login.php'">
        <img class="ht_img" src="../Icones/sair.png">
        <span>Sair</span>
      </div>
    </div>
    <div class="header_bottom">
      <div class="hb_logo_container">
        <span class="hb_logo"> Drip <br> Culture </span>
      </div>
      <div class="hb_button_container">
        <div>
          <div class="hb_button" onclick="window.location.href='./admin.php'">
            <span> Usuários </span>
          </div>
          <div class="hb_button selected">
            <span> Produtos </span>
          </div>
        </div>
        <div></div>
        <div class="hb_icon_container">
          <img class="hb_icon" src="../Icones/home.png" onclick="window.location.href='../index.php'">
        </div>
      </div>
    </div>
  </header>
  <main class="main">
    <div class="add-button">
      <button onclick="window.location.href='./adicionar_produto.php'">Adicionar Produto</button>
    </div>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Preço</th>
          <th>Categoria</th>
          <th>Ativo</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>{$row['id_produto']}</td>
                      <td>{$row['nome']}</td>
                      <td>{$row['descricao']}</td>
                      <td>{$row['preco']}</td>
                      <td>{$row['categoria']}</td>
                      <td>{$row['ativo']}</td>
                      <td>
                        <img class='hb_icon_r' src='../Icones/editar.png' onclick='window.location.href=\"./editar_produto.php?id={$row['id_produto']}\"'>
                        <img class='hb_icon_r' src='../Icones/deletar.png' onclick='window.location.href=\"./deletar_produto.php?id={$row['id_produto']}\"'>
                      </td>
                    </tr>";
          } 
        } else {
          echo "<tr><td colspan='7'>Nenhum produto encontrado.</td></tr>";
        }
        $conn->close();
        ?>
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
