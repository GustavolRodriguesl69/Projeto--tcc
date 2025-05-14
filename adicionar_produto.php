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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $ativo = isset($_POST['ativo']) ? 1 : 0;
    $imagem = $_POST['imagem']; // Se o campo 'imagem' for uma URL ou caminho da imagem

    $sql = "INSERT INTO tb_produtos (nome, descricao, preco, categoria, ativo, imagem) VALUES ('$nome', '$descricao', '$preco', '$categoria', '$ativo', '$imagem')";

    if ($conn->query($sql) === TRUE) {
        echo "Produto adicionado com sucesso";
    } else {
        echo "Erro ao adicionar produto: " . $conn->error;
    }

    $conn->close();
    echo "<script>location.href='produtos.php';</script>";
    return;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Adicionar Produto</title>
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
                    <div class="hb_button" onclick="window.location.href='./produtos.php'">
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
        <h1>Adicionar Produto</h1>
        <form method="post" action="adicionar_produto.php">
            <label>Nome:</label><br>
            <input type="text" name="nome" required><br>
            <label>Descrição:</label><br>
            <textarea name="descricao"></textarea><br>
            <label>Preço:</label><br>
            <input type="text" name="preco" required><br>
            <label>Categoria:</label><br>
            <input type="text" name="categoria"><br>
            <label>Imagem:</label><br>
            <input type="text" name="imagem"><br>
            <label>Ativo:</label><br>
            <input type="checkbox" name="ativo" value="1" checked><br><br>
            <input type="submit" value="Adicionar">
        </form>
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