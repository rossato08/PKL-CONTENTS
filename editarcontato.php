<?php
session_start();

// Verifica se o usuário está logado; caso contrário, redireciona para a página de login
if (!isset($_SESSION['usuario_email'])) {
    header("Location: login.php");
    exit;
}

// Obtém o e-mail do usuário e define o caminho do arquivo de contatos
$email_usuario = $_SESSION['usuario_email'];
$arquivo_contatos = 'contatos/' . str_replace(['@', '.'], '_', $email_usuario) . '_contatos.txt';

// Obtém o índice do contato ou define como 0
$indice = (int)$_GET['indice'] ?? 0;

// Lê o arquivo de contatos e obtém os dados do contato selecionado
$contatos = file($arquivo_contatos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$dados = explode('|', $contatos[$indice] ?? '| | | ');

// Processa o envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];

    // Atualiza o contato no arquivo
    $contatos[$indice] = implode('|', [$nome, $telefone, $email, $endereco]);
    file_put_contents($arquivo_contatos, implode(PHP_EOL, $contatos) . PHP_EOL);

    // Redireciona para a lista de contatos
    header("Location: listadecontatos.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Estilos externos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./css/editarcontato.css">
    <title>Editar Contato</title>
</head>
<body>
    <!-- Cabeçalho -->
    <header class="cabecalho">
        <nav class="navegacao">
            <ul>
                <li><a href="./index.html" class="link"><i class="fas fa-home"></i> Início</a></li>
                <li><a href="./addctt.php" class="link"><i class="fas fa-user-plus"></i> Adicionar Contato</a></li>
                <li><a href="./listadecontatos.php" class="link"><i class="fas fa-list"></i> Lista de Contatos</a></li>
                <li><a href="./cadastro.php" class="link"><i class="fas fa-sign-in-alt"></i> Cadastro</a></li>
                <li><a href="./logout.php" class="link"><i class="fas fa-user-slash"></i> Sair</a></li>
                <li><a href="./ajuda.html" class="link"><i class="fas fa-question-circle"></i> Ajuda</a></li>
            </ul>
        </nav>
    </header>

    <br><br><br>

    <!-- Formulário de edição -->
    <form method="POST">
        <h2>Atualizar Informações</h2>
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($dados[0]); ?>" required>

        <label for="telefone">Telefone</label>
        <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($dados[1]); ?>" required>

        <label for="email">E-mail</label>
        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($dados[2]); ?>" required>

        <label for="endereco">Endereço</label>
        <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($dados[3]); ?>" required>

        <div class="btn-container">
            <button type="submit" class="btn btn-salvar">Salvar</button>
            <a href="listadecontatos.php" class="btn btn-cancelar">Cancelar</a>
        </div>
    </form>

    <br><br><br>

    <!-- Rodapé -->
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
                    <p class="card-titulo">Fale conosco</p>
                    <a href="#" class="link"><i class="far fa-envelope"></i> E-mail</a>
                    <a href="#" class="link"><i class="fab fa-whatsapp"></i> Whatsapp</a>
                </div>
            </div>
        </div>
        <p class="texto-rodape">© 2024 Gerenciamento de Contatos. Todos os direitos reservados para PKL contacts.</p>
    </footer>
</body>
</html>