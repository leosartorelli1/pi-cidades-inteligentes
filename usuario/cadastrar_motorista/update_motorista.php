<?php
require '../../connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
  
    $filter = ['_id' => new MongoDB\BSON\ObjectId($id)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $manager->executeQuery('empresa.cadastro_motorista', $query);

    $document = current($cursor->toArray());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_motorista = $_POST['nome_motorista'];
    $cpf_motorista = $_POST['cpf_motorista'];
    $email = $_POST['email'];
    $numero_van = $_POST['numero_van'];

    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => [
            'nome_motorista' => $nome_motorista,
            'cpf_motorista' => $cpf_motorista,
            'email' => $email,
            'numero_van' => $numero_van
        ]]
    );

    $manager->executeBulkWrite('empresa.cadastro_motorista', $bulk);

    header('Location: listar_motorista.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Motorista</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body class="d-flex flex-column" style="height: 100vh;">
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
                <a class="nav-link active" href="../cadastrar_motorista/listar_motorista.php">Lista de Motoristas</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container my-4">
<h2>Edite os Dados do Motorista</h2>

<form method="POST" class="form-row">

        <div class="form-group col-md-4">
        Nome: <input type="text" class="form-control" name="nome_motorista" value="<?= $document->nome_motorista ?>"><br>
        </div>


        <div class="form-group col-md-4">
        CPF: <input type="text" class="form-control" name="cpf_motorista" value="<?= $document->cpf_motorista ?>"><br>
        </div>

        <div class="form-group col-md-4">
        Email: <input type="text" class="form-control" name="email" value="<?= $document->email ?>"><br>
        </div>


        <!--<div class="form-group col-md-2">
        Número da Van: <input type="text" class="form-control" name="numero_van" value="<?= $document->numero_van ?>"><br>
        </div>-->

        <div class="form-group col-md-9">
</div>

        <div class="form-group col-md-4">
        <input type="submit" value="Salvar Alteração" class="btn btn-success">
        <a href="listar_motorista.php" class="btn btn-secondary">Cancelar</a>
        </div>
</form>
</div>
<footer class="bg-dark text-white text-center py-3 mt-auto">
        © 2024 Gerenciamento de Vans. Todos os direitos reservados.
    </footer>
</body>
</html>


