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
    foreach ($linhas as $linha) {
        $dados = explode('|', $linha);
        $contatos[] = [
            'nome' => $dados[0] ?? '',
            'telefone' => $dados[1] ?? '',
            'email' => $dados[2] ?? '',
            'endereco' => $dados[3] ?? ''
        ];
    }
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
    <style>
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
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #6f42c1;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            color: white;
        }
        .btn-editar {
            background-color: #007bff;
        }
        .btn-excluir {
            background-color: #dc3545;
        }
        .btn:hover {
            opacity: 0.8;
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
    <h1>Lista de Contatos</h1>
    <nav>
        <ul>
            <li><a href="./index.html">Início</a></li>
            <li><a href="./addctt.php">Adicionar Contato</a></li>
            <li><a href="./logout.php">Sair</a></li>
        </ul>
    </nav>
</header>

<?php if (!empty($contatos)): ?>
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
                    <td>
                        <a class="btn btn-editar" href="editarcontato.php?indice=<?php echo $indice; ?>">Editar</a>
                        <a class="btn btn-excluir" href="listadecontatos.php?excluir=<?php echo $indice; ?>" onclick="return confirm('Tem certeza que deseja excluir este contato?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Nenhum contato encontrado. Adicione um novo contato!</p>
<?php endif; ?>

<footer>
    <p>© 2024 Gerenciamento de Contatos. Todos os direitos reservados para PKL Contacts.</p>
</footer>
</body>
</html>
