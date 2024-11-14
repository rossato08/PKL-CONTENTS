<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuarios = file('usuarios.txt', FILE_IGNORE_NEW_LINES);
    foreach ($usuarios as $usuario) {
        list($nome, $sobrenome, $cpf, $email_armazenado, $senha_armazenada) = explode('|', $usuario);
        if ($email_armazenado === $email && $senha_armazenada === $senha) {
            $_SESSION['usuario_email'] = $email;
            header("Location: addctt.php");
            exit;
        }
    }

    $erro = "E-mail ou senha inválidos!";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PKL Contacts</title>
    <link rel="stylesheet" href="testes.css">
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

<h1>Login</h1>

<form action="login.php" method="POST">
    <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br>
    </div>
    <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>
    </div>
    <button class="botaocadastro" type="submit">Entrar</button>
</form>

<?php if (isset($erro)): ?>
    <p style="color: red;"><?php echo $erro; ?></p>
<?php endif; ?>

<footer class="footerslk">
    <div class="footer1">
        <p class="rodape">&copy; PKL Contacts - Todos os direitos reservados</p>
    </div>
</footer>

</body>
</html>
