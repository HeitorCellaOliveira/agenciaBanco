<?php
    $hostname = '127.0.0.1';
    $user = 'root';
    $password = '';
    $database = 'agenciabancaria';
    
    $conexao = new mysqli($hostname, $user, $password, $database);
    if ($conexao->connect_errno) {
        echo 'Falha na conexão: ' . $conexao -> connect_error;
        exit();
    } else {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
            $idCliente = $_POST['id'];
            
            // Comando SQL para deletar o cliente com base no ID
            $deleteCliente = "DELETE FROM cadastroclientes WHERE id = $idCliente";
            
            if ($conexao->query($deleteCliente) === TRUE) {
                echo "Cliente deletado com sucesso!";
                header('Location: home.php', true, 301);
            } else {
                echo "Erro ao deletar cliente: " . $conexao->error;
            }
        } else {
            echo "ID do cliente não foi fornecido ou o método de requisição não é POST.";
        }
    }
?>
