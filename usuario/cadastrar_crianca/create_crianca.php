<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Passageiro</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0; /* Cor de fundo suave */
            min-height: 100vh; /* Garante que o body ocupe toda a altura da tela */
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .form-container {
            background-color: #ff4d4d; /* Vermelho suave */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
            max-width: 400px; /* Garante que o formulário não ultrapasse 400px de largura */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra */
        }

        .form-container h1 {
            color: white;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-container label {
            align-self: flex-start;
            margin-bottom: 5px;
            color: white;
        }

        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
        }

        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-container input[type="submit"]:hover {
            background-color: #555;
        }

        .form-container a {
            display: block;
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            width: 100%;
            text-align: center;
        }

        .form-container a:hover {
            background-color: #555;
        }

        .erro {
            color: #ffcc00; /* Cor amarela suave, que contrasta bem com o vermelho */
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php
require '../../connection.php';

// Verificação e processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $idade = $_POST['idade'];
    $pai = $_POST['pai'];
    $cpf_pai = $_POST['cpf_pai'];
    $mae = $_POST['mae'];
    $cpf_mae = $_POST['cpf_mae'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $rua = $_POST['rua'];
    $numero_casa = $_POST['numero_casa'];
    $bairro = $_POST['bairro'];
    $estado = $_POST['estado'];
    $turno_aula = $_POST['turno_aula'];
    $horario_entrada = $_POST['horario_entrada'];
    $horario_saida = $_POST['horario_saida'];
    $escola = $_POST['escola'];
    $numero_van = $_POST['numero_van'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Preparar o documento para inserção
    $bulk = new MongoDB\Driver\BulkWrite;
    $document = [
        'nome'            => $nome,
        'cpf'             => $cpf,
        'idade'           => $idade,
        'pai'             => $pai,
        'cpf_pai'         => $cpf_pai,
        'mae'             => $mae,
        'cpf_mae'         => $cpf_mae,
        'cep'             => $cep,
        'cidade'          => $cidade,
        'rua'             => $rua,
        'numero_casa'     => $numero_casa,
        'bairro'          => $bairro,
        'estado'          => $estado,
        'turno_aula'      => $turno_aula,
        'horario_entrada' => $horario_entrada,
        'horario_saida'   => $horario_saida,
        'escola'          => $escola,
        'numero_van'      => $numero_van,
        'senha'           => $senha,
        'email'           => $email
    ];
    $bulk->insert($document);

    // Inserir no MongoDB
    $manager->executeBulkWrite('empresa.cadastro_crianca', $bulk);

    echo "<p class='erro'>Responsáveis e filho cadastrado com sucesso!</p>";
}
?>

<form class="form-container" action="create_crianca.php" method="post">
    <h1>Cadastrar Passageiro</h1>
    <label for="nome">Nome do filho(a):</label>
    <input type="text" name="nome" required><br>
    
    <label for="cpf">CPF do filho(a):</label>
    <input type="text" name="cpf" required><br>
    
    <label for="idade">Idade do filho(a):</label>
    <input type="text" name="idade" required><br>
    
    <label for="pai">Nome do pai:</label>
    <input type="text" name="pai" required><br>
    
    <label for="cpf_pai">CPF do pai:</label>
    <input type="text" name="cpf_pai" required><br>
    
    <label for="mae">Nome da mãe:</label>
    <input type="text" name="mae" required><br>
    
    <label for="cpf_mae">CPF da mãe:</label>
    <input type="text" name="cpf_mae" required><br>
    
    <label for="cep">Cep:</label>
    <input type="text" name="cep" id="cep" required><br>
    
    <label for="cidade">Cidade:</label>
    <input type="text" name="cidade" id="cidade" required><br>
    
    <label for="rua">Rua:</label>
    <input type="text" name="rua" id="rua" required><br>
    
    <label for="numero_casa">Número da casa:</label>
    <input type="number" name="numero_casa"><br>
    
    <label for="bairro">Bairro:</label>
    <input type="text" name="bairro" id="bairro" required><br>
    
    <label for="estado">Estado:</label>
    <input type="text" name="estado" id="estado" required><br>
    
    <label for="escola">Escola:</label>
    <input type="text" name="escola" required><br>
    
    <label for="turno_aula">Turno:</label>
    <input type="text" name="turno_aula" required><br>
    
    <label for="horario_entrada">Horário de Entrada:</label>
    <input type="text" name="horario_entrada" required><br>
    
    <label for="horario_saida">Horário de Saída:</label>
    <input type="text" name="horario_saida" required><br>
    
    <label for="numero_van">Número da Van:</label>
    <input type="text" name="numero_van" required><br>
    
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>
    
    <label for="senha">Senha:</label>
    <input type="password" name="senha" required><br>
    
    <input type="submit" value="Cadastrar Criança">
    
    <a href="../index.php">Voltar</a>
</form>

<script>
$('#cep').on('blur', function() {
    var cep = $(this).val().replace(/\D/g, '');
    if (cep != '') {
        var validacep = /^[0-9]{8}$/;
        if(validacep.test(cep)) {
            $.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function(data) {
                if (!data.erro) {
                    $('#rua').val(data.logradouro);
                    $('#bairro').val(data.bairro);
                    $('#cidade').val(data.localidade);
                    $('#estado').val(data.uf);
                } else {
                    alert("CEP não encontrado.");
                }
            });
        } else {
            alert("Formato de CEP inválido.");
        }
    }
});
</script>

</body>
</html>
