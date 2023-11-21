<?php
// Conectar ao banco de dados (substitua essas informações pelos seus próprios detalhes de conexão)
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "agenciabancaria";

$conn = new mysqli($host, $username, $password, $database);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Consulta SQL para verificar a existência da conta
    $sql = "SELECT * FROM logingerente WHERE email = '$email' AND senha = '$senha'";
    $resultado = $conn->query($sql);

    // Verificar se houve erro na execução da consulta
    if ($resultado === false) {
        die("Erro na consulta: " . $conn->error);
    }

    // Verificar se há resultados na consulta
    if ($resultado->num_rows > 0) {
        // Conta encontrada, login bem-sucedido
        echo "Login bem-sucedido! Redirecionando...";
        
        // Redirecionar para outra página
        header("Location: home.php");
        exit(); // Certifique-se de encerrar o script após o redirecionamento
    } else {
        // Conta não encontrada, login falhou
        echo "Login falhou. Verifique suas credenciais.";
        echo "<br><br><a href='index.html   ' style='color: black; text-decoration: none;'>Voltar</a>";
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
