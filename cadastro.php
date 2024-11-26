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
    <link rel="stylesheet" href="./css/cadastro.css">
    <link rel="stylesheet" href="testes.css">
    <script>
        // Efeito de digitação nos campos de entrada
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
        // Efeito de carregamento no botão
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
                    <a href="./cadastro.php" class="explorar">Cadastro</a><br>
                    <a href="./login.php" class="explorar">Login</a><br>
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