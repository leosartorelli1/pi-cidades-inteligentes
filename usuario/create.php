<?php
require '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar dados do formulário
    $numero_van = $_POST['numero_van'];
    $placa = $_POST['placa'];
    $motorista = $_POST['motorista'];
    $monitora = $_POST['monitora'];

    // Preparar o documento para inserção
    $bulk = new MongoDB\Driver\BulkWrite;
    $document = ['numero_van' => $numero_van, 'placa' => $placa, 'motorista' => $motorista, 'monitora' => $monitora];
    $bulk->insert($document);

    // Inserir no MongoDB
    $manager->executeBulkWrite('empresa.veiculos_cadastrados', $bulk);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Veículo</title>
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

        .form-container input[type="text"] {
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

        .erro {
            color: #ffcc00; /* Cor amarela suave, que contrasta bem com o vermelho */
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form class="form-container" action="create.php" method="post">
        <h1>Cadastrar Veículo</h1>
        <label for="numero_van">Número da van:</label>
        <input type="text" name="numero_van" required>
        
        <label for="placa">Placa:</label>
        <input type="text" name="placa" required>
        
        <label for="motorista">Motorista:</label>
        <input type="text" name="motorista" required>
        
        <label for="monitora">Monitora:</label>
        <input type="text" name="monitora" required>
        
        <input type="submit" value="Cadastrar veículo">
        
        <?php
        if (isset($erro)) {
            echo "<p class='erro'>$erro</p>"; // Exibe a mensagem de erro abaixo do botão
        }
        ?>
    </form>
</body>
</html>
