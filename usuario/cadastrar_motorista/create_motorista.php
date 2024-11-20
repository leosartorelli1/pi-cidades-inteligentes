<?php
require '../../connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar dados do formulário
    $nome_motorista = $_POST['nome_motorista'];
    $cpf_motorista= $_POST['cpf_motorista'];
    $email= $_POST['email'];
    $senha= $_POST['senha'];
    $numero_van= $_POST['numero_van'];


    // Preparar o documento para inserção
    $bulk = new MongoDB\Driver\BulkWrite;
    $document = ['nome_motorista' => $nome_motorista, 'cpf_motorista' => $cpf_motorista, 'email' => $email,'senha' => $senha, 'numero_van' => $numero_van];
    $bulk->insert($document);

    // Inserir no MongoDB
    $manager->executeBulkWrite('empresa.cadastro_motorista', $bulk);

    echo "Motorista cadastrado com sucesso";
}
?>

<form action="create_motorista.php" method="post">
    Nome do Motorista: <input type="text" name="nome_motorista"><br>
    CPF: <input type="text" name="cpf_motorista"><br>
    Email: <input type="email" name="email"><br>
    Senha: <input type="password" name="senha"><br>
    Número da Van: <input type="text" name="numero_van"><br>
    <input type="submit" value="Cadastrar Motorista ao sistema">
    <button><a href="../index.php">Voltar</a></button>
</form>