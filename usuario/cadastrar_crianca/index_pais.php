<?php

session_start();

require '../../connection.php'; 

if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit();
}

// Obtém o email do pai logado
$email= $_SESSION['email'];


$filter = ['email' => $email];  
$query_crianca = new MongoDB\Driver\Query($filter);
$cursor_crianca = $manager->executeQuery('empresa.cadastro_crianca', $query_crianca);

$criancas = [];
foreach ($cursor_crianca as $crianca) {
    if (is_object($crianca->numero_van)) {
        $numero_van = $crianca->numero_van->nome;
    } else {
        $numero_van = $crianca->numero_van; 
    }

    $criancas[] = [
        'crianca' => $crianca->nome,  
        'numero_van' => $numero_van  
    ];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index - Página do Usuário</title>
</head>
<body>

<h1>Bem-vindo, <?php echo $_SESSION['nome']; ?>!</h1>

<h2>Crianças e suas Vans</h2>
<table border="1">
    <thead>
        <tr>
            <th>Nome da Criança</th>
            <th>Van</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($criancas as $crianca): ?>
        <tr>
            <td><?php echo $crianca['crianca']; ?></td>
            <td><?php echo $crianca['numero_van']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="logout_pais.php">Logout</a>

</body>
</html>