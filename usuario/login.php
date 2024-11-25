<?php
require '../connection.php';
session_start();

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica na coleção 'empresa.usuario'
    $filter = ['email' => $email];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $manager->executeQuery('empresa.usuario', $query);
    $usuario = current($cursor->toArray());

    // Se não encontrar na coleção 'empresa.usuario', verifica na coleção 'empresa.cadastro_motorista'
    if (!$usuario) {
        $filter_motorista = ['email' => $email]; // Verifica o campo email_motorista
        $query_motorista = new MongoDB\Driver\Query($filter_motorista);
        $cursor_motorista = $manager->executeQuery('empresa.cadastro_motorista', $query_motorista);
        $usuario = current($cursor_motorista->toArray());
    }

    // Se não encontrar na coleção 'empresa.usuario' e 'empresa.cadastro_motorista', verifica na coleção 'empresa.cadastro_crianca'
    if (!$usuario) {
        $filter_pai = ['email' => $email]; // Verifica o campo email (pais)
        $query_pai = new MongoDB\Driver\Query($filter_pai);
        $cursor_pai = $manager->executeQuery('empresa.cadastro_crianca', $query_pai);
        $usuario = current($cursor_pai->toArray());
    }

    // Verifica se o usuário foi encontrado
    if ($usuario) {
        // Comparação direta da senha
        if ($senha == $usuario->senha) {
            $_SESSION['email'] = $usuario->email ?? $usuario->email_motorista ?? $usuario->email; 
            $_SESSION['id'] = (string) $usuario->_id;

            var_dump($usuario);

            if (isset($usuario->nome_motorista)) {
                $_SESSION['nome'] = $usuario->nome_motorista; 
            } elseif (isset($usuario->pai)) {
                $_SESSION['nome'] = $usuario->pai; 
            } elseif (isset($usuario->nome)) {
                $_SESSION['nome'] = $usuario->nome; 
            }

            // Redireciona para a página correta com base na coleção encontrada
            if (isset($usuario->cpf_motorista)) { // Se for motorista
                header("Location: cadastrar_motorista/index_motorista.php");  // Página do motorista
            } elseif (isset($usuario->cpf_pai)) { // Se for pai (baseado na coleção 'cadastro_crianca')
                header("Location: cadastrar_crianca/index_pais.php");  // Página do pai
            } else { // Se for um usuário normal
                header("Location: index.php");  // Página do usuário
            }
            exit();
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Email não encontrado!";
    }
} else {
    $erro = "Por favor, preencha todos os campos!";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .login-form {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .login-form h1 {
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
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 login-form">
                <h1 class="mb-4">Login</h1>
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Entrar" class="btn btn-primary">
                    </div>
                </form>

                <p class="text-center">
                    <a href="recuperar_senha.php">Esqueci minha senha</a>
                </p>

                <?php
                if (isset($erro)) {
                    echo "<p style='color:red;' class='text-center'>$erro</p>";
                }
                ?>
            </div>
        </div>
    </div>

</body>
</html>