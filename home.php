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
        session_start();
        $consultaNomeGerente = "SELECT idGerente FROM logingerente WHERE idGerente = '".$_SESSION['idGerente']."';";
        $resultadoNomeGerente = $conexao->query($consultaNomeGerente);

        if ($resultadoNomeGerente->num_rows > 0) {
            $rowGerente = $resultadoNomeGerente->fetch_assoc();
            $nomeGerente = $rowGerente['idGerente'];
        }

        $mostrarClientes = "SELECT * FROM cadastroclientes WHERE idGerente = '". $nomeGerente ."';";
        $resultado = $conexao->query($mostrarClientes);
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Agência Bancária</title>
    
    <script>
    function confirmarDelete() {
        return confirm("Tem certeza que deseja deletar este cliente?");
    }
    </script>
    
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        background: linear-gradient(to bottom, #FFE4C4, #8B7D6B);
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
        border-radius: 8px;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #8B4513;
    }

    .navtxt {
        display: flex;
    }

    .botao {
        background-color: #FFE4C4;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .botaoDeletar {
        background-color: #FFE4C4;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .botaoVizu {
        background-color: #FFE4C4;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .container {
        width: 50%;
        max-width: 100%;
        border-radius: 8px;
        padding: 20px;
        display: flex;
        flex-direction: column; /* Alterado para coluna */
        justify-content: space-between; /* Alterado para space-between */
        align-items: center; /* Alterado para centro */
        background-color: #8B4513;
        margin-top: 20px; /* Ajustado para espaço entre a navbar e o container */
    }

    .subtitle {
        margin-top: 20px;
    }

    .divCadastro {
        width: 13%;
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #DEB887;
        padding: 15px;
    }

    h1 {
        color: white;
    }
</style>
<body>
    <div class="navbar">
        <h1 class="navtxt">Bem-vindo, <?php echo $nomeGerente; ?></h1>
        <form action="sair.php" method="post">
            <b><input type="submit" class="botao" value="SAIR"></b>
        </form>
    </div>
    <h2 class="subtitle">Clientes Cadastrados:</h2>
    <div class="divCadastro">
    <a href="clientesCadastrar.html" style="text-decoration: none; color: black;">Cadastrar Clientes</a>
    </div>
    <div class="container">
    <table>
    <tr>
        <th style="padding: 10px; text-align: left; color: white; font-size: 25px;">Número</th>
        <th style="padding: 10px; text-align: left; color: white; font-size: 25px;">Nome</th>
        <th style="padding: 10px; text-align: left; color: white; font-size: 25px;">Ações</th>
    </tr>

    <?php
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<tr>';
        echo '<td style="padding: 10px; color: white; font-size: 25px;">' . $row['id'] . '</td>';
        echo '<td style="padding: 10px; color: white; font-size: 25px;">' . $row['nome'] . '</td>';
        echo '<td style="padding: 10px; color: white; font-size: 25px;">
                <form method="post" action="cliente.php">
                    <input type="hidden" value="'. $row['id'] .'" name="id">
                    <input type="submit" class="botaoVizu" value="Visualizar">
                </form>

                <script>
                    function mostrarDados() {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("resultado").innerHTML = this.responseText;
                            }
                        };
                        xmlhttp.open("GET", "cliente.php", true);
                        xmlhttp.send();
                    }
                </script>
            </td>';
        echo '<td>
                <form method="post" action="clienteDeletar.php" onsubmit="return confirmarDelete()">
                    <input type="hidden" value="'. $row['id'] . '" name="id">
                    <input type="submit" class="botaoDeletar" value="Deletar Cliente">
                </form>
            </td>';
        echo '</tr>';
    }
    ?>
</table>

    </div>
</body>
</html>
