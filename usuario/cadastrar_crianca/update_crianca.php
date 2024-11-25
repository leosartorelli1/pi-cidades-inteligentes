<?php
require '../../connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
  
    $filter = ['_id' => new MongoDB\BSON\ObjectId($id)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $manager->executeQuery('empresa.cadastro_crianca', $query);

    $document = current($cursor->toArray());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => [
            'nome' => $nome,
            'cpf' => $cpf,
            'idade' => $idade,
            'pai' => $pai,
            'cpf_pai' => $cpf_pai,
            'mae' => $mae,
            'cpf_mae' => $cpf_mae,
            'endereco' => $endereco,
            'cep' => $cep,
            'cidade' => $cidade,
            'rua' => $rua,
            'numero_casa' => $numero_casa,
            'bairro' => $bairro,
            'estado'=> $estado,
            'turno_aula' => $turno_aula,
            'horario_entrada' => $horario_entrada,
            'horario_saida' => $horario_saida,
            'escola' => $escola,
            'numero_van' => $numero_van
        ]]
    );

    $manager->executeBulkWrite('empresa.cadastro_crianca', $bulk);

    header('Location: listar_criancas.php');
}

?>
<<<<<<< HEAD
=======
<<<<<<< HEAD

<h1>Editar Passageiro</h1>
<form method="POST">
    Nome: <input type="text" name="nome" value="<?= $document->nome ?>"><br>
    CPF: <input type="text" name="cpf" value="<?= $document->cpf ?>"><br>
    Idade: <input type="text" name="idade" value="<?= $document->idade ?>"><br>
    Nome do Pai: <input type="text" name="pai" value="<?= $document->pai ?>"><br>
    CPF do Pai: <input type="text" name="cpf_pai" value="<?= $document->cpf_pai ?>"><br>
    Nome da Mãe: <input type="text" name="mae" value="<?= $document->mae ?>"><br>
    CPF da Mãe: <input type="text" name="cpf_mae" value="<?= $document->cpf_mae ?>"><br>
    Cep: <input type="text" name="cep" value="<?= $document->cep ?>"><br>
    Cidade: <input type="text" name="cidade" value="<?= $document->cidade ?>"><br>
    Rua: <input type="text" name="rua" value="<?= $document->rua ?>"><br>
    Número da casa: <input type="text" name="numero_casa" value="<?= $document->numero_casa ?>"><br>
    Bairro: <input type="text" name="bairro" value="<?= $document->bairro ?>"><br>
    Estado: <input type="text" name="estado" value="<?= $document->estado ?>"><br>
     Turno: <input type="text" name="turno_aula" value="<?= $document->turno_aula ?>"><br>
    Horário de Entrada: <input type="text" name="horario_entrada" value="<?= $document->horario_entrada ?>"><br>
    Horário de Saída: <input type="text" name="horario_saida" value="<?= $document->horario_saida ?>"><br>
    Escola: <input type="text" name="escola" value="<?= $document->escola ?>"><br>
    Número da Van: <input type="text" name="numero_van" value="<?= $document->numero_van ?>"><br>
    <input type="submit" value="Salvar">
</form>
=======
>>>>>>> e0c1cacc24072453bfd7a7f7223996038cffcc97
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Passageiro</title>
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
                <a class="nav-link active" href="listar_criancas.php">Lista de Passageiros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../cadastrar_motorista/listar_motorista.php">Lista de Motoristas</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container my-4">
<h2>Edite os Dados do Passageiro</h2>

<form method="POST" class="form-row">

        <div class="form-group col-md-4">
        Nome: <input type="text" class="form-control" name="nome" value="<?= $document->nome ?>"><br>
        </div>


        <div class="form-group col-md-4">
        CPF: <input type="text" class="form-control" name="cpf" value="<?= $document->cpf ?>"><br>
        </div>


        <div class="form-group col-md-2">
        Idade: <input type="text" class="form-control" name="idade" value="<?= $document->idade ?>"><br>
        </div>


        <div class="form-group col-md-5">
        Nome do Pai: <input type="text" class="form-control" name="pai" value="<?= $document->pai ?>"><br>
        </div>


        <div class="form-group col-md-4">
        CPF do Pai: <input type="text" class="form-control" name="cpf_pai" value="<?= $document->cpf_pai ?>"><br>
        </div>


        <div class="form-group col-md-5">
        Nome da Mãe: <input type="text" class="form-control" name="mae" value="<?= $document->mae ?>"><br>
        </div>


        <div class="form-group col-md-4">
        CPF da Mãe: <input type="text" class="form-control" name="cpf_mae" value="<?= $document->cpf_mae ?>"><br>
        </div>


        <div class="form-group col-md-2">
        Cep: <input type="text" class="form-control" name="cep" value="<?= $document->cep ?>"><br>
        </div>


        <div class="form-group col-md-3">
        Cidade: <input type="text" class="form-control" name="cidade" value="<?= $document->cidade ?>"><br>
        </div>


        <div class="form-group col-md-4">
        Rua: <input type="text" class="form-control" name="rua" value="<?= $document->rua ?>"><br>
        </div>


        <div class="form-group col-md-2">
        Número da casa: <input type="text" class="form-control" name="numero_casa" value="<?= $document->numero_casa ?>"><br>
        </div>


        <div class="form-group col-md-3">
        Bairro: <input type="text" class="form-control" name="bairro" value="<?= $document->bairro ?>"><br>
        </div>


        <div class="form-group col-md-2">
        Estado: <input type="text" class="form-control" name="estado" value="<?= $document->estado ?>"><br>
        </div>


        <div class="form-group col-md-2">
        Turno: <input type="text" class="form-control" name="turno_aula" value="<?= $document->turno_aula ?>"><br>
        </div>


        <div class="form-group col-md-2">
        Horário de Entrada: <input type="text" class="form-control" name="horario_entrada" value="<?= $document->horario_entrada ?>"><br>
        </div>


        <div class="form-group col-md-2">
        Horário de Saída: <input type="text" class="form-control" name="horario_saida" value="<?= $document->horario_saida ?>"><br>
        </div>



        <div class="form-group col-md-2">
        Escola: <input type="text" class="form-control" name="escola" value="<?= $document->escola ?>"><br>
        </div>

        <div class="form-group col-md-2">
        Número da Van: <input type="text" class="form-control" name="numero_van" value="<?= $document->numero_van ?>"><br>
        </div>

        <div class="form-group col-md-4">
    <input type="submit" value="Salvar Alteração" class="btn btn-success">
    <a href="listar_criancas.php" class='btn btn-secondary'>Cancelar</a>
    </div>
</form>
</div>
<footer class="bg-dark text-white text-center py-3 mt-auto">
        © 2024 Gerenciamento de Vans. Todos os direitos reservados.
    </footer>
</body>
</html>

<<<<<<< HEAD
=======
>>>>>>> 7896834 (Front-End)
>>>>>>> e0c1cacc24072453bfd7a7f7223996038cffcc97

