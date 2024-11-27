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
            header("Location: listadecontatos.php");
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
     <!-- Link para o Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--css-->
    <link rel="stylesheet" href="testes.css">
    <link rel="stylesheet" href="./css/login.css">
 
<script>
// Efeito de digitação nos campos de entrada 
document.addEventListener("DOMContentLoaded", function() {
    const inputs = document.querySelectorAll(".form-control");
 
    inputs.forEach(input => {
        input.addEventListener("focus", function() {
            this.style.borderColor = "#00bcd4"; // Destaca a borda ao focar
        });
        input.addEventListener("blur", function() {
            this.style.borderColor = "#333"; // Restaura a borda ao desfocar
        });
    });
});
// Efeito de carregamento no botão (quando pressionado)
const botao = document.querySelector(".botao");
 
botao.addEventListener("click", function(e) {
    e.preventDefault();  // Previne o envio imediato do formulário
 
    const loadingText = "Carregando...";
    this.innerHTML = loadingText;
    this.disabled = true;  // Desabilita o botão
 
    // Simula um delay de carregamento
    setTimeout(() => {
        this.innerHTML = "Concluído";
        this.disabled = false;
        setTimeout(() => {
            this.innerHTML = "Enviar"; // Restaura o texto
        }, 1000);
    }, 2000); // Delay de 2 segundos
});
</script>
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
<!--formulario-->
<div class="formulario">
<h1>Login</h1> <br>
<form action="login.php" method="POST">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
    </div>
    <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>
    </div>
    <div class="naotemcad">
        <p>Não tem cadastro? <a href="./cadastro.php">Cadastre-se</a></p>
    </div>
    <button class="botao" type="submit">Entrar</button>
</form>
</div>
<?php if (isset($erro)): ?>
    <p style="color: red;"><?php echo $erro; ?></p>
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
