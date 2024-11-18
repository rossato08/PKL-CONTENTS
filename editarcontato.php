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
    </style>
</head>
<body>
<header>
    <h1>Editar Contato</h1>
</header>
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
<footer>
    <p>© 2024 Gerenciamento de Contatos. Todos os direitos reservados.</p>
</footer>
</body>
</html>
