<?php
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "agenciabancaria";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM logingerente WHERE email = '$email' AND senha = '$senha'";
    $resultado = $conn->query($sql);
    if ($resultado === false) {
        die("Erro na consulta: " . $conn->error);
    }

    if ($resultado->num_rows > 0) {
        $row = $resultado -> fetch_array(); 
        session_start();
        $_SESSION['idGerente'] = $row['idGerente'];
        header("Location: home.php");

        exit();
    } else {
        echo "<script>
                alert('Login falhou. Verifique suas credenciais.');
                window.location.href = 'index.html';
              </script>";
    }
    
}
$conn->close();
?>
