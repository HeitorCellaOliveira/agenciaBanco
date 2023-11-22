<?php
    $hostname = '127.0.0.1';
    $user = 'root';
    $password = '';
    $database = 'agenciabancaria';

    $conn = new mysqli ($hostname, $user, $password, $database);

    if ($conn -> connect_error) {
        echo "Falha na conexão: " . $conn -> connect_error;
        exit();

    } else {
        session_start();    

        $nome = $conn -> real_escape_string($_POST['nome']);
        $cpf = $conn -> real_escape_string($_POST['cpf']);
        $telefone = $conn -> real_escape_string($_POST['telefone']);
        $email = $conn -> real_escape_string($_POST['email']);
        $idGerente = $conn -> real_escape_string($_POST['idGerente']);
        
        $sql = 'INSERT INTO `agenciabancaria` . `cadastroclientes` (`nome`, `cpf`, `telefone`, `email`, `idGerente`)
        VALUES ("'. $nome . '", "'. $cpf . '", "'. $telefone . '", "'. $email . '", "'. $_SESSION['idGerente'] .'");';

        $resultado = $conn ->query($sql);
        $conn -> close();

        header('Location: home.php', true, 301);

    }
?>