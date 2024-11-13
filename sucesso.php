<?php
session_start();



?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Contatos</title>
    <link rel="stylesheet" href="./css/index.css">
    <!-- Link para o Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <header class="cabecalho">
        <h1 class="titulo logo animar">PKL Contacts</h1>

        <nav class="navegacao">
            <ul>
                <li><a href="#" class="link" aria-label="Início"><i class="fas fa-home"></i> Início</a></li>
                <li><a href="./adicionarcontato.html" class="link" aria-label="Adicionar Contato"><i class="fas fa-user-plus"></i> Adicionar Contato</a></li>
                <li><a href="#" class="link" aria-label="Lista de Contatos"><i class="fas fa-list"></i> Lista de Contatos</a></li>
                <li><a href="cadastro.html" class="link" aria-label="Cadastro"><i class="fas fa-sign-in-alt"></i> Cadastro</a></li>
                <li><a href="#" class="link" aria-label="Ajuda"><i class="fas fa-question-circle"></i> Ajuda</a></li>

                <?php
                // Verifica se as chaves 'nome' e 'sobrenome' existem na sessão
                if (isset($_SESSION['usuario']['nome']) && isset($_SESSION['usuario']['sobrenome'])) {
                    // Exibe o nome e o sobrenome
                    echo   $_SESSION['usuario']['nome'] . ' ' ;
                    echo  $_SESSION['usuario']['sobrenome'];
                } else {
                    echo "Nome ou sobrenome não encontrado na sessão.";
                }

                ($_SESSION)['usuario']['nome'];
                ?>

            </ul>
        </nav>
    </header>

    <main class="conteudo">
        <section class="secao introducao">
            <h2 class="subtitulo">Bem-vindo ao seu gerenciador de contatos!</h2>
            <p class="descricao">Gerencie seus contatos de forma simples e rápida.</p>
            <a href="cadastro.html">
                <button class="botao">Começar</button>
            </a>
        </section>

        <section class="secao recursos">
            <h2 class="subtitulo">Recursos</h2>
            <div class="grid-recursos">
                <div class="recurso animar">
                    <h3>Adicionar Contatos</h3>
                    <p>✨ Adicione, edite e exclua contatos com facilidade.</p>
                </div>
                <div class="recurso animar">
                    <h3>Busca Rápida</h3>
                    <p>🔍 Busque contatos rapidamente.</p>
                </div>
            </div>
        </section>

        <section class="secao testemunhos">
            <h2 class="subtitulo">O que dizem nossos usuários</h2>
            <div class="lista-testemunhos">
                <blockquote class="testemunho">
                    "Esse gerenciador de contatos facilitou minha vida! Agora posso encontrar qualquer pessoa em segundos." – Ana Silva
                </blockquote>
                <blockquote class="testemunho">
                    "Simples e prático. Recomendo para todos!" – João Santos
                </blockquote>
            </div>
        </section>
    </main>

    <footer class="rodape">
        <p class="texto-rodape">© 2024 Gerenciamento de Contatos. Todos os direitos reservados para PKL contacts.</p>
    </footer>
</body>

</html>