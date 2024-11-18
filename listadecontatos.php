<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_email'])) {
    header("Location: login.php");
    exit;
}

// Obter o e-mail do usuário logado e definir o arquivo de contatos
$email_usuario = $_SESSION['usuario_email'];
$arquivo_contatos = 'contatos/' . str_replace(['@', '.'], '_', $email_usuario) . '_contatos.txt';

// Verificar se o arquivo de contatos existe
$contatos = [];
if (file_exists($arquivo_contatos)) {
    $linhas = file($arquivo_contatos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($linhas as $linha) {
        $dados = explode('|', $linha);
        $contatos[] = [
            'nome' => $dados[0] ?? '',
            'telefone' => $dados[1] ?? '',
            'email' => $dados[2] ?? '',
            'endereco' => $dados[3] ?? ''
        ];
    }
}

// Excluir contato
if (isset($_GET['excluir'])) {
    $indice = (int)$_GET['excluir'];
    if (isset($contatos[$indice])) {
        unset($contatos[$indice]);
        // Atualizar o arquivo
        $novas_linhas = [];
        foreach ($contatos as $contato) {
            $novas_linhas[] = implode('|', $contato);
        }
        file_put_contents($arquivo_contatos, implode(PHP_EOL, $novas_linhas) . PHP_EOL);
        header("Location: listadecontatos.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contatos - PKL Contacts</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e9f5ff;
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        header {
            background-color: #6f42c1;
            color: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }
        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin: 10px 0;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }
        nav ul li a:hover {
            color: #ffcc00;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #6f42c1;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            color: white;
        }
        .btn-editar {
            background-color: #007bff;
        }
        .btn-excluir {
            background-color: #dc3545;
        }
        .btn:hover {
            opacity: 0.8;
        }
       /* Reset básico */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
body {
    font-family: 'Helvetica Neue', Arial, sans-serif;
    background-color: #e9f5ff;
    color: #333;
    line-height: 1.6;
    text-align: center; /* Centraliza o texto em todo o corpo */
}

/* Cabeçalho */
.cabecalho {
    color: white;
    padding: 30px;
    background-color: #6f42c1; /* Roxo */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease;
}
.cabecalho:hover {
    background-color: #5a34a3; /* Roxo escuro ao passar o mouse */
}
.titulo.logo {
    font-size: 3rem; /* Tamanho maior */
    font-weight: bold; /* Deixa a fonte mais forte */
    background: linear-gradient(45deg, #ffffff, #ffffff); /* Gradiente de cor */
    -webkit-background-clip: text; /* Faz o gradiente aplicar no texto */
    color: transparent; /* Torna o fundo transparente para mostrar o gradiente */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Sombra suave no texto */
    letter-spacing: 2px; /* Espaçamento entre as letras */
    animation: animarLogo 1.5s ease-out forwards; /* Animação do nome */
}
/* Animação do nome */
@keyframes animarLogo {
    0% {
        transform: translateY(-50px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}
/* Efeito hover */
.titulo.logo:hover {
    transform: scale(1.1); /* Aumenta o tamanho quando o mouse passa */
    text-shadow: 4px 4px 10px rgba(0, 0, 0, 0.3); /* Aumenta a sombra */
}
/* Navegação */
.navegacao ul {
    list-style-type: none;
    padding: 0;
    display: flex;
    justify-content: center; /* Centraliza os itens na barra de navegação */
    align-items: center;
}
.navegacao li {
    margin: 0 20px; /* Espaçamento entre os itens */
    position: relative; /* Para criar um efeito de underline animado */
}
.link {
    color: #fff;
    text-decoration: none;
    font-size: 1.2rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    padding: 8px 10px;
    transition: all 0.3s ease;
    position: relative;
}
.link i {
    margin-right: 8px; /* Espaçamento entre ícone e texto */
    font-size: 1.4rem;
    transition: transform 0.3s ease;
}
.link:hover {
    color: #ffffff; /* Cor ao passar o mouse */
    transform: scale(1.05); /* Leve aumento no tamanho ao passar o mouse */
}
.link:hover i {
    transform: translateX(5px); /* Animação suave para o ícone */
}
/* Underline animado */
.link::before {
    content: '';
    position: absolute;
    width: 0;
    height: 3px;
    background-color: #ffcc00;
    bottom: 0;
    left: 50%;
    transition: width 0.3s ease, left 0.3s ease;
}
.link:hover::before {
    width: 100%;
    left: 0;
}
/* Efeitos para links em foco ou clicados */
.link:focus, .link:active {
    color: #ffcc00;
    outline: none; /* Remove o contorno padrão ao clicar */
}
/* Conteúdo */
.conteudo {
    padding: 40px;
    text-align: center; /* Garante que o conteúdo seja centralizado */
}
.secao {
    margin: 20px auto;
    padding: 30px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    transition: transform 0.3s, box-shadow 0.3s;
}
.secao:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}
.subtitulo {
    font-size: 1.8rem;
    margin-bottom: 10px;
    color: #6f42c1; /* Roxo */
}
.descricao {
    font-size: 1.2rem;
    margin-bottom: 20px;
    color: #555;
}
.botao {
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    background-color: #6f42c1; /* Roxo */
    transition: background-color 0.3s, transform 0.3s;
}
.botao:hover {
    background-color: #5a34a3; /* Roxo escuro ao passar o mouse */
    transform: scale(1.05);
}
/* Grid de recursos */
.grid-recursos {
    display: flex;
    justify-content: center; /* Centraliza os itens na grid */
    flex-wrap: wrap; /* Permite que os itens se movam para a próxima linha se necessário */
}
.recurso {
    margin: 10px; /* Adiciona margem entre os recursos */
    padding: 20px;
    border-radius: 5px;
    background-color: #f7f7f7;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
    max-width: 250px; /* Largura máxima para os recursos */
}
/* Testemunhos */
.testemunho {
    background-color: #f0f8ff;
    border-left: 5px solid #6f42c1; /* Roxo */
    padding: 15px;
    margin: 10px 0;
    font-style: italic;
}
/* Rodapé */
.rodape {
    background-color: #333;
    padding: 1px;
    position: relative;
    width: 100%;
}
.texto-rodape {
    margin: 10px;
    color: #f7f7f7;
    text-align: center;
}
.cardrodape{
    display: flex;
    background-color: #333;
    padding: 15px;
    width: 260px;
    height: 250px;
     border-color: #333;
     font-size:larger;
}
.cardrodape img{
    width: 50px;
    height: 50px;
}

.card-titulo{
   color: #ffffff;
   text-decoration:underline;
   text-decoration-color:#ffcc00 ;
}
.cards{
    display: flex;
    justify-content: space-between;
}
.explorar{
    font-size: large;
    text-align: start;
    text-decoration:none;
    color: #f0f8ff;
}
a:hover {
    transform: scale(2.0); 
}
a::before {
    content: '';
    position: absolute;
    width: 0;
    height: 3px;
    background-color: #ffcc00;
    bottom: 0;
    left: 50%;
    transition: width 0.3s ease, left 0.3s ease;
}
a:hover::before {
    width: 100%;
    left: 0;
}
a:focus, a:active {
    color: #ffcc00;
    outline: none; 
}
    </style>
</head>
<body>
<!--cabeçalho-->
<header class="cabecalho">
        <nav class="navegacao">
            <ul>
                <li><a href="./index.html" class="link" aria-label="Início"><i class="fas fa-home"></i> Início</a></li>
                <li><a href="./addctt.php" class="link" aria-label="Adicionar Contato"><i class="fas fa-user-plus"></i>Adicionar Contato</a></li>
                <li><a href="./listadecontatos.php" class="link" aria-label="Lista de Contatos"><i class="fas fa-list"></i> Lista de Contatos</a></li>
                <li><a href="./cadastro.php" class="link" aria-label="Cadastro"><i class="fas fa-sign-in-alt"></i> Cadastro</a></li>
                <li><a href="./logout.php" class="link" aria-label="Login"><i class="fas fa-user-slash"></i> Sair</a></li>    
                <li><a href="./ajuda.html" class="link" aria-label="Ajuda"><i class="fas fa-question-circle"></i> Ajuda</a></li>                
            </ul>
        </nav>
    </header>

<?php if (!empty($contatos)): ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contatos as $indice => $contato): ?>
                <tr>
                    <td><?php echo htmlspecialchars($contato['nome']); ?></td>
                    <td><?php echo htmlspecialchars($contato['telefone']); ?></td>
                    <td><?php echo htmlspecialchars($contato['email']); ?></td>
                    <td><?php echo htmlspecialchars($contato['endereco']); ?></td>
                    <td>
                        <a class="btn btn-editar" href="editarcontato.php?indice=<?php echo $indice; ?>">Editar</a>
                        <a class="btn btn-excluir" href="listadecontatos.php?excluir=<?php echo $indice; ?>" onclick="return confirm('Tem certeza que deseja excluir este contato?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Nenhum contato encontrado. Adicione um novo contato!</p>
<?php endif; ?>

<!-- Rodape -->
<footer class="rodape">
        <div class="cards">
        <div class="cardrodape">
            <div class="contatos">
                <p class="card-titulo">Nos siga</p>
                <a href="#" class="link"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="#" class="link"><i class="fab fa-facebook"></i> Facebook</a>
                <a href="#" class="link"><i class="fab fa-linkedin"></i> Linkedin</a>
            </div>
        </div>
        <div class="cardrodape">
            <div class="contatos">
                <p class="card-titulo">Explorar</p>
                <a href="./index.html" class="explorar">Início</a><br>
                <a href="./addctt.php" class="explorar">Adicionar contato</a><br>
                <a href="./listadecontatos.php" class="explorar">Lista de Contatos</a><br>
                <a href="#" class="explorar">Cadastro</a><br>
                <a href="" class="explorar">Login</a><br>
                <a href="./ajuda.html" class="explorar">Ajuda</a>
            </div>
        </div>
        <div class="cardrodape">
            <div class="contatos">
                <p class="card-titulo">Fale conosco </p>
                <a href="#" class="link"><i class="far fa-envelope"></i> E-mail</a>
                <a href="#" class="link"><i class="fab fa-whatsapp"></i> Whatsapp</a>
            </div>
        </div>
    </div>
    <p class="texto-rodape">© 2024 Gerenciamento de Contatos. Todos os direitos reservados para PKL contacts.</p>
    </footer>
</body>
</html>
