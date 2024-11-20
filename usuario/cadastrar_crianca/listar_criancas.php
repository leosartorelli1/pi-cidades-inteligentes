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


// Exibir os resultados
echo "<h1>Lista de Crianças e Vans Associadas</h1>";
echo "<table border='1'>
        <tr>
            <th>Nome da Criança</th>
            <th>Nome do Responsável</th>
            <th>Escola</th>
            <th>Turno</th>
            <th>Número da Van</th>
            <th>Placa da Van</th>
            <th>Motorista</th>
            <th>Monitora</th>
        </tr>";

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
        echo "<td><a href='delete_crianca.php?id=" . $document->_id . "'>Deletar</a> | ";
        echo "<a href='update_crianca.php?id=" . $document->_id . "'>Editar</a></td> ";
    } else {
        echo "<td colspan='4'>Van não encontrada</td>";
    }

    echo "</tr>";
}
echo "</table>";

?>

