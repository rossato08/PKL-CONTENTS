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
<link rel="stylesheet" href="./css/informacoescontato">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Contato</title>
</head>
<body>
    <h1>Informações do Contato</h1>
    <p><strong>Nome:</strong> <?php echo $contato['nome']; ?></p>
    <p><strong>Email:</strong> <?php echo $contato['email']; ?></p>
    <p><strong>Telefone:</strong> <?php echo $contato['telefone']; ?></p>
    <p><strong>Endereço:</strong> <?php echo $contato['endereco']; ?></p>

    <p><a href="listadecontatos.php">Voltar para a lista de contatos</a></p>
</body>
</html>
