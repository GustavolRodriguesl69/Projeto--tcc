<?php
session_start();
if (empty($_SESSION)) {
    echo "Sessão inválida, redirecionando para login.php...";
    echo "<script>location.href='login.php';</script>";
    exit();
}

include './PHP/conexao.php';
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$sql = "SELECT * FROM tb_produtos WHERE id_produto='$id'";
$result = $conn->query($sql);
$produto = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Drip Culture - <?php echo $produto['nome']; ?></title>
  <link href="CSS/fontes.css" rel="stylesheet" type="text/css" />
  <link href="CSS/style.css" rel="stylesheet" type="text/css" />
  <link href="CSS/holo.css" rel="stylesheet" type="text/css" />
</head>
<body>
  <header class="header">
    <div class="header_top">
      <div>
        <img class="ht_img" src="Icones/user.png">
        <?php
        echo '<span>' . $_SESSION["nome"] . '</span>';
        ?>
      </div>
      <div onClick="window.location.href='PHP/logout.php'">
        <img class="ht_img" src="Icones/sair.png">
        <span>Sair</span>
      </div>
    </div>
    <div class="header_bottom">
      <div class="hb_logo_container">
        <span class="hb_logo"> Drip <br> Culture </span>
      </div>
      <div class="hb_button_container">
        <div>
          <div class="hb_button" onclick="window.location.href='index.php?categoria=camisetas'">
            <span> Camisetas </span>
          </div>
          <div class="hb_button" onclick="window.location.href='index.php?categoria=calcas'">
            <span> Calças </span>
          </div>
          <div class="hb_button" onclick="window.location.href='index.php?categoria=bermudas'">
            <span> Bermudas </span>
          </div>
        </div>
        <div></div>
        <div class="hb_icon_container">
          <img class="hb_icon" src="Icones/favoritos.png">
          <img class="hb_icon" src="Icones/carrinho.png" onClick="window.location.href='./carrinho.php'">
          <?php 
          if (isset($_SESSION["tipo"]) && $_SESSION["tipo"] == "admin") {
            echo '<img class="hb_icon" src="Icones/menu.png" onclick="window.location.href=\'./Paginas/admin.php\'">';
          }
          ?>
        </div>
      </div>
    </div>
  </header>
  <main class="main">
    <?php 
    if($produto) {
        echo "<div class='page_produto_container'>
                <img class='page_produto_imagem' src='{$produto['imagem']}'>
                <div class='page_produto_info'>
                  <span class='page_produto_nome'>{$produto['nome']}</span>
                  <span class='page_produto_desc'>{$produto['descricao']}</span>
                  <span class='page_produto_valor'>R$ " . number_format($produto['preco'], 2, ',', '.') . "</span>
                  <form method='post' action='./PHP/adicionar_carrinho.php'>
                    <input type='hidden' name='id_produto' value='{$produto['id_produto']}'>
                    <button type='submit'>Adicionar ao Carrinho</button>
                  </form>
                </div>
              </div>";
    } else {
        echo '<span>Produto não encontrado.</span>';
    }
    ?>
  </main>
  <footer class="footer">
    <div class="footer_top"></div>
    <div class="footer_bottom">
      <span>Copyright drip culture - 2024. Todos os direitos reservados.</span>
    </div>
  </footer>
  <script type="text/javascript" src="Javascript/holo.js"></script>
</body>
</html>
