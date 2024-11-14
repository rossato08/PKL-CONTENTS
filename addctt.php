<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_email'])) {
    header("Location: login.php");
    exit;
}

// Obter o e-mail do usuário logado e definir o arquivo de contatos do usuário
$email_usuario = $_SESSION['usuario_email'];
$arquivo_contatos = 'contatos/' . str_replace(['@', '.'], '_', $email_usuario) . '_contatos.txt';

// Criar o diretório de contatos, se não existir
if (!is_dir('contatos')) {
    mkdir('contatos', 0777, true);
}

// Processar o formulário de adição de contato
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);

    // Validar se o nome e o telefone foram preenchidos
    if ($nome && $telefone) {
        // Salvar o contato no arquivo do usuário
        $contato = $nome . '|' . $telefone . PHP_EOL;
        file_put_contents($arquivo_contatos, $contato, FILE_APPEND);
        
        // Redirecionar para a lista de contatos após adicionar o contato
        header("Location: listadecontatos.php");
        exit;
    } else {
        $erro = "Por favor, preencha todos os campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Contato - PKL Contacts</title>
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

<h1>Adicionar Contato</h1>

<form action="addctt.php" method="POST">
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>
    </div>
    <div class="form-group">
        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" required placeholder="Ex: (11) 91234-5678"><br>
    </div>
    <button class="botaocadastro" type="submit">Adicionar Contato</button>
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
