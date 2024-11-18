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
/* Estilos gerais */
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 20px;
    color: #333;
    text-align: center;
}
h1 {
    color: #6f42c1;
    font-size: 2rem;
    margin-bottom: 20px;
}

/* Estilos da tabela */
table {
    width: 80%;
    margin: 0 auto;
    border-collapse: collapse;
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}
th, td {
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
    text-align: left;
    font-size: 1rem;
}

/* Estilos para o cabeçalho da tabela */
th {
    background-color: #6f42c1;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
}
/* Linhas alternadas */
tr:nth-child(even) {
    background-color: #f9f9f9;
}
/* Estilos para a linha ao passar o mouse */
tr:hover {
    background-color: #f1f1f1;
}
/* Link para ver detalhes do contato */
a {
    color: #6f42c1;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}
a:hover {
    color: #5a34a3;
    text-decoration: underline;
}
/* Estilos para o botão "Adicionar novo contato" */
p a {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #6f42c1;
    color: #ffffff;
    border-radius: 5px;
    text-transform: uppercase;
    font-size: 1rem;
    font-weight: bold;
    transition: background-color 0.3s, transform 0.3s;
}
p a:hover {
    background-color: #5a34a3;
    transform: scale(1.05);
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
    <h1>Informações do Contato</h1>
    <p><strong>Nome:</strong> <?php echo $contato['nome']; ?></p>
    <p><strong>Email:</strong> <?php echo $contato['email']; ?></p>
    <p><strong>Telefone:</strong> <?php echo $contato['telefone']; ?></p>
    <p><strong>Endereço:</strong> <?php echo $contato['endereco']; ?></p>

    <p><a href="listadecontatos.php">Voltar para a lista de contatos</a></p>
</body>
</html>
