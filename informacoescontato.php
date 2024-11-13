<?php
session_start();

if (!isset($_GET['index']) || !isset($_SESSION['contatos'][$_GET['index']])) {
    echo "Contato não encontrado.";
    exit;
}

$contato = $_SESSION['contatos'][$_GET['index']];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Contato</title>
    <link rel="stylesheet" href="css/informacoescontato.css">
</head>
<body>
    <h1>Informações do Contato</h1>
    <div class="container">
        <h2>Nome: <?php echo $contato['nome']; ?></h2>
        <p>Email: <?php echo $contato['email']; ?></p>
        <p>Telefone: <?php echo $contato['telefone']; ?></p>
        <p>Endereço: <?php echo $contato['endereco']; ?></p>
        <a href="listacontatos.php">Voltar para a lista</a>
    </div>
</body>
</html>
