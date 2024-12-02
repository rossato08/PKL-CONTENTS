<?php
session_start(); // Inicia a sessão, permitindo acesso a variáveis de sessão

// Verificar se o usuário está logado, caso contrário redireciona para a página de login
if (!isset($_SESSION['usuario_email'])) {
    header("Location: login.php");
    exit;
}

// Obtém o e-mail do usuário logado da variável de sessão e define o arquivo de contatos
$email_usuario = $_SESSION['usuario_email'];
$arquivo_contatos = 'contatos/' . str_replace(['@', '.'], '_', $email_usuario) . '_contatos.txt'; // Modifica o e-mail para criar um nome de arquivo seguro

// Cria o diretório de contatos caso ele não exista
if (!is_dir('contatos')) {
    mkdir('contatos', 0777, true); // Cria o diretório com permissão de leitura e gravação
}

// Processar o formulário de adição de contato (quando o método da requisição for POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);
    $email = trim($_POST['email']);
    $endereco = trim($_POST['endereco']);

    // Valida se todos os campos foram preenchidos
    if ($nome && $telefone && $email && $endereco) {
        // Cria a string do contato no formato nome|telefone|email|endereco
        $contato = $nome . '|' . $telefone . '|' . $email . '|' . $endereco . PHP_EOL;
        // Adiciona o contato ao arquivo do usuário
        file_put_contents($arquivo_contatos, $contato, FILE_APPEND);

        // Redireciona para a lista de contatos após adicionar o contato
        header("Location: listadecontatos.php");
        exit;
    } else {
        // Caso algum campo não tenha sido preenchido, exibe uma mensagem de erro
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
     <!-- Link para o Font Awesome, usado para ícones -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <!-- CSS do formulário -->
     <link rel="stylesheet" href="./css/addctt.css">
</head>
<body>
<!-- Cabeçalho com menu de navegação -->
<header class="cabecalho">
        <nav class="navegacao">
            <ul>
                <li><a href="./index.html" class="link" aria-label="Início"><i class="fas fa-home"></i> Início</a></li>
                <li><a href="./addctt.php" class="link" aria-label="Adicionar Contato"><i class="fas fa-user-plus"></i>Adicionar Contato</a></li>
                <li><a href="./listadecontatos.php" class="link" aria-label="Lista de Contatos"><i class="fas fa-list"></i> Lista de Contatos</a></li>
                <li><a href="./cadastro.php" class="link" aria-label="Cadastro"><i class="fas fa-sign-in-alt"></i> Cadastro</a></li>
                <li><a href="./logout.php" class="link" aria-label="Login"><i class="fas fa-user-slash"></i> Sair</a></li>    
                <li><a href="./ajuda.html" class="link" aria-label="Ajuda"><i class="fas fa-question-circle"></i> Ajuda</a></li>                
            </ul>
        </nav>
</header>
<br><br>
<!-- Formulário para adicionar um contato -->
<div class="formulario">
    <h1>Adicionar Contato</h1>
    <!-- O formulário envia os dados para a mesma página (addctt.php) -->
    <form action="addctt.php" method="POST">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required placeholder="Digite o nome completo">
        </div>
        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" required placeholder="Ex: (11) 91234-5678">
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required placeholder="Digite o e-mail">
        </div>
        <div class="form-group">
            <label for="endereco">Endereço:</label>
            <textarea id="endereco" name="endereco" required placeholder="Digite o endereço"></textarea>
        </div>
        <!-- Botão para enviar o formulário -->
        <button class="botao" type="submit">Adicionar Contato</button>
    </form>

    <!-- Exibe erro caso o formulário não seja validado corretamente -->
    <?php if (isset($erro)): ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>
</div>

<!-- Rodapé com links de contato e redes sociais -->
<footer class="rodape">
        <div class="cards">
        <div class="cardrodape">
            <div class="contatos">
                <p class="card-titulo">Nos siga</p>
                <a href="#" class="link"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="#" class="link"><i class="fab fa-facebook"></i> Facebook</a>
                <a href="#" class="link"><i class="fab fa-linkedin"></i> Linkedin</a>
            </div>
        </div>
        <div class="cardrodape">
            <div class="contatos">
                <p class="card-titulo">Explorar</p>
                <a href="./index.html" class="explorar">Início</a><br>
                <a href="./addctt.php" class="explorar">Adicionar contato</a><br>
                <a href="./listadecontatos.php" class="explorar">Lista de Contatos</a><br>
                <a href="./cadastro.php" class="explorar">Cadastro</a><br>
                <a href="./login.php" class="explorar">Login</a><br>
                <a href="./ajuda.html" class="explorar">Ajuda</a>
            </div>
        </div>
        <div class="cardrodape">
            <div class="contatos">
                <p class="card-titulo">Fale conosco </p>
                <a href="#" class="link"><i class="far fa-envelope"></i> E-mail</a>
                <a href="#" class="link"><i class="fab fa-whatsapp"></i> Whatsapp</a>
            </div>
        </div>
    </div>
    <p class="texto-rodape">© 2024 Gerenciamento de Contatos. Todos os direitos reservados para PKL contacts.</p>
</footer>
</body>
</html>
