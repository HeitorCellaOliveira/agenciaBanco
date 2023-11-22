<?php

$hostname = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'agenciabancaria';

$conexao = new mysqli($hostname, $user, $password, $database);

if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
} else {
    session_start();

    $idCartao = $_POST['idCartao'];

    // Verifica se o número do cartão é válido
    if (strlen($idCartao) == 16 || strlen($idCartao) == 19) {
        // Verifica se o número do cartão já está cadastrado
        $consultaNumeroCartao = "SELECT * FROM cadastroclientes WHERE idGerente = '" . $_SESSION['idGerente'] . "' AND idCartao = '" . $idCartao . "';";
        $resultadoNumeroCartao = $conexao->query($consultaNumeroCartao);

        if ($resultadoNumeroCartao->num_rows == 0) {
            // Atualiza o banco de dados com o novo número do cartão
            $updateCartao = "UPDATE cadastroclientes SET idCartao = '" . $idCartao . "' WHERE idGerente = '" . $_SESSION['idGerente'] . "';";
            $conexao->query($updateCartao);

            echo "Cartão de crédito atualizado com sucesso!";
        } else {
            echo "O número do cartão já está cadastrado para este cliente.";
        }
    } else {
        echo "O número do cartão deve ter 16 ou 19 dígitos.";
    }
}

$conexao->close();

?>
