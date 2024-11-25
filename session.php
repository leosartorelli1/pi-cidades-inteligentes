<?php
require 'connection.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}


?>