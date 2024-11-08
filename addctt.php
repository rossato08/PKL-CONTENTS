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
    <!-- Link para o Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<header>
<?php
require 'navbarpkl.php';
?>
</header>
<body>
    <!-- cabeçalho -->
<header class="cabecalho">
        <h1 class="titulo logo animar">PKL Contacts</h1>
        <nav class="navegacao">
            <ul>
                <li><a href="./index.html" class="link" aria-label="Início"><i class="fas fa-home"></i> Início</a></li>
                <li><a href="./addctt.php" class="link" aria-label="Adicionar Contato"><i class="fas fa-user-plus"></i>
                        Adicionar Contato</a></li>
                <li><a href="./listadecontatos.php" class="link" aria-label="Lista de Contatos"><i
                            class="fas fa-list"></i> Lista de Contatos</a></li>
                <li><a href="#" class="link" aria-label="Cadastro"><i class="fas fa-sign-in-alt"></i> Cadastro</a></li>
                <li><a href="./ajuda.html" class="link" aria-label="Ajuda"><i class="fas fa-question-circle"></i>
                        Ajuda</a></li>
            </ul>
        </nav>
    </header>
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
