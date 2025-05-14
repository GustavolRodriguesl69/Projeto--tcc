<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>replit</title>
  <link href="CSS/fontes.css" rel="stylesheet" type="text/css" />
  <link href="CSS/style.css" rel="stylesheet" type="text/css" />
  <link href="CSS/holo.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <header class="header">
    <div class="header_top">
      <div>
        <img class="ht_img" src="Icones/user.png">
        <span>Cadastre-se</span>
      </div>
      <div> 
        <span>Login</span>
      </div>
    </div>
    <div class="header_bottom">
      <div class="hb_logo_container">
        <span class="hb_logo"> Drip <br> Culture </span>
      </div>
      <div class="hb_button_container">
        <div>
          <div class="hb_button selected">
            <span> Início </span>
          </div>
          <div class="hb_button">
            <span> Produtos </span>
          </div>
          <div class="hb_button">
            <span> Contato </span>
          </div>
        </div>
        <div></div>
        <div class="hb_icon_container">
          <img class="hb_icon" src="Icones/favoritos.png">
          <img class="hb_icon" src="Icones/carrinho.png">
        </div>
      </div>
    </div>
  </header>
  <main class="main">
    <div class="display_container">
      <!--span>Produtos em destaque</span-->
      <div style="display: flex; gap: 20px;">
        <div class="produto_container">
          <img src="Imagens/001_frente.jpg">
          <span class="produto_nome">Camiseta Stranger Square Letters (Vinho)</span>
          <span>
            <span class="produto_desconto">R$ 100,00</span>
            <span class="produto_valor">R$ 85,00</span>
          </span>
          <span class="produto_parcela">12x de R$8,22</span>
        </div>
        <div class="produto_container">
          <img src="Imagens/002_frente.jpg">
          <span class="produto_nome">Camiseta Stranger Garfield Stoned (Orquidea)</span>
          <span>
            <span class="produto_desconto">R$ 100,00</span>
            <span class="produto_valor">R$ 85,00</span>
          </span>
          <span class="produto_parcela">12x de R$8,22</span>
        </div>
        <div class="produto_container">
          <img src="Imagens/003_frente.jpg">
          <span class="produto_nome">Camiseta Stranger Happy Tree Friends (Laranja)</span>
          <span>
            <span class="produto_desconto">R$ 100,00</span>
            <span class="produto_valor">R$ 85,00</span>
          </span>
          <span class="produto_parcela">12x de R$8,22</span>
        </div>
      </div>
      <div class="seall_button">Ver todos os produtos</div>
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
</body>

</html>