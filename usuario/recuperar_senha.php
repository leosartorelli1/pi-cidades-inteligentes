<?php
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Verificar se o email existe nas coleções
    $filter = ['email' => $email];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $manager->executeQuery('empresa.usuario', $query);
    $usuario = current($cursor->toArray());

    if (!$usuario) {
        // Se não encontrar, verificar nas outras coleções
        $filter_motorista = ['email' => $email];
        $query_motorista = new MongoDB\Driver\Query($filter_motorista);
        $cursor_motorista = $manager->executeQuery('empresa.cadastro_motorista', $query_motorista);
        $usuario = current($cursor_motorista->toArray());
    }

    if (!$usuario) {
        // Se não encontrar, verificar na coleção 'empresa.cadastro_crianca'
        $filter_crianca = ['email' => $email]; // Verificar o campo email dos pais
        $query_crianca = new MongoDB\Driver\Query($filter_crianca);
        $cursor_crianca = $manager->executeQuery('empresa.cadastro_crianca', $query_crianca);
        $usuario = current($cursor_crianca->toArray());
    }

    if (!$usuario) {
        $erro = "Email não encontrado!";
    } else {
        // Enviar email ou gerar token para trocar a senha
        // Neste exemplo, vamos apenas simular que a senha foi enviada
        $mensagem = "Enviamos um link para seu email para trocar sua senha.";
        // Aqui você pode integrar o envio de um email real, usando PHPMailer ou outra biblioteca

        // Redireciona o usuário para a página de troca de senha
        header("Location: trocar_senha.php?email=" . urlencode($email));
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("https://bkpsitecpsnew.blob.core.windows.net/uploadsitecps/sites/1/2022/07/bg-footer-ed-azul-base.png");
            background-position: right center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-color: rgba(0, 95, 107, 0.8); /* Cor de fundo com transparência */
            height: 100vh; /* Garante que o fundo ocupe toda a tela */
            margin: 0;
        }

        .container {
            position: relative;
            z-index: 2;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 form-container">
                <h1 class="mb-4">Recuperar Senha</h1>
                <form action="recuperar_senha.php" method="post">
                    <div class="form-group">
                        <label for="email">Digite seu email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Enviar Link" class="btn">
                    </div>
                </form>

                <?php
                if (isset($erro)) {
                    echo "<p style='color:red;' class='text-center'>$erro</p>";
                }

                if (isset($mensagem)) {
                    echo "<p style='color:green;' class='text-center'>$mensagem</p>";
                }
                ?>
            </div>
        </div>
    </div>

</body>
</html>