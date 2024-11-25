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
<<<<<<< HEAD
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
=======
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

>>>>>>> 7896834 (Front-End)
