<?php
session_start();

if (isset($_GET['cpf']) && isset($_GET['cod'])) {
    $_SESSION['pacienteCpf'] = $_GET['cpf']; 
    $_SESSION['pacienteCod'] = $_GET['cod']; 

    header('Location: ../view/telapsicologo.php?cpf=' . urlencode($_GET['cpf']));
    exit();
} else {
    header('Location: ../view/formlogin.php'); 
    exit();
}
