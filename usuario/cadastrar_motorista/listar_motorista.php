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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f0f0f0; /* Cor de fundo suave */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            color: #ff4d4d; /* Cor do título em vermelho suave */
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #ff4d4d; /* Cabeçalho em vermelho suave */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1; /* Efeito hover nas linhas */
        }

        a {
            text-decoration: none;
            color: #ff4d4d; /* Cor do link em vermelho */
        }

        a:hover {
            color: #e53935; /* Cor do link ao passar o mouse */
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .action-buttons a {
            padding: 8px 12px;
            background-color: #333;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .action-buttons a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div>
        <h2>Motoristas Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome do Motorista</th>
                    <th>Email</th>
                    <th>Número da Van</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Itera sobre os documentos retornados pelo cursor
                foreach ($cursor as $document) {
                    echo "<tr>";
                    echo "<td>" . $document->nome_motorista . "</td>";
                    echo "<td>" . $document->email . "</td>";
                    echo "<td>" . $document->numero_van . "</td>";
                    echo "<td class='action-buttons'>";
                    echo "<a href='update_motorista.php?id=" . $document->_id . "'>Editar</a>";
                    echo "<a href='delete_motorista.php?id=" . $document->_id . "'>Deletar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
