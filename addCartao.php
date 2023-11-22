<?php
$hostname = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'agenciabancaria';

$conexao = new mysqli($hostname, $user, $password, $database);

if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
} else {

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idCartao'])) {
        $numeroCartao = $_POST['idCartao'];

        $sql = "UPDATE cadastroclientes SET idCartao = '$numeroCartao'";

        $sql2 = "SELECT * FROM cadastroclientes WHERE idCartao = '$numeroCartao'";
        $consultaCartao = $conexao->query($sql2);

        if ($consultaCartao->num_rows > 0) {
            echo "Cartão já existe";
        } else {
            $registrarCartao2 = $conexao->query($sql);
            echo "Cartão cadastrado com sucesso!";
        }

        if ($conexao->query($sql) === TRUE) {
            echo "Número do cartão adicionado com sucesso!";
            header('Location: cliente.php', true, 301);
        } else {
            echo "Erro ao adicionar número do cartão: " . $conexao->error;
        }
    } else {
        echo "Número do cartão não foi recebido corretamente.";
    }
}
?>
