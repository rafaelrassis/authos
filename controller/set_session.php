<?php
session_start();

// Verifica se o CPF e o código foram passados na URL
if (isset($_GET['cpf']) && isset($_GET['cod'])) {
    // Armazena o CPF e o código do paciente na sessão
    $_SESSION['pacienteCpf'] = $_GET['cpf']; // Armazena o CPF do paciente na sessão
    $_SESSION['pacienteCod'] = $_GET['cod']; // Armazena o código do paciente na sessão

    // Redireciona para telapsicologo.php, passando o CPF pela URL
    header('Location: ../view/telapsicologo.php?cpf=' . urlencode($_GET['cpf']));
    exit();
} else {
    // Caso não tenha CPF ou código, redireciona de volta com uma mensagem de erro ou para uma página padrão
    header('Location: ../view/formlogin.php'); // Ou outra página de sua escolha
    exit();
}
