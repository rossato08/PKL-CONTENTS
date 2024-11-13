<?php
session_start();

// Verifica se existem contatos na sessão
if (!isset($_SESSION['contatos']) || empty($_SESSION['contatos'])) {
    $semContatos = true;
} else {
    $semContatos = false;
    $totalContatos = count($_SESSION['contatos']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contatos</title>
    <style>
        /* Estilos gerais */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #6f42c1;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        /* Estilos para a mensagem "Sem Contatos" */
        .no-contacts {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 60vh;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #555;
        }

        .no-contacts h2 {
            font-size: 1.5rem;
            color: #6f42c1;
            margin-bottom: 15px;
        }

        .no-contacts p {
            font-size: 1rem;
            margin-bottom: 20px;
        }

        /* Estilos da tabela */
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            font-size: 1rem;
        }

        th {
            background-color: #6f42c1;
            color: white;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Link para ver detalhes do contato */
        a {
            color: #6f42c1;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        a:hover {
            color: #5a34a3;
            text-decoration: underline;
        }

        /* Botão "Adicionar novo contato" */
        .add-contact-btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #6f42c1;
            color: #ffffff;
            border-radius: 5px;
            text-transform: uppercase;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
            text-decoration: none;
            margin-top: 20px;
        }

        .add-contact-btn:hover {
            background-color: #5a34a3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <?php if ($semContatos): ?>
        <div class="no-contacts">
            <h2>Nenhum contato cadastrado</h2>
            <p>Parece que você ainda não adicionou nenhum contato à sua lista.</p>
            <a href="addctt.php" class="add-contact-btn">Adicionar novo contato</a>
        </div>
    <?php else: ?>
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
                    <a href="informacoescontato.php?index=<?php echo $index; ?>">Ver detalhes</a>
                </td>
            </tr>
            <?php endfor; ?>
        </table>
        <p><a href="addctt.php" class="add-contact-btn">Adicionar novo contato</a></p>
    <?php endif; ?>
</body>
</html>
