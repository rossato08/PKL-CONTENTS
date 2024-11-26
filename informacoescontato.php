<?php
session_start();

// Verifica se o índice foi passado e se o contato existe
if (!isset($_GET['index']) || !isset($_SESSION['contatos'][$_GET['index']])) {
    echo "Contato não encontrado.";
    exit;
}

// Obtém o contato específico a partir do índice
$index = $_GET['index'];
$contato = $_SESSION['contatos'][$index];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Contato</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="./css/informacoescontato.css">
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
                <li><a href="./logout.php" class="link" aria-label="Logout"><i class="fas fa-user-slash"></i> Sair</a></li>    
                <li><a href="./ajuda.html" class="link" aria-label="Ajuda"><i class="fas fa-question-circle"></i> Ajuda</a></li>                 
            </ul>
        </nav>
    </header>
    <h1>Informações do Contato</h1>
    <p><strong>Nome:</strong> <?php echo $contato['nome']; ?></p>
    <p><strong>Email:</strong> <?php echo $contato['email']; ?></p>
    <p><strong>Telefone:</strong> <?php echo $contato['telefone']; ?></p>
    <p><strong>Endereço:</strong> <?php echo $contato['endereco']; ?></p>

    <p><a href="listadecontatos.php">Voltar para a lista de contatos</a></p>
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
