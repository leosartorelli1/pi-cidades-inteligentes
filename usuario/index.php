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
                