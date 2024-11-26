<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data-nascimento'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha']; // Senha original
    $senha_confirm = $_POST['confirmar-senha'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    // Verificar se as senhas coincidem
    if ($senha !== $senha_confirm) {
        echo "As senhas não coincidem!";
        exit;
    }
    // Verificar se o CPF já está cadastrado
    $usuarios = file('usuarios.txt', FILE_IGNORE_NEW_LINES); // Lê o arquivo de usuários
    foreach ($usuarios as $usuario) {
        list($nome_armazenado, $sobrenome_armazenado, $cpf_armazenado, $email_armazenado, $senha_armazenada) = explode('|', $usuario);
        if ($cpf_armazenado == $cpf) {
            echo "CPF já cadastrado!";
            exit;
        }
        if ($email_armazenado == $email) {
            echo "E-mail já cadastrado!";
            exit;
        }
    }

    // Criar dados de usuário no formato que será salvo no arquivo
    $dados_usuario = $nome . "|" . $sobrenome . "|" . $cpf . "|" . $email . "|" . $senha . "|" . $data_nascimento . "|" . $telefone . "|" . $cep . "|" . $endereco . "|" . $cidade . "|" . $estado . "\n";

    // Salvar no arquivo "usuarios.txt"
    file_put_contents("usuarios.txt", $dados_usuario, FILE_APPEND);

    echo "Cadastro realizado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <!-- Link para o Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <!-- CSS -->
    <link rel="stylesheet" href="testes.css">
<<<<<<< HEAD
    <!-- CSS -->
    <style>
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
            text-align: center;
            /* Centraliza o texto em todo o corpo */
            background:
                linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                /* sobreposição preta semitransparente */
                url('imgs/pl4.jpeg');
            /* imagem de fundo */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-color: #f0f0f0;
            /* Cor de fundo de reserva */
        }

        /* Cabeçalho */
        .cabecalho {
            color: white;
            padding: 30px;
            background-color: #6f42c1;
            /* Roxo */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .cabecalho:hover {
            background-color: #5a34a3;
            /* Roxo escuro ao passar o mouse */
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

        /* Navegação */
        .navegacao ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: center;
            /* Centraliza os itens na barra de navegação */
            align-items: center;
        }

        .navegacao li {
            margin: 0 20px;
            /* Espaçamento entre os itens */
            position: relative;
            /* Para criar um efeito de underline animado */
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
            margin-right: 8px;
            /* Espaçamento entre ícone e texto */
            font-size: 1.4rem;
            transition: transform 0.3s ease;
        }

        .link:hover {
            color: #ffffff;
            /* Cor ao passar o mouse */
            transform: scale(1.05);
            /* Leve aumento no tamanho ao passar o mouse */
        }

        .link:hover i {
            transform: translateX(5px);
            /* Animação suave para o ícone */
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
        .link:focus,
        .link:active {
            color: #ffcc00;
            outline: none;
            /* Remove o contorno padrão ao clicar */
        }

        .botao {
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            background-color: #6f42c1;
            /* Roxo */
            transition: background-color 0.3s, transform 0.3s;
        }

        .botao:hover {
            background-color: #5a34a3;
            /* Roxo escuro ao passar o mouse */
            transform: scale(1.05);
        }

        /* Testemunhos */
        .testemunho {
            background-color: #f0f8ff;
            border-left: 5px solid #6f42c1;
            /* Roxo */
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
            top: 150px;
        }

        .texto-rodape {
            margin: 10px;
            color: #f7f7f7;
            text-align: center;
        }

        .cardrodape {
            display: flex;
            background-color: #333;
            padding: 15px;
            width: 260px;
            height: 250px;
            border-color: #333;
            font-size: larger;
        }

        .card-titulo {
            color: #ffffff;
            text-decoration: underline;
            text-decoration-color: #ffcc00;
        }

        .cards {
            display: flex;
            justify-content: space-between;
        }

        .explorar {
            font-size: large;
            text-align: start;
            text-decoration: none;
            color: #f0f8ff;
        }

        /*linha colorida*/
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

        a:focus,
        a:active {
            color: #ffcc00;
            outline: none;
        }

        /*formulario*/
        .form {
            margin-top: 50px;
            padding-bottom: 100px;
            background-color: #ffff;
            border-radius: 18px #5a34a3;
            /* Roxo */
            padding: 20px;
            margin-left: 530px;
            font-style: italic;
            width: 750px;
            display: grid;
        }

        .form h1 {
            color: #6f42c1;
        }

        /* Estilo dos inputs */
        .form-group input[type="text"],
        .form-group input[type="tel"],
        .form-group input[type="date"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="cpf"] {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            color: #333;
            box-sizing: border-box;
            /* Garante que o padding seja contabilizado dentro da largura */
            transition: all 0.3s ease;
            /* Transição suave */
            position: relative;
        }

        /* Efeito de foco nos inputs */
        .form-group input[type="email"]:focus,
        .form-group input[type="password"]:focus,
        .form-group input[type="text"]:focus,
        .form-group input[type="tel"]:focus,
        .form-group input[type="date"]:focus {
            border-color: #5a34a3;
            /* Cor de foco */
            background-color: #fff;
            /* Cor de fundo ao focar */
            outline: none;
            /* Remove o contorno padrão do navegador */
            box-shadow: 0 0 8px rgba(0, 188, 212, 0.7);
            /* Efeito de sombra */
        }

        /* Estilo dos ícones de "input" (opcional, se você quiser usar ícones dentro do input) */
        .form-group input[type="email"]:before {
            content: '\f0e0';
            /* Ícone do email */
            font-family: FontAwesome;
            position: absolute;
            left: 15px;
            /* Ajusta a posição do ícone */
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #aaa;
        }

        .form-group input[type="password"]:before {
            content: '\f023';
            /* Ícone de cadeado para senha */
            font-family: FontAwesome;
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #aaa;
        }

        .form-group input[type="text"]:before {
            content: '\f007';
            /* Ícone de pessoa para nome/sobrenome */
            font-family: FontAwesome;
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #aaa;
        }

        .form-group input[type="tel"]:before {
            content: '\f095';
            /* Ícone de telefone */
            font-family: FontAwesome;
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #aaa;
        }

        .form-group input[type="date"]:before {
            content: '\f133';
            /* Ícone de calendário */
            font-family: FontAwesome;
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #aaa;
        }

        .form-group input[type="cpf"]:before {
            content: '\f0c0';
            /* Ícone de identidade, você pode mudar para o ícone de CPF se disponível */
            font-family: FontAwesome;
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #aaa;
        }

        /* Para o select (estado), você pode adicionar ícones também, caso deseje) */
        .form-group select:before {
            content: '\f0c0';
            /* Um ícone genérico, mas você pode alterar */
            font-family: FontAwesome;
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #aaa;
        }

        .form-group select {
            width: 225px;
            height: 52px;
            border-radius: 8px;
        }

        .botao {
            width: 140px;
            margin-right: 10px;
            margin-top: 20px;
        }

        /* Efeito de onda no botão */
        .botao::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.6s ease;
        }

        .botao:hover::before {
            transform: translate(-50%, -50%) scale(1);
        }

        .botao:hover {
            background: #ffcc00;
            /* Cor mais escura no hover, amarelo */
            transform: translateY(-3px);
            /* Efeito de elevação no hover */
        }
    </style>
    <script>
        // Efeito de digitação nos campos de entrada (Simula um texto sendo digitado)
        document.addEventListener("DOMContentLoaded", function() {
            const inputs = document.querySelectorAll(".form-control");

            inputs.forEach(input => {
                input.addEventListener("focus", function() {
                    this.style.borderColor = "#00bcd4"; // Destaca a borda ao focar
                });
                input.addEventListener("blur", function() {
                    this.style.borderColor = "#333"; // Restaura a borda ao desfocar
                });
            });
        });

        // Efeito de carregamento no botão (quando pressionado)
        const botao = document.querySelector(".botao");

        botao.addEventListener("click", function(e) {
            e.preventDefault(); // Previne o envio imediato do formulário

            const loadingText = "Carregando...";
            this.innerHTML = loadingText;
            this.disabled = true; // Desabilita o botão

            // Simula um delay de carregamento
            setTimeout(() => {
                this.innerHTML = "Concluído";
                this.disabled = false;
                setTimeout(() => {
                    this.innerHTML = "Enviar"; // Restaura o texto
                }, 1000);
            }, 2000); // Delay de 2 segundos
        });
    </script>
=======
    <link rel="stylesheet" href="./css/cadastro.css">
>>>>>>> 45c46e065972f90bbd6c7a869aa301a5383b8127
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
                <li><a href="./logout.php" class="link" aria-label="Logout"><i class="fas fa-user-slash"></i> Sair</a></li>
                <li><a href="./ajuda.html" class="link" aria-label="Ajuda"><i class="fas fa-question-circle"></i> Ajuda</a></li>
            </ul>
        </nav>
    </header>
    <!-- Formulario-->
    <div class="form">
        <h1>Cadastro de Usuário</h1><br><br>
        <form method="POST" action="cadastro.php">
            <div class="form-row">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required><br>
                </div>
                <div class="form-group">
                    <label for="sobrenome">Sobrenome:</label>
                    <input type="text" id="sobrenome" name="sobrenome" required><br>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" required maxlength="14" placeholder="Ex: 123.456.789-00"><br>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="data-nascimento">Data de Nascimento:</label>
                    <input type="date" id="data-nascimento" name="data-nascimento" required><br>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone" placeholder="Ex: (11) 91234-5678"><br>
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required><br>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required><br>
                </div>
                <div class="form-group">
                    <label for="confirmar-senha">Confirmar Senha:</label>
                    <input type="password" id="confirmar-senha" name="confirmar-senha" required><br>
                </div>
                <div class="form-group">
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep"><br>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco"><br>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade:</label>
                    <input type="text" id="cidade" name="cidade"><br>
                </div>
                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado">
                        <option value="">Selecione um estado</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select><br>
                </div>
            </div>
            <button class="botao" type="submit">Cadastrar</button>
    </div>
    </form>
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