<?php
// Inicializa o array de contatos em uma variável de sessão ou arquivo
session_start();

if (!isset($_SESSION['contatos'])) {
    $_SESSION['contatos'] = []; // Se não existir, inicializa o array de contatos
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    // Cria um array associativo com os dados do contato
    $contato = [
        'nome' => $nome,
        'email' => $email,
        'telefone' => $telefone,
        'endereco' => $endereco
    ];

    // Adiciona o novo contato ao array de contatos
    $_SESSION['contatos'][] = $contato;

    // Feedback de sucesso
    echo "Contato adicionado com sucesso!";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Contato</title>
    <link rel="stylesheet" href="addctt.css">
    <!-- Link para o Font Awesome -->
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
/* Estilos para o formulário */
form {
    max-width: 500px;
    margin: 30px auto;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    text-align: left;
}
/* Estilos para os campos de entrada */
form input[type="text"],
form input[type="email"],
form input[type="tel"],
form input[type="address"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
    transition: border-color 0.3s;
}
/* Efeito de foco nos campos de entrada */
form input[type="text"]:focus,
form input[type="email"]:focus,
form input[type="tel"]:focus,
form input[type="address"]:focus {
    border-color: #6f42c1; /* Roxo ao focar */
    outline: none;
    box-shadow: 0 0 5px rgba(111, 66, 193, 0.3);
}

/* Estilos para o botão de envio */
form input[type="submit"] {
    width: 100%;
    background-color: #6f42c1;
    color: white;
    padding: 12px 0;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    text-transform: uppercase;
    transition: background-color 0.3s, transform 0.3s;
}
/* Efeito hover e clique no botão de envio */
form input[type="submit"]:hover {
    background-color: #5a34a3;
    transform: scale(1.02);
}
form input[type="submit"]:active {
    background-color: #4e2d8a;
    transform: scale(0.98);
}
/* Ajuste do título do formulário */
h1 {
    font-size: 2rem;
    color: #6f42c1;
    text-align: center;
    margin-bottom: 20px;
}
/* Rodapé */
.rodape {
    background-color: #333;
    padding: 15px 0;
    position: relative;
    width: 100%;
}

.texto-rodape {
    margin: 15px;
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
}
.explorar{
    text-align: start;
    text-decoration:none;
    color: #f0f8ff;
}
.cards{
    display: flex;
}
</style>
</head>
<header>
<?php
    //cabeçalho
require 'navbarpkl.php';
?>
</header>
<body>
  <!-- form -->
    <h1>Adicionar Contato</h1>
    <form action="addctt.php" method="post">
        Nome: <input type="text" name="nome" required><br>
        Email: <input type="email" name="email" required><br>
        Telefone: <input type="text" name="telefone" required><br>
        Endereço: <input type="text" name="endereco" required><br>
        <input type="submit" value="Adicionar Contato">
    </form>
</body>
</html>
