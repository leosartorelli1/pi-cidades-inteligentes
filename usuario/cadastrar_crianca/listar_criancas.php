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
    <title>Lista de Crianças e Vans</title>

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
        <h2 >Lista de Passageiros e Vans Associadas</h2>
        <a class="nav-item btn btn-outline-dark mb-4" href="create_crianca.php">Cadastrar Novos Passageiros</a>

        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome da Criança</th>
                    <th scope="col">Nome do Responsável</th>
                    <th scope="col">Escola</th>
                    <th scope="col">Turno</th>
                    <th scope="col">Número da Van</th>
                    <th scope="col">Placa da Van</th>
                    <th scope="col">Motorista</th>
                    <th scope="col">Monitora</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($cursor as $document) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($document->nome) . "</td>";
                    echo "<td>" . htmlspecialchars($document->pai) . "</td>";
                    echo "<td>" . htmlspecialchars($document->escola) . "</td>";
                    echo "<td>" . htmlspecialchars($document->turno_aula) . "</td>";

                    // Verificar se os dados da van existem
                    if (isset($document->detalhes_van)) {
                        echo "<td>" . htmlspecialchars($document->detalhes_van->numero_van) . "</td>"; 
                        echo "<td>" . htmlspecialchars($document->detalhes_van->placa) . "</td>"; 
                        echo "<td>" . htmlspecialchars($document->detalhes_van->motorista) . "</td>"; 
                        echo "<td>" . htmlspecialchars($document->detalhes_van->monitora) . "</td>";
                        echo "<td>
                        <a href='update_crianca.php?id=" . $document->_id . "' class='btn btn-secondary'>Editar</a>
                        <a href='delete_crianca.php?id=" . $document->_id . "' onclick='return confirm(\"Tem certeza que deseja excluir?\");' class='btn btn-danger'>Deletar</a>
                      </td>";
                    } else {
                        echo "<td colspan='4'>Van não encontrada</td>";
                    }

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>

    <!-- Script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0b5VW98jvTKl/5h5+GrVnYPum9Xl0xzTdfZB7kLqTnA5g6Xj" crossorigin="anonymous"></script>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        © 2024 Gerenciamento de Vans. Todos os direitos reservados.
    </footer>
</body>
</html>