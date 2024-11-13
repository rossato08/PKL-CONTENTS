<?php
session_start();

if (!isset($_SESSION['contatos']) || empty($_SESSION['contatos'])) {
    echo "<p class='no-contacts'>Não há contatos cadastrados.</p>";
    exit;
}

$totalContatos = count($_SESSION['contatos']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contatos</title>
    <link rel="stylesheet" href="css/listacontatos.css">
</head>
<body>
    <h1>Lista de Contatos (Total: <?php echo $totalContatos; ?>)</h1>
    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th>Ações</th>
        </tr>
        <?php for ($index = 0; $index < $totalContatos; $index++): 
            $contato = $_SESSION['contatos'][$index];
        ?>
        <tr>
            <td><?php echo $contato['nome']; ?></td>
            <td><?php echo $contato['email']; ?></td>
            <td><?php echo $contato['telefone']; ?></td>
            <td><?php echo $contato['endereco']; ?></td>
            <td>
                <a href="informacoescontato.php?index=<?php echo $index; ?>">Ver detalhes</a> |
                <a href="editarcontato.php?index=<?php echo $index; ?>">Editar</a> |
                <a href="deletarcontato.php?index=<?php echo $index; ?>" onclick="return confirm('Tem certeza que deseja excluir este contato?');">Excluir</a>
            </td>
        </tr>
        <?php endfor; ?>
    </table>
    <p><a href="addctt.php">Adicionar novo contato</a></p>
</body>
</html>
