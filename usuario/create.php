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
<form action="create.php" method="post">
    Número da van: <input type="text" name="numero_van"><br>
    Placa: <input type="text" name="placa"><br>
    Motorista: <input type="text" name="motorista"><br>
    Monitora: <input type="text" name="monitora"><br>
    <input type="submit" value="Cadastrar veiculo">
</form>