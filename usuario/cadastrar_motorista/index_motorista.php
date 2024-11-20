<?php
session_start();

require '../../connection.php'; 

if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index motorista</title>
</head>
<body>
<h1>Bem-vindo, <?php echo $_SESSION['nome']; ?>!</h1>
<a href="logout_motorista.php">Logout</a>
</body>
</html>