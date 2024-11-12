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
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contatos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Estilos gerais */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            color: #333;
            text-align: center;
        }

        h1 {
            color: #6f42c1;
            font-size: 2rem;
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

        /* Estilos para o cabeçalho da tabela */
        th {
            background-color: #6f42c1;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Linhas alternadas */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Estilos para a linha ao passar o mouse */
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

        /* Estilos para o botão "Adicionar novo contato" */
        .add-contact-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #6f42c1;
            color: #ffffff;
            border-radius: 5px;
            text-transform: uppercase;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
            text-decoration: none;
        }

        .add-contact-btn:hover {
            background-color: #5a34a3;
            transform: scale(1.05);
        }
    </style>
</head>


<body>

<?php
    //cabeçalho
require 'navbarpkl.php';
?>
</header>


    <h1>Lista de Contatos (Total: <?php echo $totalContatos; ?>)</h1> <!-- Exibe o total de contatos -->
    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th>Ações</th>
        </tr>
        <?php
        // Usa o total de contatos como limite no loop `for`
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

    <p><a href="addctt.php" class="add-contact-btn">Adicionar novo contato</a></p>
</body>
</html>
