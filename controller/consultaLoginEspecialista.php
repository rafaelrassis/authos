<?php
require_once '../model/login.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    $cip = addslashes($_POST['cip']);
    $senha = addslashes($_POST['senha']);
    

    $especialistaLogin = new Login();
    

    $resultado = $especialistaLogin->loginEspecialista($cip, $senha);
    
    if ($resultado) {

        $_SESSION['conectado'] = $resultado;
        $_SESSION['especialistaconectado'] = $cip;
        header("Location: ../view/telapacienteCod.php"); 
        exit();
    } else {
   
        $_SESSION['statusLogin'] = "CIP ou senha inválidos.";
        header("Location: ../view/formlogin.php"); 
        exit();
    }
}
?>
