<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_email'])) {
    header("Location: login.php");
    exit;
}

// Obter o e-mail do usuário logado e criar o nome do arquivo de contatos
$email_usuario = $_SESSION['usuario_email'];
$arquivo_contatos = 'contatos/' . str_replace(['@', '.'], '_', $email_usuario) . '_contatos.txt';

$contatos = [];

// Verificar se o arquivo de contatos do usuário existe e lê-lo
if (file_exists($arquivo_contatos)) {
    $contatos = file($arquivo_contatos, FILE_IGNORE_NEW_LINES);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contatos - PKL Contacts</title>
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

<h1>Lista de Contatos</h1>

<?php if (!empty($contatos)): ?>
    <ul>
        <?php foreach ($contatos as $contato): ?>
            <?php list($nome, $telefone) = explode('|', $contato); ?>
            <li><?php echo "Nome: $nome, Telefone: $telefone"; ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Nenhum contato encontrado.</p>
<?php endif; ?>

<footer class="footerslk">
    <div class="footer1">
        <p class="rodape">&copy; PKL Contacts - Todos os direitos reservados</p>
    </div>
</footer>

</body>
</html>
