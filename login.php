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
     <!-- Link para o Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="testes.css">
    <!--css-->
    <style>
        /* Reset básico */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
body {
    font-family: 'Helvetica Neue', Arial, sans-serif;
    background-color: #e9f5ff;
    color: #333;
    line-height: 1.6;
    text-align: center; /* Centraliza o texto em todo o corpo */
}
/* Cabeçalho */
.cabecalho {
    color: white;
    padding: 30px;
    background-color: #6f42c1; /* Roxo */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease;
}
.cabecalho:hover {
    background-color: #5a34a3; /* Roxo escuro ao passar o mouse */
}
.titulo.logo {
    font-size: 3rem; /* Tamanho maior */
    font-weight: bold; /* Deixa a fonte mais forte */
    background: linear-gradient(45deg, #ffffff, #ffffff); /* Gradiente de cor */
    -webkit-background-clip: text; /* Faz o gradiente aplicar no texto */
    color: transparent; /* Torna o fundo transparente para mostrar o gradiente */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Sombra suave no texto */
    letter-spacing: 2px; /* Espaçamento entre as letras */
    animation: animarLogo 1.5s ease-out forwards; /* Animação do nome */
}
/* Animação do nome */
@keyframes animarLogo {
    0% {
        transform: translateY(-50px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}
/* Efeito hover */
.titulo.logo:hover {
    transform: scale(1.1); /* Aumenta o tamanho quando o mouse passa */
    text-shadow: 4px 4px 10px rgba(0, 0, 0, 0.3); /* Aumenta a sombra */
}
/* Navegação */
.navegacao ul {
    list-style-type: none;
    padding: 0;
    display: flex;
    justify-content: center; /* Centraliza os itens na barra de navegação */
    align-items: center;
}
.navegacao li {
    margin: 0 20px; /* Espaçamento entre os itens */
    position: relative; /* Para criar um efeito de underline animado */
}
.link {
    color: #fff;
    text-decoration: none;
    font-size: 1.2rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    padding: 8px 10px;
    transition: all 0.3s ease;
    position: relative;
}
.link i {
    margin-right: 8px; /* Espaçamento entre ícone e texto */
    font-size: 1.4rem;
    transition: transform 0.3s ease;
}
.link:hover {
    color: #ffffff; /* Cor ao passar o mouse */
    transform: scale(1.05); /* Leve aumento no tamanho ao passar o mouse */
}
.link:hover i {
    transform: translateX(5px); /* Animação suave para o ícone */
}
/* Underline animado */
.link::before {
    content: '';
    position: absolute;
    width: 0;
    height: 3px;
    background-color: #ffcc00;
    bottom: 0;
    left: 50%;
    transition: width 0.3s ease, left 0.3s ease;
}
.link:hover::before {
    width: 100%;
    left: 0;
}
/* Efeitos para links em foco ou clicados */
.link:focus, .link:active {
    color: #ffcc00;
    outline: none; /* Remove o contorno padrão ao clicar */
}
/* Conteúdo */
.conteudo {
    padding: 40px;
    text-align: center; /* Garante que o conteúdo seja centralizado */
}
.secao {
    margin: 20px auto;
    padding: 30px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    transition: transform 0.3s, box-shadow 0.3s;
}
.secao:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}
.subtitulo {
    font-size: 1.8rem;
    margin-bottom: 10px;
    color: #6f42c1; /* Roxo */
}
.descricao {
    font-size: 1.2rem;
    margin-bottom: 20px;
    color: #555;
}
.botao {
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    background-color: #6f42c1; /* Roxo */
    transition: background-color 0.3s, transform 0.3s;
}
.botao:hover {
    background-color: #5a34a3; /* Roxo escuro ao passar o mouse */
    transform: scale(1.05);
}
/* Grid de recursos */
.grid-recursos {
    display: flex;
    justify-content: center; /* Centraliza os itens na grid */
    flex-wrap: wrap; /* Permite que os itens se movam para a próxima linha se necessário */
}
.recurso {
    margin: 10px; /* Adiciona margem entre os recursos */
    padding: 20px;
    border-radius: 5px;
    background-color: #f7f7f7;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
    max-width: 250px; /* Largura máxima para os recursos */
}
/* Testemunhos */
.testemunho {
    background-color: #f0f8ff;
    border-left: 5px solid #6f42c1; /* Roxo */
    padding: 15px;
    margin: 10px 0;
    font-style: italic;
}
/* Rodapé */
.rodape{
 background-color: #333;
 padding: 1px;
 position: relative;
 width: 100%;
 top: 150px;
}
.texto-rodape {
    margin: 10px;
    color: #f7f7f7;
    text-align: center;
}
.cardrodape{
    display: flex;
    background-color: #333;
    padding: 15px;
    width: 260px;
    height: 250px;
     border-color: #333;
     font-size:larger;
}
.cardrodape img{
    width: 50px;
    height: 50px;
}

.card-titulo{
   color: #ffffff;
   text-decoration:underline;
   text-decoration-color:#ffcc00 ;
}
.cards{
    display: flex;
    justify-content: space-between;
}
.explorar{
    font-size: large;
    text-align: start;
    text-decoration:none;
    color: #f0f8ff;
}
a:hover {
    transform: scale(2.0); 
}
a::before {
    content: '';
    position: absolute;
    width: 0;
    height: 3px;
    background-color: #ffcc00;
    bottom: 0;
    left: 50%;
    transition: width 0.3s ease, left 0.3s ease;
}
a:hover::before {
    width: 100%;
    left: 0;
}
a:focus, a:active {
    color: #ffcc00;
    outline: none; 
}
.formulario {
 padding-top: 80px;
 padding-bottom: 100px;
text-align: center;
 }
.botao{
 width: 150px;
 margin-top: 50px;
 }
 .form-group{
    padding-left:870px;
    text-align: center;
    padding-bottom: 50px;
 }
    </style>
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
<!--formulario-->
<div class="formulario">
<h1>Login</h1>
<form action="login.php" method="POST">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
    </div>
    <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>
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
