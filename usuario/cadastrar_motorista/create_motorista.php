<?php
require '../../connection.php';

<<<<<<< HEAD
=======
<<<<<<< HEAD
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
=======
>>>>>>> e0c1cacc24072453bfd7a7f7223996038cffcc97

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar dados do formulário
    $nome_motorista = $_POST['nome_motorista'];
    $cpf_motorista= $_POST['cpf_motorista'];
    $email= $_POST['email'];
    $senha= $_POST['senha'];
    $numero_van= $_POST['numero_van'];


    // Preparar o documento para inserção
    $bulk = new MongoDB\Driver\BulkWrite;
    $document = ['nome_motorista' => $nome_motorista, 'cpf_motorista' => $cpf_motorista, 'email' => $email,'senha' => $senha, 'numero_van' => $numero_van];
<<<<<<< HEAD
=======
>>>>>>> 7896834 (Front-End)
>>>>>>> e0c1cacc24072453bfd7a7f7223996038cffcc97
    $bulk->insert($document);

    // Inserir no MongoDB
    $manager->executeBulkWrite('empresa.cadastro_motorista', $bulk);

<<<<<<< HEAD
=======
<<<<<<< HEAD
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
=======
>>>>>>> e0c1cacc24072453bfd7a7f7223996038cffcc97
    header('Location: listar_motorista.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Motoristas</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body  class="d-flex flex-column" style="height: 100vh;">
<header class="d-flex justify-content-between align-items-center">
        <div class="header-cont d-flex align-items-center">
        <img src="../assets/logo3.jpg" alt="logo van" class="logo-van d-inline ">
        <h1 class="text-white display-4 d-inline">Vans-Control</h1>
        </div>
        <div><a class="nav-item nav-link btn btn-light mr-4 " href="../logout.php" >Sair</a></div>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNavAltMarkup">
        <ul class="nav nav-pills"> 
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Vans</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../cadastrar_crianca/listar_criancas.php">Lista de Passageiros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="listar_motorista.php">Lista de Motoristas</a>
            </li>
        </ul>
    </div>
</nav>

    <div class="container my-4">
        <h2>Cadastre um Novo Motorista</h2>
<form action="create_motorista.php" method="post" class="form-row">

        <div class="form-group col-md-5">
        Nome do Motorista: <input type="text" class="form-control" name="nome_motorista" required><br>
        </div>

        <div class="form-group col-md-4">
        CPF: <input type="text" class="form-control" name="cpf_motorista" required><br>
        </div>

        <div class="form-group col-md-5">
        Email: <input type="email" class="form-control" name="email" required><br>
        </div>

        <div class="form-group col-md-4">
        Senha: <input type="password" class="form-control" name="senha" required><br>
        </div>

        <!--<div class="form-group col-md-4">
        Número da Van: <input type="text" class="form-control" name="numero_van" required><br>
        </div>-->

        <div class="form-group col-md-4">
        <input type="submit" value="Cadastrar Motorista ao sistema" class="btn btn-success">
        <a href="listar_motorista.php"  class="btn btn-secondary">Voltar</a>
        </div>
</form>
</div>

<footer class="bg-dark text-white text-center py-3 mt-auto">
        © 2024 Gerenciamento de Vans. Todos os direitos reservados.
    </footer>
<<<<<<< HEAD
=======
>>>>>>> 7896834 (Front-End)
>>>>>>> e0c1cacc24072453bfd7a7f7223996038cffcc97
</body>
</html>
