<?php
require '../../connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar o filtro de exclusão com o _id da criança
    $filter = ['_id' => new MongoDB\BSON\ObjectId($id)];

    // Criar a operação de exclusão
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete($filter);

    // Executar a exclusão no MongoDB
    $manager->executeBulkWrite('empresa.cadastro_crianca', $bulk);

    // Redirecionar de volta para a página da lista de crianças
    header('Location: listar_criancas.php');
    exit;
}
?>