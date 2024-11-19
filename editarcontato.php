<?php
session_start();

if (!isset($_SESSION['usuario_email'])) {
    header("Location: login.php");
    exit;
}

$email_usuario = $_SESSION['usuario_email'];
$arquivo_contatos = 'contatos/' . str_replace(['@', '.'], '_', $email_usuario) . '_contatos.txt';

$indice = (int)$_GET['indice'] ?? 0;

$contatos = file($arquivo_contatos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$dados = explode('|', $contatos[$indice] ?? '| | | ');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];

    $contatos[$indice] = implode('|', [$nome, $telefone, $email, $endereco]);
    file_put_contents($arquivo_contatos, implode(PHP_EOL, $contatos) . PHP_EOL);

    header("Location: listadecontatos.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Link para o Font Awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Editar Contato</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
   
        }
        header {
            background-color: #6f42c1;
            color: white;
            width: 100%;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            margin: 0;
            font-size: 2rem;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
       
        }
        form h2 {
            margin-top: 0;
            color: #6f42c1;
            text-align: center;
        }
        label {
            font-size: 1rem;
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
        }
        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            transition: background-color 0.3s ease;
        }
        .btn-salvar {
            background-color: #28a745;
        }
        .btn-salvar:hover {
            background-color: #218838;
        }
        .btn-cancelar {
            background-color: #dc3545;
        }
        .btn-cancelar:hover {
            background-color: #c82333;
        }
        footer {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #666;
        }
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
            text-align: center;
            /* Centraliza o texto em todo o corpo */
        }
        /* Cabeçalho */
        .cabecalho {
            color: white;
            padding: 30px;
            background-color: #6f42c1;
            /* Roxo */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }
        .cabecalho:hover {
            background-color: #5a34a3;
            /* Roxo escuro ao passar o mouse */
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
        /* Navegação */
        .navegacao ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: center;
            /* Centraliza os itens na barra de navegação */
            align-items: center;
        }
        .navegacao li {
            margin: 0 20px;
            /* Espaçamento entre os itens */
            position: relative;
            /* Para criar um efeito de underline animado */
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
            margin-right: 8px;
            /* Espaçamento entre ícone e texto */
            font-size: 1.4rem;
            transition: transform 0.3s ease;
        }
        .link:hover {
            color: #ffffff;
            /* Cor ao passar o mouse */
            transform: scale(1.05);
            /* Leve aumento no tamanho ao passar o mouse */
        }
        .link:hover i {
            transform: translateX(5px);
            /* Animação suave para o ícone */
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
        .link:focus,
        .link:active {
            color: #ffcc00;
            outline: none;
            /* Remove o contorno padrão ao clicar */
        }
        .botao {
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            background-color: #6f42c1;
            /* Roxo */
            transition: background-color 0.3s, transform 0.3s;
        }
        .botao:hover {
            background-color: #5a34a3;
            /* Roxo escuro ao passar o mouse */
            transform: scale(1.05);
        }
        /* Testemunhos */
        .testemunho {
            background-color: #f0f8ff;
            border-left: 5px solid #6f42c1;
            /* Roxo */
            padding: 15px;
            margin: 10px 0;
            font-style: italic;
        }
        /* Rodapé */
        .rodape {
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
        .cardrodape {
            display: flex;
            background-color: #333;
            padding: 15px;
            width: 260px;
            height: 250px;
            border-color: #333;
            font-size: larger;
        }
        .card-titulo {
            color: #ffffff;
            text-decoration: underline;
            text-decoration-color: #ffcc00;
        }
        .cards {
            display: flex;
            justify-content: space-between;
        }
        .explorar {
            font-size: large;
            text-align: start;
            text-decoration: none;
            color: #f0f8ff;
        }
        /*linha colorida*/
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
                <li><a href="./logout.php" class="link" aria-label="Login"><i class="fas fa-user-slash"></i> Sair</a></li>    
                <li><a href="./ajuda.html" class="link" aria-label="Ajuda"><i class="fas fa-question-circle"></i> Ajuda</a></li>                
            </ul>
        </nav>
    </header>
    <br> <br><br>
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
        <a href="listadecontatos.php" class="btn btn-cancelar" style="text-decoration: none; text-align: center;">Cancelar</a>
    </div>
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
