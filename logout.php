<?php
session_start(); // Inicia a sessão para garantir que ela seja acessada

// Verifica se uma sessão está ativa
if (session_status() == PHP_SESSION_ACTIVE) {
    session_unset(); // Limpa todas as variáveis de sessão
    session_destroy(); // Destroi a sessão
}

// Redireciona para a página inicial
header("Location: index.html");
exit;
?>
