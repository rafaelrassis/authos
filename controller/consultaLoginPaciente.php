<?php
require_once '../model/login.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    $cpf = addslashes($_POST['cpf']);
    $senha = addslashes($_POST['senha']);
    

    $pacienteLogin = new Login();
    

    $resultado = $pacienteLogin->loginPaciente($cpf, $senha);
    
    if ($resultado) {

        $_SESSION['conectado'] = $resultado;
        $_SESSION['conectadopaciente'] = $cpf;
        header("Location: ../view/telapaciente.php"); 
        exit();
    } else {
   
        $_SESSION['statusLogin'] = "CPF ou senha inválidos.";
        header("Location: ../view/formlogin.php");
        exit();
    }
}
?>
