<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Lê o arquivo de usuários
    $usuarios = file('usuarios.txt', FILE_IGNORE_NEW_LINES);

    $usuario_encontrado = false;
    foreach ($usuarios as $usuario) {
        list($nome_armazenado, $sobrenome_armazenado, $cpf_armazenado, $email_armazenado, $senha_armazenada) = explode('|', $usuario);

        // Verificar se o email existe
        if ($email_armazenado == $email) {
            $usuario_encontrado = true;

            // Verificar se a senha é correta
            if ($senha_armazenada == $senha) {
                echo "Login bem-sucedido! Bem-vindo, $nome_armazenado.";
                exit;
            } else {
                echo "Senha incorreta!";
                exit;
            }
        }
    }

    if (!$usuario_encontrado) {
        echo "Usuário não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>
    <link rel="stylesheet" href="testes.css">
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #6f42c1;
        }

        .form-row {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        .form-group input:focus {
            border-color: #6f42c1;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #6f42c1;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
        }

        button:hover {
            background-color: #5a34a3;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .footer p {
            font-size: 0.9rem;
            color: #777;
        }
    </style>
</head>
<body>

    <header class="cabecalho">
        <h1 class="titulo">PKL Contacts</h1>
        <nav class="navegacao">
            <ul class="lista">
                <li><a href="index.html" class="link">Início</a></li>
                <li><a href="cadastro.php" class="link">Cadastro</a></li>
                <li><a href="login.php" class="link">Login</a></li>
            </ul>
        </nav>
    </header>

    <div class="login-container">
        <h1>Login de Usuário</h1>
    
        <form method="POST" action="login.php">
            <div class="form-row">
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
            </div>

            <button type="submit">Entrar</button>
        </form>
    </div>

    <footer class="footer">
        <p>&copy; PKL Contacts - Todos os direitos reservados</p>
    </footer>
    
</body>
</html>
