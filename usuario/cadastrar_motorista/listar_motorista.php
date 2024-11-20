<?php
require '../../connection.php';

$query = new MongoDB\Driver\Query([]);

$cursor = $manager->executeQuery('empresa.cadastro_motorista', $query); 

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Motoristas Cadastrados</title>
</head>
<body>
    <h2>Motoristas Cadastrados</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nome do Motorista</th>
                <th>Email</th>
                <th>Número da Van</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            // Itera sobre os documentos retornados pelo cursor
            foreach ($cursor as $document) {
                echo "<tr>";
                echo "<td>" . $document->nome_motorista . "</td>";
                echo "<td>" . $document->email  . "</td>";
                echo "<td>" . $document->numero_van . "</td>";
                //echo "<td><a href='update.php?id=" . $document->_id . "'>Editar</a> | ";
                //echo "<a href='delete.php?id=" . $document->_id . "'>Deletar</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

