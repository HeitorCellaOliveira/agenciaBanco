
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente | Agência Bancária</title>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column; /* Alterado para coluna */
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

    h1 {
        color: white;
    }

    .navtxt {
        display: flex;
    }

    .container {
        width: 50%;
        max-width: 100%;
        border-radius: 8px;
        padding: 20px;
        display: flex;
        flex-direction: column; /* Alterado para coluna */
        background-color: #8B4513;
        margin-top: 50px; /* Ajustado para espaço entre a navbar e o container */
    }

    .subtitle {
        margin-top: 20px;
    }

    .voltar {
        text-decoration: none;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .botao {
        background-color: #FFE4C4;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .botaoAdd {
        background-color: green;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
    }

    .with-border {
            border: 2px solid black;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px; /* Adicione um espaço entre os itens */
        }

        /* Aplique a classe 'with-border' aos elementos dentro do container */
    .container .with-border {
        background-color: #FFE4C4; /* Ajuste a cor de fundo para manter a aparência original */
    }

        /* Ajuste as margens para os títulos e conteúdos */
    .title, .conteudo {
        margin: 5px 0;
    }

    .tbox {
        width: 85%;
        padding: 3px;
        background-color: transparent;
        border: none;
    }
</style>
<body>
    <div class="navbar">
        <h1 class="navtxt">Visualização de Cliente</h1>
        <form action="sair.php" method="post">
            <input type="submit" class="botao" value="SAIR">
            <br><br><a href="home.php" class="voltar">Voltar</a> 
        </form>
    </div>

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

        $consultaNomeGerente = "SELECT idGerente FROM logingerente WHERE idGerente = '".$_SESSION['idGerente']."';";
        $resultadoNomeGerente = $conexao->query($consultaNomeGerente);

        if ($resultadoNomeGerente->num_rows > 0) {
            $rowGerente = $resultadoNomeGerente->fetch_assoc();
            $nomeGerente = $rowGerente['idGerente'];
        }

        $mostrarClientes = "SELECT * FROM cadastroclientes WHERE idGerente = '". $nomeGerente ."';";
        $resultado = $conexao->query($mostrarClientes);  

        if ($resultado->num_rows > 0) {
            if ($row = $resultado->fetch_assoc()) {
                echo "<div class='container'>";

                echo "<h1>Informações Pessoais</h1>";
            
                echo "<div class='with-border'><b><label class='title'>Nome Completo: </label></b>";
                echo "<label class='conteudo'>" . $row['nome'] . "</label></div>";
            
                echo "<div class='with-border'><b><label class='title'>CPF: </label></b>";
                echo "<label class='conteudo'>" . $row['cpf'] . "</label></div>";
            
                echo "<div class='with-border'><b><label class='title'>Telefone: </label></b>";
                echo "<label class='conteudo'>" . $row['telefone'] . "</label></div>";
            
                echo "<div class='with-border'><b><label class='title'>Email: </label></b>";
                echo "<label class='conteudo'>" . $row['email'] . "</label></div>";
            
                echo "<div class='with-border'><b><label class='title'>Gerente: </label></b>";
                echo "<label class='conteudo'>" . $row['idGerente'] . "</label></div>";

                echo "<div class='with-border'><b><label class='title'>Cartão de Crédito: </label></b>";
                echo "<label class='conteudo'>" . $row['idCartao'] . "</label></div>";

                echo "</div>";
            }
        } else {
            echo "Nenhum Cliente Encontrado";
        }
    }
    ?>

    <div class="container">
        <h1 class="navtxt">Adicionar Cartão de Crédito</h1>
        <form action='addCartao.php' method="post">
            <div class="with-border"><label class="title">Número do Cartão: </label>
            <input type='text' class='tbox' name="idCartao" id='idCartao' maxlength="19" placeholder='Digite o número do cartão'>
    </div>
    
    <input type="submit" class="botaoAdd" value="Adicionar Cartão">
    </form>

    <script>
    // Selecione o input do número do cartão
    const inputCartao = document.getElementById('idCartao');

    // Adicione um ouvinte de evento para detectar quando algo é digitado no input
    inputCartao.addEventListener('input', function(event) {
        // Obtém o valor atual do input
        let cardNumber = event.target.value;

        // Remove todos os espaços em branco (caso o usuário tenha inserido alguns)
        cardNumber = cardNumber.replace(/\s/g, '');

        // Formata o número do cartão a cada 4 dígitos adicionando um espaço
        cardNumber = cardNumber.replace(/(\d{4})/g, '$1 ').trim();

        // Define o valor formatado de volta ao input
        event.target.value = cardNumber;
    });
</script>

    </form>

</body>
</html>
