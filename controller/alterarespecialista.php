<?php
require_once '../model/especialista.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $cip = addslashes($_POST['cip']);
    $nome = addslashes($_POST['nome']);
    $id_especialidade = addslashes($_POST['id_especialidade']);
    $email = addslashes($_POST['email']);
    $senha = !empty($_POST['senha']) ? addslashes($_POST['senha']) : null;

    $especialista = new Especialista();

    if ($especialista->atualizaEspecialista($cip, $nome, $email, $senha, $id_especialidade)) {
        $_SESSION['statusAlteracaoEspecialista'] = "Especialista atualizado com sucesso.";
        header("Location: ../view/alterarEspecialista.php");
        exit();
    } else {
        $_SESSION['statusAlteracaoEspecialista'] = "Erro ao atualizar o especialista.";
        header("Location: ../view/alterarEspecialista.php?cip=$cip");
    }
}
?>
