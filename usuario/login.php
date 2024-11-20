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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0; /* Cor de fundo suave */
        }

        .login {
            background-color: #ff4d4d; /* Vermelho suave */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;

            width: 350px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra */
        }

        .login h1 {
            color: white;
            margin-bottom: 20px;
        }

        .login label {
            align-self: flex-start;
            margin-bottom: 5px;
            color: white;
        }

        .login input[type="email"], .login input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
        }

        .login input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .login input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <form class="login" action="login.php" method="post">
        <h1>Login</h1>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required>
        <input type="submit" value="Entrar">
    </form>

    <?php
    if (isset($erro)) {
        echo "<p style='color:red; text-align: center;'>$erro</p>";
    }
    ?>
</body>
</html>
