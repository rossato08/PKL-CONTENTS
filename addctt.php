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

// Criar o diretório de contatos, se não existir
if (!is_dir('contatos')) {
    mkdir('contatos', 0777, true);
}

// Processar o formulário de adição de contato
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);
    $email = trim($_POST['email']);
    $endereco = trim($_POST['endereco']);

    // Validar se todos os campos foram preenchidos
    if ($nome && $telefone && $email && $endereco) {
        // Salvar o contato no arquivo do usuário
        $contato = $nome . '|' . $telefone . '|' . $email . '|' . $endereco . PHP_EOL;
        file_put_contents($arquivo_contatos, $contato, FILE_APPEND);

        // Redirecionar para a lista de contatos após adicionar o contato
        header("Location: listadecontatos.php");
        exit;
    } else {
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
    <style>
        /* Estilo Geral */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e9f5ff;
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        header {
            background-color: #6f42c1;
            color: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }
        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin: 10px 0;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }
        nav ul li a:hover {
            color: #ffcc00;
        }
        .formulario {
            margin: 20px auto;
            padding: 20px;
            background: white;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .formulario h1 {
            color: #6f42c1;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .botao {
            background-color: #6f42c1;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .botao:hover {
            background-color: #5a34a3;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<header>
    <h1>PKL Contacts</h1>
    <nav>
        <ul>
            <li><a href="./index.html"><i class="fas fa-home"></i> Início</a></li>
            <li><a href="./addctt.php"><i class="fas fa-user-plus"></i> Adicionar Contato</a></li>
            <li><a href="./listadecontatos.php"><i class="fas fa-list"></i> Lista de Contatos</a></li>
            <li><a href="./logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
        </ul>
    </nav>
</header>

<div class="formulario">
    <h1>Adicionar Contato</h1>
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
        <button class="botao" type="submit">Adicionar Contato</button>
    </form>
    <?php if (isset($erro)): ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>
</div>

<footer>
    <p>© 2024 Gerenciamento de Contatos. Todos os direitos reservados para PKL Contacts.</p>
</footer>
</body>
</html>
