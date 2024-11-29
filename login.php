<?php 
// Inicia a sessão para armazenar informações do usuário durante a navegação
session_start();

// Configura o PHP para exibir todos os erros, exceto avisos (warnings) e notificações
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

// Verifica se o método de requisição é POST (o formulário foi enviado)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados enviados pelo formulário (email e senha)
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Lê os dados dos usuários armazenados no arquivo 'usuarios.txt'
    // Cada linha do arquivo representa um usuário com os dados separados por '|'
    $usuarios = file('usuarios.txt', FILE_IGNORE_NEW_LINES);

    // Inicializa a variável de erro como vazia
    $erro = "";

    // Variável para indicar se o login é válido
    $loginValido = false;

    // Percorre todos os usuários armazenados no arquivo
    foreach ($usuarios as $usuario) {
        // Divide os dados do usuário em variáveis separadas
        list($nome, $sobrenome, $cpf, $email_armazenado, $senha_armazenada) = explode('|', $usuario);

        // Verifica se o email e a senha informados coincidem com os armazenados
        if ($email_armazenado === $email && $senha_armazenada === $senha) {
            // Se o login for válido, armazena o email do usuário na sessão
            $_SESSION['usuario_email'] = $email;

            // Redireciona o usuário para a página de lista de contatos
            header("Location: listadecontatos.php");
            exit; // Encerra o script para evitar processamento adicional
        }
    }

    // Caso nenhum usuário corresponda, define a mensagem de erro
    $erro = "E-mail ou senha incorretos!";
}
?>

<!-- HTML para a página de login -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Configuração do cabeçalho -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PKL Contacts</title>
    <!-- Importação de estilos e ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="testes.css">
</head>
<body>
    <!-- Cabeçalho com navegação -->
    <header class="cabecalho">
        <nav class="navegacao">
            <ul>
                <!-- Links para outras páginas do sistema -->
                <li><a href="./index.html" class="link" aria-label="Início"><i class="fas fa-home"></i> Início</a></li>
                <li><a href="./addctt.php" class="link" aria-label="Adicionar Contato"><i class="fas fa-user-plus"></i> Adicionar Contato</a></li>
                <li><a href="./listadecontatos.php" class="link" aria-label="Lista de Contatos"><i class="fas fa-list"></i> Lista de Contatos</a></li>
                <li><a href="./cadastro.php" class="link" aria-label="Cadastro"><i class="fas fa-sign-in-alt"></i> Cadastro</a></li>
                <li><a href="./logout.php" class="link" aria-label="Logout"><i class="fas fa-user-slash"></i> Sair</a></li>    
                <li><a href="./ajuda.html" class="link" aria-label="Ajuda"><i class="fas fa-question-circle"></i> Ajuda</a></li>                
            </ul>
        </nav>
    </header>

    <!-- Formulário de login -->
    <div class="formulario">
        <h1>Login</h1> <br>
        <form action="login.php" method="POST">
            <!-- Campo para o email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>
            </div>
            <!-- Campo para a senha -->
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required><br>
            </div>
            
            <!-- Exibição de mensagem de erro, se houver -->
            <?php if (isset($erro) && !empty($erro)): ?>
                <div class="mensagem-erro">
                    <?php echo $erro; ?>
                </div>
            <?php endif; ?>

            <!-- Link para cadastro -->
            <div class="naotemcad">
                <p>Não tem cadastro? <a href="./cadastro.php">Cadastre-se</a></p>
            </div>
            <!-- Botão de envio -->
            <button class="botao" type="submit">Entrar</button>
        </form>
    </div>

    <!-- Rodapé -->
    <footer class="rodape">
        <div class="cards">
            <!-- Card com links sociais -->
            <div class="cardrodape">
                <div class="contatos">
                    <p class="card-titulo">Nos siga</p>
                    <a href="#" class="link"><i class="fab fa-instagram"></i> Instagram</a>
                    <a href="#" class="link"><i class="fab fa-facebook"></i> Facebook</a>
                    <a href="#" class="link"><i class="fab fa-linkedin"></i> Linkedin</a>
                </div>
            </div>
            <!-- Card com links do site -->
            <div class="cardrodape">
                <div class="contatos">
                    <p class="card-titulo">Explorar</p>
                    <a href="./index.html" class="explorar">Início</a><br>
                    <a href="./addctt.php" class="explorar">Adicionar contato</a><br>
                    <a href="./listadecontatos.php" class="explorar">Lista de Contatos</a><br>
                    <a href="./cadastro.php" class="explorar">Cadastro</a><br>
                    <a href="./login.php" class="explorar">Login</a><br>
                    <a href="./ajuda.html" class="explorar">Ajuda</a>
                </div>
            </div>
            <!-- Card com contatos -->
            <div class="cardrodape">
                <div class="contatos">
                    <p class="card-titulo">Fale conosco </p>
                    <a href="#" class="link"><i class="far fa-envelope"></i> E-mail</a>
                    <a href="#" class="link"><i class="fab fa-whatsapp"></i> Whatsapp</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
