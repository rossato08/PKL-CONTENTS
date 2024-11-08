<?php
session_start();

// Verifica se existem contatos na sessão
if (!isset($_SESSION['contatos']) || empty($_SESSION['contatos'])) {
    echo "Não há contatos cadastrados.";
    exit;
}

// Conta o número de contatos
$totalContatos = count($_SESSION['contatos']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Lista de Contatos</title>
</head>
<body>
    <h1>Lista de Contatos (Total: <?php echo $totalContatos; ?>)</h1>
    <table border="1">
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th>Ações</th>
        </tr>
        <?php
        // Exibe cada contato com um link para os detalhes
        for ($index = 0; $index < $totalContatos; $index++): 
            $contato = $_SESSION['contatos'][$index];
        ?>
        <tr>
            <td><?php echo $contato['nome']; ?></td>
            <td><?php echo $contato['email']; ?></td>
            <td><?php echo $contato['telefone']; ?></td>
            <td><?php echo $contato['endereco']; ?></td>
            <td>
                <!-- Link para ver detalhes do contato -->
                <a href="informacoescontato.php?index=<?php echo $index; ?>">Ver detalhes</a>
            </td>
        </tr>
        <?php endfor; ?>
    </table>

    <p><a href="addctt.php">Adicionar novo contato</a></p>
</body>
</html>
