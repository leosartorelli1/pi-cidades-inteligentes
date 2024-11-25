<?php
session_start();

require '../../connection.php'; 

if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<<<<<<< HEAD
=======
<<<<<<< HEAD
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index motorista</title>
</head>
<body>
<h1>Bem-vindo, <?php echo $_SESSION['nome']; ?>!</h1>
<a href="logout_motorista.php">Logout</a>
=======
>>>>>>> e0c1cacc24072453bfd7a7f7223996038cffcc97
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index - Página do Usuário</title>
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
                <a class="nav-link  active" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Notificações Recebidas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Enviar Notificações</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container my-4">
<h1><?php echo $_SESSION['nome']; ?>!</h1>
</div>
<footer class="bg-dark text-white text-center py-3 mt-auto">
        © 2024 Gerenciamento de Vans. Todos os direitos reservados.
    </footer>
<<<<<<< HEAD
=======
>>>>>>> 7896834 (Front-End)
>>>>>>> e0c1cacc24072453bfd7a7f7223996038cffcc97
</body>
</html>