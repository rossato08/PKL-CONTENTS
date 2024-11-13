<?php 
session_start();

if (!isset($_SESSION['contatos'])) {
    $_SESSION['contatos'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $contato = [
        'nome' => $nome,
        'email' => $email,
        'telefone' => $telefone,
        'endereco' => $endereco
    ];

    $_SESSION['contatos'][] = $contato;

    echo "Contato adicionado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Contato</title>
    <link rel="stylesheet" href="css/addctt.css">
</head>
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
