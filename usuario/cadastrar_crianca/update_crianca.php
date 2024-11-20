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

