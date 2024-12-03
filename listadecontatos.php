<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_email'])) {
    header("Location: login.php");
    exit;
}
// Obter o e-mail do usuário logado e definir o arquivo de contatos
$email_usuario = $_SESSION['usuario_email'];
$arquivo_contatos = 'contatos/' . str_replace(['@', '.'], '_', $email_usuario) . '_contatos.txt';

// Verificar se o arquivo de contatos existe
$contatos = [];
if (file_exists($arquivo_contatos)) {
    $linhas = file($arquivo_contatos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
   
}
// Excluir contato
if (isset($_GET['excluir'])) {
    $indice = (int)$_GET['excluir'];
    if (isset($contatos[$indice])) {
        unset($contatos[$indice]);
        // Atualizar o arquivo
        $novas_linhas = [];
        foreach ($contatos as $contato) {
            $novas_linhas[] = implode('|', $contato);
        }
        file_put_contents($arquivo_contatos, implode(PHP_EOL, $novas_linhas) . PHP_EOL);
        header("Location: listadecontatos.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contatos - PKL Contacts</title>
    <!-- Link para o Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./css/listadecontatos.css">
</head>
<body>
<!--cabeçalho-->
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
<?php if (!empty($contatos)): ?>
<!--lista d contatos com informações -->
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contatos as $indice => $contato): ?>
                <tr>
                    <td><?php echo htmlspecialchars($contato['nome']); ?></td>
                    <td><?php echo htmlspecialchars($contato['telefone']); ?></td>
                    <td><?php echo htmlspecialchars($contato['email']); ?></td>
                    <td><?php echo htmlspecialchars($contato['endereco']); ?></td>
            <!--Botões-->
                    <td>
                        <a class="btn btn-editar" href="editarcontato.php?indice=<?php echo $indice; ?>">Editar</a>
                        <a class="btn btn-excluir" href="listadecontatos.php?excluir=<?php echo $indice; ?>" onclick="return confirm('Tem certeza que deseja excluir este contato?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
            <!--se não ouver contatos adicionados na conta-->
<?php else: ?>
    <p>Nenhum contato encontrado. Adicione um novo contato!</p>
<?php endif; ?>

<!-- Rodape -->
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
