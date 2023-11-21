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
        $mostrarClientes = "SELECT * FROM cadastroclientes";
        $resultado = $conexao->query($mostrarClientes);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Agência Bancária</title>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column; /* Alterado para coluna */
        align-items: center;
        background: linear-gradient(to bottom, #f4f4f4, #ccc);
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media screen and (max-width: 600px) {
        .container {
            width: 90%;
        }
    }

    .navbar {
        margin-top: 0.1%;
        width: 97%;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: lightblue;
    }

    .navtxt {
        display: flex;
    }

    .botaoSair {
        background-color: blue;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .container {
        width: 50%;
        max-width: 100%;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        display: flex;
        flex-direction: column; /* Alterado para coluna */
        justify-content: space-between; /* Alterado para space-between */
        align-items: center; /* Alterado para centro */
        background-color: lightblue;
        margin-top: 20px; /* Ajustado para espaço entre a navbar e o container */
    }

    .subtitle {
        margin-top: 20px; /* Ajustado para espaço entre o título e o container */
    }

    .divCadastro {
        width: 13%;
        border: 1px solid #ddd;
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: blue;
        padding: 15px;
    }
</style>
<body>
    <div class="navbar">
        <h1 class="navtxt">Bem-vindo</h1>
        <form action="sair.php" method="post">
            <input type="submit" class="botaoSair" value="SAIR DA CONTA">
        </form>
    </div>
    <h2 class="subtitle">CLIENTES CADASTRADOS:</h2>
    <div class="divCadastro">
    <a href="clientesCadastrar.php" style="text-decoration: none; color: white;">CADASTRAR CLIENTES</a>
    </div>
    <div class="container">
        <table>
            <tr><th>Número</th><th>Nome</th><th>Ações</th></tr>

            <?php
            while ($row = mysqli_fetch_array($resultado)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['nomecompleto'] . '</td>';
                echo '<td>
                        <form method="post" action="cliente.php">
                            <input type="hidden" value="'. $row['id'] .'" name="id">
                            <input type="submit" value="Visualizar">
                        </form>
                    </td>';
                echo '<td>
                        <form method="post" action="clienteDeletar.php">
                            <input type="hidden" value="'. $row['id'] . '" name="id">
                            <input type="submit" value="Deletar Cliente">
                        </form>
                    </td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</body>
</html>
