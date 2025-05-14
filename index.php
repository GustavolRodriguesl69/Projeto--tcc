<?php
session_start();
if (empty($_SESSION)) {
    echo "Sessão inválida, redirecionando para login.php...";
    echo "<script>location.href='login.php';</script>";
    exit();
}

include './PHP/conexao.php'; 
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'camisetas';
$sql = "SELECT * FROM tb_produtos WHERE categoria='$categoria'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Drip Culture</title>
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
        print '<span>' . $_SESSION["nome"] . '</span>';
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
          <div class="hb_button <?php if ($categoria == 'camisetas') echo 'selected'; ?>" onclick="window.location.href='?categoria=camisetas'">
            <span> Camisetas </span>
          </div>
          <div class="hb_button <?php if ($categoria == 'calcas') echo 'selected'; ?>" onclick="window.location.href='?categoria=calcas'">
            <span> Calças </span>
          </div>
          <div class="hb_button <?php if ($categoria == 'bermudas') echo 'selected'; ?>" onclick="window.location.href='?categoria=bermudas'">
            <span> Bermudas </span>
          </div>
          <div class="hb_button <?php if ($categoria == 'moletons') echo 'selected'; ?>" onclick="window.location.href='?categoria=moletons'">
            <span> Moletons </span>
          </div>
          <div class="hb_button <?php if ($categoria == 'tenis') echo 'selected'; ?>" onclick="window.location.href='?categoria=tenis'">
            <span> Tênis </span>
          </div>
        </div>
        <div></div>
        <div class="hb_icon_container">
          <img class="hb_icon" src="Icones/favoritos.png">
          <img class="hb_icon" src="Icones/carrinho.png" onClick="window.location.href='./carrinho.php'">
          <?php 
          if ($_SESSION["tipo"] && $_SESSION["tipo"] == "admin") {
            echo '<img class="hb_icon" src="Icones/menu.png" onclick="window.location.href=\'./Paginas/admin.php\'">';
          }
          ?>
        </div>
      </div>
    </div>
  </header>
  <main class="main">
    <div class="display_container">
      <div style="display: flex; gap: 20px;">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<a href="produto.php?id=' . $row['id_produto'] . '">';
                echo '<div class="produto_container">';
                echo '<div class="produto_imagem" style="background-image: url(' . $row['imagem'] . ')"></div>';
                echo '<span class="produto_nome">' . $row['nome'] . '</span>';
                echo '<span>';
                echo '<span class="produto_valor">R$ ' . $row['preco'] . '</span>';
                echo '</span>';
                echo '</div>';
                echo '</a>';
            }
        } else {
            echo '<span>Nenhum produto encontrado.</span>';
        }
        ?>
      </div>
    </div>
  </main>
  <footer class="footer">
    <div class="footer_top">
    </div>
    <div class="footer_bottom">
      <span>Copyright drip culture - 2024. Todos os direitos reservados.</span>
    </div>
  </footer>
  <script type="text/javascript" src="Javascript/holo.js"></script>
  <script>
  var addZoom = targetClass => {
    // Seleciona todas as divs com a classe targetClass
    let containers = document.querySelectorAll(`.${targetClass}`);

    containers.forEach(container => {
      let imgsrc = container.currentStyle || window.getComputedStyle(container, false);
      imgsrc = imgsrc.backgroundImage.slice(4, -1).replace(/"/g, "");

      let img = new Image();
      img.src = imgsrc;
      img.onload = () => {
        let ratio = img.naturalHeight / img.naturalWidth,
            percentage = ratio * 100 + "%";

        container.onmousemove = e => {
          let rect = e.target.getBoundingClientRect(),
              xPos = e.clientX - rect.left,
              yPos = e.clientY - rect.top,
              xPercent = xPos / (container.clientWidth / 100) + "%",
              yPercent = yPos / ((container.clientWidth * ratio) / 100) + "%";

          Object.assign(container.style, {
            backgroundPosition: xPercent + " " + yPercent,
            backgroundSize: img.naturalWidth + "px"
          });
        };

        container.onmouseleave = e => {
          Object.assign(container.style, {
            backgroundPosition: "center",
            backgroundSize: "cover"
          });
        };
      };
    });
  };

  window.onload = () => addZoom("produto_imagem");
</script>

</body>

</html>
