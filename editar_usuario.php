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
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $ativo = $_POST['ativo'];
    $tipo = $_POST['tipo'];

    $sql = "UPDATE tb_clientes SET nome='$nome', email='$email', endereco='$endereco', ativo='$ativo', tipo='$tipo' WHERE id_cliente=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro ao atualizar registro: " . $conn->error;
    }

    $conn->close();
    echo "<script>location.href='admin.php';</script>";
    return;
}

$id = $_GET['id'];
$sql = "SELECT * FROM tb_clientes WHERE id_cliente=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Usuário não encontrado.";
    return;
}
$conn->close();
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
  <h1>Editar Usuário</h1>
  <form method="post" action="editar_usuario.php">
    <input type="hidden" name="id" value="<?php echo $user['id_cliente']; ?>">
    <label>Nome:</label><br>
    <input type="text" name="nome" value="<?php echo $user['nome']; ?>"><br>
    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo $user['email']; ?>"><br>
    <label>Endereço:</label><br>
    <input type="text" name="endereco" value="<?php echo $user['endereco']; ?>"><br>
    <label>Ativo:</label><br>
    <input type="text" name="ativo" value="<?php echo $user['ativo']; ?>"><br>
    <label>Tipo:</label><br>
    <select name="tipo">
      <option value="cliente" <?php if($user['tipo'] == 'cliente') echo 'selected'; ?>>Cliente</option>
      <option value="admin" <?php if($user['tipo'] == 'admin') echo 'selected'; ?>>Admin</option>
    </select><br><br>
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