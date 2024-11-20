<?php
require '../../connection.php';

$pipeline = [
    [
        '$lookup' => [
            'from' => 'veiculos_cadastrados',  // Coleção de veículos
            'localField' => 'numero_van',      // Campo da coleção cadastro_crianca
            'foreignField' => 'numero_van',    // Campo da coleção veiculos_cadastrados
            'as' => 'detalhes_van'             // Nome do campo que vai armazenar os dados da van
        ]
    ],
    [
        '$unwind' => '$detalhes_van'  // Desempacota o array de detalhes_van
    ]
];

// Criar o comando de agregação
$command = new MongoDB\Driver\Command([
    'aggregate' => 'cadastro_crianca',  // Nome da coleção que estamos agregando
    'pipeline' => $pipeline,            // O pipeline de agregação
    'cursor' => new stdClass()          // Definir um cursor para obter os resultados
]);

// Executar o comando de agregação
try {
    $cursor = $manager->executeCommand('empresa', $command);
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "Erro na execução da agregação: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Crianças e Vans Associadas</title>
    <style>
        /* Estilo Geral */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #ff4d4d;
        }

        /* Estilo para a tabela */
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .styled-table th,
        .styled-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .styled-table th {
            background-color: #ff4d4d;
            color: white;
        }

        td {
            text-align: center;
        }

        /* Estilo para o contêiner dos links */
        .actions {
            display: flex;  /* Utilizando flexbox */
            justify-content: center;  /* Alinha os links no centro */
            gap: 10px;  /* Espaço entre os links */
        }

        /* Estilo para os links */
        a {
            color: #ff4d4d;
            text-decoration: none;
            padding: 8px 12px;
            border: 1px solid #ff4d4d;
            border-radius: 5px;
            display: inline-block;
        }

        a:hover {
            background-color: #ff4d4d;
            color: white;
        }

        /* Estilo para a página */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Efeito hover para as linhas da tabela */
        tr:hover {
            background-color: #f1f1f1;
        }

        /* Efeito de hover no título */
        h1:hover {
            color: #e53935;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Crianças e Vans Associadas</h1>
        <table class="styled-table">
            <tr>
                <th>Nome da Criança</th>
                <th>Nome do Responsável</th>
                <th>Escola</th>
                <th>Turno</th>
                <th>Número da Van</th>
                <th>Placa da Van</th>
                <th>Motorista</th>
                <th>Monitora</th>
                <th>Ações</th>
            </tr>

            <?php
            foreach ($cursor as $document) {
                echo "<tr>";
                echo "<td>" . $document->nome . "</td>";
                echo "<td>" . $document->pai . "</td>";
                echo "<td>" . $document->escola . "</td>";
                echo "<td>" . $document->turno_aula . "</td>";

                // Verificar se os dados da van existem
                if (isset($document->detalhes_van)) {
                    echo "<td>" . $document->detalhes_van->numero_van . "</td>"; 
                    echo "<td>" . $document->detalhes_van->placa . "</td>"; 
                    echo "<td>" . $document->detalhes_van->motorista . "</td>"; 
                    echo "<td>" . $document->detalhes_van->monitora . "</td>";
                    echo "<td class='actions'>
                            <a href='delete_crianca.php?id=" . $document->_id . "'>Deletar</a> | 
                            <a href='update_crianca.php?id=" . $document->_id . "'>Editar</a>
                          </td>";
                } else {
                    echo "<td colspan='4'>Van não encontrada</td>";
                }

                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
