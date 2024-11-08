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

echo "<pre>";
// Mostra os dados da sessão (para depuração)
print_r($_SESSION['contatos']);
echo "</pre>";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Contato</title>
    <link rel="stylesheet" href="addctt.css">
</head>
<header>
<?php
require 'navbarpkl.php';
?>
</header>
<body>
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
