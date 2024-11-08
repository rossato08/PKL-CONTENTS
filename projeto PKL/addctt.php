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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;            
            background-color: #f5f5f5;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto; 
        }

        input[type="text"], input[type="email"], input[type="tel"], input[type="address"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; 
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }


        </style>

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
