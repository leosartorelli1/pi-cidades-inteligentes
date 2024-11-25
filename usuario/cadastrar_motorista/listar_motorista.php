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
                <a class="nav-link" href="../cadastrar_crianca/listar_criancas.php">Lista de Passageiros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="../cadastrar_motorista/listar_motorista.php">Lista de Motoristas</a>
            </li>
        </ul>
    </div>
</nav>

    <div class="container my-4">
    <h2>Motoristas Cadastrados</h2>
    <a class="nav-item btn btn-outline-dark mb-4" href="create_motorista.php">Cadastrar Novos Motoristas</a>

    <div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th  scope="col">Nome do Motorista</th>
                <th  scope="col">Email</th>
                 <!--<th  scope="col">Número da Van</th>-->
                <th scope="col">Ações</th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php
            // Itera sobre os documentos retornados pelo cursor
            foreach ($cursor as $document) {
                echo "<tr>";
                echo "<td>" . $document->nome_motorista . "</td>";
                echo "<td>" . $document->email  . "</td>";
               // echo "<td>" . $document->numero_van . "</td>";
                echo "<td> 
                <a href='update_motorista.php?id=" . $document->_id . "' class='btn btn-secondary'>Editar</a> | 
                <a href='delete_motorista.php?id=" . $document->_id . "' onclick='return confirm(\"Tem certeza que deseja excluir?\");'  class='btn btn-danger'>Deletar</a>
              </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
        </div>
        </div>
        <footer class="bg-dark text-white text-center py-3 mt-auto">
        © 2024 Gerenciamento de Vans. Todos os direitos reservados.
    </footer>
</body>
</html>

