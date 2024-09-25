<?php
require_once '../model/paciente.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    $cpf = addslashes($_POST['cpf']);
    $nome = addslashes($_POST['nome']);
    $dta = addslashes($_POST['dta']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    
 
$foto = $_FILES['foto'];
$fotoPath = '';
if ($foto['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($foto['name'], PATHINFO_EXTENSION);
    $fotoPath = 'uploads/' . uniqid() . '.' . $ext;
    if (move_uploaded_file($foto['tmp_name'], '../' . $fotoPath)) {
        
    } else {
        $_SESSION['statusCadastroPaciente'] = "Erro ao mover o arquivo de foto.";
        header("Location: ../view/telapacienteCod.php");

    }
} else {

    $_SESSION['statusCadastroPaciente'] = "Erro no upload do arquivo de foto.";
    header("Location: ../view/telapacienteCod.php");
}
    $paciente = new Paciente();
    
    if ($paciente->pacienteExiste($cpf, $email)) {
        $_SESSION['statusCadastroPaciente'] = "CPF ou E-mail já cadastrados.";
    } else {
        if ($paciente->inserePaciente($cpf, $nome, $dta, $email, $senha, $fotoPath)) {
            header("Location: ../view/telapacienteCod.php");
            exit();
        } else {
            $_SESSION['statusCadastroPaciente'] = "Erro ao inserir o paciente. ou paciente já existe.";
            header("Location: ../view/telapacienteCod.php");

        }
    }
    
    header("Location: ../view/criarpaciente.php"); 
    exit();
}
?>
