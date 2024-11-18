<?php
session_start();

if (!isset($_GET['index']) || !isset($_SESSION['contatos'][$_GET['index']])) {
    echo "Contato não encontrado.";
    exit;
}

$index = $_GET['index'];
$contato = $_SESSION['contatos'][$index];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['contatos'][$index]['nome'] = $_POST['nome'];
    $_SESSION['contatos'][$index]['email'] = $_POST['email'];
    $_SESSION['contatos'][$index]['telefone'] = $_POST['telefone'];
    $_SESSION['contatos'][$index]['endereco'] = $_POST['endereco'];
    
    echo "Contato atualizado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contato</title>
    <link rel="stylesheet" href="css/editarcontato.css">
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
                <li><a href="./login.php" class="link" aria-label="Logout"><i class="fas fa-user-slash"></i> Sair</a></li>    
                <li><a href="./ajuda.html" class="link" aria-label="Ajuda"><i class="fas fa-question-circle"></i> Ajuda</a></li>                
            </ul>
        </nav>
    </header>
    <h1>Editar Contato</h1>
    <form action="editarcontato.php?index=<?php echo $index; ?>" method="post">
        Nome: <input type="text" name="nome" value="<?php echo $contato['nome']; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $contato['email']; ?>" required><br>
        Telefone: <input type="text" name="telefone" value="<?php echo $contato['telefone']; ?>" required><br>
        Endereço: <input type="text" name="endereco" value="<?php echo $contato['endereco']; ?>" required><br>
        <input type="submit" value="Atualizar Contato">
    </form>
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
                <a href="#" class="explorar">Cadastro</a><br>
                <a href="" class="explorar">Login</a><br>
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
