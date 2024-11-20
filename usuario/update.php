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

<form action="update.php" method="post">
    <input type="hidden" name="id" value="<?= $veiculos->_id ?>">
    Número da van: <input type="text" name="numero_van" value="<?= $veiculos->numero_van ?>"><br>
    Placa: <input type="text" name="placa" value="<?= $veiculos->placa ?>"><br>
    Motorista: <input type="text" name="motorista" value="<?= $veiculos->motorista ?>"><br>
    Monitora: <input type="text" name="monitora" value="<?= $veiculos->monitora ?>"><br>
    <input type="submit" value="Atualizar Informações do Veiculo">
</form>