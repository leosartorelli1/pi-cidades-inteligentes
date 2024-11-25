<?php
require '../../connection.php';


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
    $bulk->insert($document);

    // Inserir no MongoDB
    $manager->executeBulkWrite('empresa.cadastro_motorista', $bulk);

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
</body>
</html>
