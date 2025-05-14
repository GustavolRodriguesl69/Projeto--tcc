// PHP/cadastro.php
<?php
include 'conexao.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nome = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $endereco = $_POST['endereco'];
    $ativo = 1; 
    $tipo = 'admin';

    $stmt = $conn->prepare("INSERT INTO tb_clientes (nome, email, senha, endereco, ativo, tipo) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $nome, $email, $senha, $endereco, $ativo, $tipo);

    if ($stmt->execute()) {
        echo "Novo registro criado com sucesso";
        echo "<script>location.href='../login.php';</script>";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
