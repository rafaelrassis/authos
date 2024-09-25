<?php
require_once '../model/especialista.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $cip = addslashes($_POST['cip']);
    $nome = addslashes($_POST['nome']);
    $id_especialidade = addslashes($_POST['id_especialidade']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    

    $especialista = new Especialista();
    
    if ($especialista->especialistaExiste($cip, $email)) {
        $_SESSION['statusCadastroEspecialista'] = "CIP ou E-mail já cadastrados.";
        header("Location: ../view/criarconta.php");
    } else {
        if ($especialista->insereEspecialista($cip, $nome, $email, $senha, $id_especialidade)) { 
            header("Location: ../view/formlogin.php");
            exit();
        
        } else {
            $_SESSION['statusCadastroEspecialista'] = "Erro ao inserir o especialista. Por favor, tente novamente.";
            header("Location: ../view/criarconta.php");
        }
    }
}
    header("Location: ../view/criarconta.php"); 
?>
