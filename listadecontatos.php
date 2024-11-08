<?php
session_start();

// Verifica se existem contatos na sessão
if (!isset($_SESSION['contatos']) || empty($_SESSION['contatos'])) {
    echo "Não há contatos cadastrados.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contatos</title>
    <style>
        /* Seus estilos CSS */
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <?php require 'navbarpkl.php'; ?>

    <h1>Lista de Contatos</h1>

    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Endereço</th>
        </tr>
        <?php foreach ($_SESSION['contatos'] as $contato): ?>
        <tr>
            <td><?php echo htmlspecialchars($contato['nome']); ?></td>
            <td><?php echo htmlspecialchars($contato['email']); ?></td>
            <td><?php echo htmlspecialchars($contato['telefone']); ?></td>
            <td><?php echo htmlspecialchars($contato['endereco']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <p><a href="addctt.php">Adicionar novo contato</a></p>
</body>
</html>
