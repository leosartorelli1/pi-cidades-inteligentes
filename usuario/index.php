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
<<<<<<< HEAD
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Resetando estilos padrões */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Cor de fundo suave */
            color: #333; /* Texto principal */
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Altura mínima para garantir que o rodapé fique na parte inferior */
        }

        h1, h2 {
            color: #ff4d4d; /* Vermelho suave */
        }

        a {
            text-decoration: none;
            color: #ff4d4d; /* Cor para links */
            margin-right: 15px;
        }

        a:hover {
            color: #ffcc00; /* Amarelo suave no hover */
        }

        nav {
            background-color: #ff4d4d; /* Barra de navegação com o mesmo vermelho suave */
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        nav a {
            color: white;
            font-size: 16px;
            margin: 0 10px;
        }

        nav a:hover {
            color: #ffcc00; /* Cor amarela no hover */
        }

        h2 {
            margin-top: 20px;
            font-size: 24px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc; /* Cor da borda suave */
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #ff4d4d; /* Fundo vermelho suave para cabeçalhos */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9; /* Cor de fundo alternada nas linhas */
        }

        tr:hover {
            background-color: #ffcc00; /* Amarelo suave ao passar o mouse */
            color: white;
        }

        td a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }

        td a:hover {
            color: #ff4d4d; /* Vermelho suave no hover */
        }

        /* Estilo de botões e links */
        .btn {
            padding: 8px 15px;
            background-color: #ff4d4d;
            color: white;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #ffcc00; /* Amarelo suave no hover */
        }

        footer {
            text-align: center;
            margin-top: auto; /* Isso empurra o footer para o fundo da página */
            padding: 20px;
            background-color: #333;
            color: white;
        }

    </style>
</head>
<body>
    <nav>
        <a href="create.php">Adicionar Nova Van</a> |
        <a href="cadastrar_crianca/create_crianca.php">Cadastrar Novos Passageiros</a> |
        <a href="cadastrar_crianca/listar_criancas.php">Lista de Passageiros Cadastrados</a> |
        <a href="cadastrar_motorista/create_motorista.php">Cadastrar Motorista</a> |
        <a href="cadastrar_motorista/listar_motorista.php">Lista de Motorista Cadastrados</a> |
        <a href="logout.php">Logout</a>
    </nav>

    <div style="text-align: center;">
        <h1>Gerenciamento de Vans</h1>

        <h2>Vans Cadastradas</h2>

        <table>
            <thead>
                <tr>
                    <th>Número da Van</th>
                    <th>Placa</th>
                    <th>Motorista</th>
                    <th>Monitora</th>
                    <th>Ações</th>
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
                    echo "<td><a class='btn' href='update.php?id=" . $document->_id . "'>Editar</a> | ";
                    echo "<a class='btn' href='delete.php?id=" . $document->_id . "'>Deletar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; 2024 Gerenciamento de Vans. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
                
=======
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body class="d-flex flex-column" style="height: 100vh;">
    <header class="d-flex justify-content-between align-items-center">
        <div class="header-cont d-flex align-items-center">
        <img src="assets/logo3.jpg" alt="logo van" class="logo-van d-inline ">
        <h1 class="text-white display-4 d-inline">Vans-Control</h1>
        </div>
        <div><a class="nav-item nav-link btn btn-light mr-4 " href="logout.php" >Sair</a></div>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNavAltMarkup">
        <ul class="nav nav-pills"> 
            <li class="nav-item">
                <a class="nav-link active" href="#">Vans</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cadastrar_crianca/listar_criancas.php">Lista de Passageiros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cadastrar_motorista/listar_motorista.php">Lista de Motoristas</a>
            </li>
        </ul>
    </div>
</nav>

   
    <div class="container my-4">
    <h2>Vans Cadastradas</h2>
    <a class="nav-item btn btn-outline-dark mb-4"  href="create.php" >Adicionar Nova Van</a> 
    <div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Número da van</th>
                <th scope="col">Placa</th>
                <th scope="col">Motorista</th>
                <th scope="col">Monitora</th>
                <th scope="col">Ações</th>
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
                echo "<td ><a href='update.php?id=" . $document->_id . "' class='btn btn-secondary'>Editar</a> | ";
                echo "<a href='delete.php?id=" . $document->_id . "' onclick='return confirm(\"Tem certeza que deseja excluir?\");' class='btn btn-danger'>Deletar</a></td>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
    </div>

    <footer  class="bg-dark text-white text-center py-3 mt-auto">
        © 2024 Gerenciamento de Vans. Todos os direitos reservados.
    </footer>
</body>
</html>
>>>>>>> 7896834 (Front-End)
