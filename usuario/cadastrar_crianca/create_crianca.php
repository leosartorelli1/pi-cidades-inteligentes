<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Passageiro</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<?php
require '../../connection.php';

// Verificação e processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $idade = $_POST['idade'];
    $pai = $_POST['pai'];
    $cpf_pai = $_POST['cpf_pai'];
    $mae = $_POST['mae'];
    $cpf_mae = $_POST['cpf_mae'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $rua = $_POST['rua'];
    $numero_casa = $_POST['numero_casa'];
    $bairro = $_POST['bairro'];
    $estado = $_POST['estado'];
    $turno_aula = $_POST['turno_aula'];
    $horario_entrada = $_POST['horario_entrada'];
    $horario_saida = $_POST['horario_saida'];
    $escola = $_POST['escola'];
    $numero_van = $_POST['numero_van'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Preparar o documento para inserção
    $bulk = new MongoDB\Driver\BulkWrite;
    $document = [
        'nome'            => $nome,
        'cpf'             => $cpf,
        'idade'           => $idade,
        'pai'             => $pai,
        'cpf_pai'         => $cpf_pai,
        'mae'             => $mae,
        'cpf_mae'         => $cpf_mae,
        'cep'             => $cep,
        'cidade'          => $cidade,
        'rua'             => $rua,
        'numero_casa'     => $numero_casa,
        'bairro'          => $bairro,
        'estado'          => $estado,
        'turno_aula'      => $turno_aula,
        'horario_entrada' => $horario_entrada,
        'horario_saida'   => $horario_saida,
        'escola'          => $escola,
        'numero_van'      => $numero_van,
        'senha'           => $senha,
        'email'           => $email
    ];
    $bulk->insert($document);

    // Inserir no MongoDB
    $manager->executeBulkWrite('empresa.cadastro_crianca', $bulk);

    echo "Responsáveis e filho cadastrado com sucesso!";

}
?>

<form action="create_crianca.php" method="post">
    Nome do filho(a): <input type="text" name="nome" required><br>
    CPF do filho(a): <input type="text" name="cpf" required><br>
    Idade do filho(a): <input type="text" name="idade" required><br>
    Nome do pai: <input type="text" name="pai" required><br>
    CPF do pai: <input type="text" name="cpf_pai" required><br>
    Nome da mãe: <input type="text" name="mae" required><br>
    CPF da mãe: <input type="text" name="cpf_mae" required><br>
    Cep: <input type="text" name="cep" id="cep" required><br>
    Cidade: <input type="text" name="cidade" id="cidade" required><br>
    Rua: <input type="text" name="rua" id="rua" required><br>
    Número da casa: <input type="number" name="numero_casa"><br>
    Bairro: <input type="text" name="bairro" id="bairro" required><br>
    Estado: <input type="text" name="estado" id="estado" required><br>
    Escola: <input type="text" name="escola" required><br>
    Turno: <input type="text" name="turno_aula" required><br>
    Horário de Entrada: <input type="text" name="horario_entrada" required><br>
    Horário de Saída: <input type="text" name="horario_saida" required><br>
    Número da Van: <input type="text" name="numero_van" required><br>
    Email: <input type="email" name="email" required><br>
    Senha: <input type="password" name="senha" required><br>
    <input type="submit" value="Cadastrar Criança">
    <button><a href="../index.php">Voltar</a></button>
</form>

<script>
$('#cep').on('blur', function() {
    var cep = $(this).val().replace(/\D/g, '');
    if (cep != '') {
        var validacep = /^[0-9]{8}$/;
        if(validacep.test(cep)) {
            $.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function(data) {
                if (!data.erro) {
                    $('#rua').val(data.logradouro);
                    $('#bairro').val(data.bairro);
                    $('#cidade').val(data.localidade);
                    $('#estado').val(data.uf);
                } else {
                    alert("CEP não encontrado.");
                }
            });
        } else {
            alert("Formato de CEP inválido.");
        }
    }
});
</script>

</body>
</html>