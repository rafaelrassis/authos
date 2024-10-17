<?php
require_once '../model/paciente.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $cpf = addslashes($_POST['cpf']);
    $nome = addslashes($_POST['nome']);
    $data_nascimento = addslashes($_POST['data_nascimento']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha = !empty($_POST['senha']) ? addslashes($_POST['senha']) : null; // Mantém a lógica atual
    $foto = null; // Inicializa a variável foto
    
    // Verifica se uma nova foto foi enviada
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $fotoPath = '../uploads/' . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $fotoPath);
        $foto = $fotoPath; // Define o caminho da foto
    }

    $paciente = new Paciente();

    // Passa a senha como null se não for fornecida
    if ($paciente->atualizaPaciente($cpf, $nome, $senha, $data_nascimento, $telefone, $email, $foto)) {
        $_SESSION['statusAlteracaoPaciente'] = "Paciente atualizado com sucesso.";
        header("Location: ../view/alterarPaciente.php");
        exit();
    } else {
        $_SESSION['statusAlteracaoPaciente'] = "Erro ao atualizar o paciente.";
        header("Location: ../view/alterarPaciente.php?cpf=$cpf");
        exit();
    }
}
?>
