<?php
session_start();
require '../connection.php';

// Verificar se o usuário está logado
require '../session.php';
$query = new MongoDB\Driver\Query([]);

$cursor = $manager->executeQuery('empresa.veiculos_cadastrados', $query); 
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gerenciamento de Vans</h1>

    <a href="create.php">Adicionar Nova Van</a> | 
    <a href="cadastrar_crianca/create_crianca.php">Cadastrar Novos Passageiros</a>
    <a href="cadastrar_crianca/listar_criancas.php">Lista de Passageiros Cadastrados</a>
    <a href="cadastrar_motorista/create_motorista.php">Cadastrar Motorista</a>
    <a href="cadastrar_motorista/listar_motorista.php">Lista de Motorista Cadastrados</a>
    <a href="logout.php">Logout</a>

    <h2>Vans Cadastradas</h2>
    <table>
        <thead>
            <tr>
                <th>Número da van</th>
                <th>Placa</th>
                <th>Motorista</th>
                <th>Monitora</th>
            </tr>
        </thead> 
        <tbody>
            <?php
            foreach ($cursor as $document) {
                echo "<tr>";
                echo "<td>" . $document->numero_van . "</td>";
                echo "<td>" . $document->placa . "</td>";
                echo "<td>" . $document->motorista . "</td>";
                echo "<td>" . $document->monitora . "</td>";
                echo "<td><a href='update.php?id=" . $document->_id . "'>Editar</a> | ";
                echo "<a href='delete.php?id=" . $document->_id . "'>Deletar</a></td>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
