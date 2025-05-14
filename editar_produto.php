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
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $ativo = isset($_POST['ativo']) ? 1 : 0;
    $imagem = $_POST['imagem'];

    $sql = "UPDATE tb_produtos SET nome='$nome', descricao='$descricao', preco='$preco', categoria='$categoria', ativo='$ativo', imagem='$imagem' WHERE id_produto=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Produto atualizado com sucesso";
    } else {
        echo "Erro ao atualizar produto: " . $conn->error;
    }

    $conn->close();
    echo "<script>location.href='produtos.php';</script>";
    return;
}

$id = $_GET['id'];
$sql = "SELECT * FROM tb_produtos WHERE id_produto=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $produto = $result->fetch_assoc();
} else {
    echo "Produto não encontrado.";
    return;
}
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Editar Produto</title>
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
        <h1>Editar Produto</h1>
        <form method="post" action="editar_produto.php">
            <input type="hidden" name="id" value="<?php echo $produto['id_produto']; ?>">
            <label>Nome:</label><br>
            <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" required><br>
            <label>Descrição:</label><br>
            <textarea name="descricao"><?php echo $produto['descricao']; ?></textarea><br>
            <label>Preço:</label><br>
            <input type="text" name="preco" value="<?php echo $produto['preco']; ?>" required><br>
            <label>Categoria:</label><br>
            <input type="text" name="categoria" value="<?php echo $produto['categoria']; ?>"><br>
            <label>Imagem:</label><br>
            <input type="text" name="imagem" value="<?php echo $produto['imagem']; ?>"><br>
            <label>Ativo:</label><br>
            <input type="checkbox" name="ativo" value="1" <?php if ($produto['ativo'] == 1) echo 'checked'; ?>><br><br>
            <input type="submit" value="Atualizar">
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