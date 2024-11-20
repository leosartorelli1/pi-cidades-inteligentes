<?php
require '../../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar dados do formulário
    $nome_motorista = $_POST['nome_motorista'];
    $cpf_motorista = $_POST['cpf_motorista'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $numero_van = $_POST['numero_van'];

    // Preparar o documento para inserção
    $bulk = new MongoDB\Driver\BulkWrite;
    $document = [
        'nome_motorista' => $nome_motorista,
        'cpf_motorista' => $cpf_motorista,
        'email' => $email,
        'senha' => $senha,
        'numero_van' => $numero_van
    ];
    $bulk->insert($document);

    // Inserir no MongoDB
    $manager->executeBulkWrite('empresa.cadastro_motorista', $bulk);

    echo "Motorista cadastrado com sucesso";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Motorista</title>
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
            height: 100vh;
            background-color: #f0f0f0; /* Cor de fundo suave */
        }

        .form-container {
            background-color: #ff4d4d; /* Vermelho suave */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 350px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra */
        }

        .form-container h1 {
            color: white;
            margin-bottom: 20px;
        }

        .form-container label {
            align-self: flex-start;
            margin-bottom: 5px;
            color: white;
        }

        .form-container input[type="text"],
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

        .form-container button {
            background-color: #f44336; /* Cor vermelha para o botão "Voltar" */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .form-container button a {
            color: white;
            text-decoration: none;
        }

        .form-container button:hover {
            background-color: #e53935;
        }

        .erro {
            color: #ffcc00; /* Cor amarela suave, que contrasta bem com o vermelho */
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Cadastrar Motorista</h1>
        <form action="create_motorista.php" method="post">
            <label for="nome_motorista">Nome do Motorista:</label>
            <input type="text" name="nome_motorista" required>

            <label for="cpf_motorista">CPF:</label>
            <input type="text" name="cpf_motorista" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" required>

            <label for="numero_van">Número da Van:</label>
            <input type="text" name="numero_van" required>

            <input type="submit" value="Cadastrar Motorista">
        </form>

        <button><a href="../index.php">Voltar</a></button>
    </div>
</body>
</html>
