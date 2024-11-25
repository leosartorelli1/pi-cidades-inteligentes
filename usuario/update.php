<?php
require '../connection.php';

if (isset($_GET['id'])) {   
    $id = new MongoDB\BSON\ObjectId($_GET['id']);

    // Localizar o registro a ser editado
    $filter = ['_id' => $id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $manager->executeQuery('empresa.veiculos_cadastrados', $query);
    $veiculos = current($cursor->toArray());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = new MongoDB\BSON\ObjectId($_POST['id']);
    $numero_van = $_POST['numero_van'];
    $placa = $_POST['placa'];
    $motorista = $_POST['motorista'];
    $monitora = $_POST['monitora'];

    // Preparar a atualização
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update(
        ['_id' => $id],
        ['$set' => ['numero_van' => $numero_van, 'placa' => $placa, 'motorista' => $motorista, 'monitora' => $monitora]]
    );

    // Executar a atualização
    $manager->executeBulkWrite('empresa.veiculos_cadastrados', $bulk);

    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Vans</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body class="d-flex flex-column" style="height: 100vh;">
<header class="d-flex justify-content-between align-items-center">
        <div class="header-cont d-flex align-items-center">
        <img src="assets/logo3.jpg" alt="logo van" class="logo-van d-inline ">
        <h1 class="text-white display-4 d-inline">Vans-Control</h1>
        </div>
        <div><a class="nav-item nav-link btn btn-light mr-4 " href="logout.php" >Sair</a></div>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNavAltMarkup">
        <ul class="nav nav-pills"> 
            <li class="nav-item">
                <a class="nav-link active" href="index.php">Vans</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cadastrar_crianca/listar_criancas.php">Lista de Passageiros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cadastrar_motorista/listar_motorista.php">Lista de Motoristas</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container my-4">
    <h2>Atualize os Dados da Van</h2>
<form action="update.php" method="post" class="form-row">
    <input type="hidden" name="id" value="<?= $veiculos->_id ?>">


    <div class="form-group col-md-4">
    Número da van: <input type="text" class="form-control" name="numero_van" value="<?= $veiculos->numero_van ?>"><br>
    </div>

    <div class="form-group col-md-4">
    Placa: <input type="text" class="form-control" name="placa" value="<?= $veiculos->placa ?>"><br>
    </div>

    <div class="form-group col-md-4">
    Motorista: <input type="text" class="form-control" name="motorista" value="<?= $veiculos->motorista ?>"><br>
    </div>

    <div class="form-group col-md-4">
    Monitora: <input type="text" class="form-control" name="monitora" value="<?= $veiculos->monitora ?>"><br>
    </div>

    <div class="form-group col-md-8">
    </div>

    <div class="form-group col-md-4">
    <input type="submit" value="Atualizar Informações do Veiculo"  class="btn btn-success">
    <a href="index.php"  class="btn btn-secondary">Cancelar</a>
    </div>
    </form>
</div>
</body>
</html>
