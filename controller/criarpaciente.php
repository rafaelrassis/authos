<?php
require_once '../model/conexao.php';
require_once '../model/paciente.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperando dados do formulário
    $cpf = trim($_POST['cpf']);
    $nome = trim($_POST['nome']);
    $data_nascimento = $_POST['dta'];
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $foto = $_FILES['foto'];
    $cip = $_POST['cip'];
   


    $pacienteModel = new Paciente();

    if ($pacienteModel->pacienteExiste($cpf, $email)) {
        $_SESSION['statusCadastroPaciente'] = "Um paciente com este CPF ou e-mail já está cadastrado.";
        header('Location: ../view/criarpaciente.php');
        exit;
    }

   $fotoPath = '';
$allowedTypes = ['image/jpeg', 'image/png']; // Tipos MIME permitidos
$allowedExtensions = ['jpg', 'jpeg', 'png']; // Extensões permitidas

if ($foto['error'] === UPLOAD_ERR_OK) {
    $fileType = mime_content_type($foto['tmp_name']); // Obtém o tipo MIME
    $fileExtension = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION)); // Obtém a extensão do arquivo

    // Verifica se o tipo MIME e a extensão são permitidos
    if (in_array($fileType, $allowedTypes) && in_array($fileExtension, $allowedExtensions)) {
        $uploadDir = '../uploads/';
        $fotoPath = $uploadDir . basename($foto['name']);

        if (!move_uploaded_file($foto['tmp_name'], $fotoPath)) {
            $_SESSION['statusCadastroPaciente'] = "Erro ao fazer upload da foto.";
            header('Location: ../view/criarpaciente.php');
            exit;
        }
    } else {
        $_SESSION['statusCadastroPaciente'] = "Formato de arquivo não suportado. Aceito apenas JPG e PNG.";
        header('Location: ../view/criarpaciente.php');
        exit;
    }
}

    if ($pacienteModel->inserePaciente($cpf, $nome, $senha, $email, $fotoPath, $cip, $data_nascimento)) {
        $_SESSION['statusCadastroPaciente'] = "Paciente cadastrado com sucesso!";
        header('Location: ../view/telapacienteCod.php'); // Redirecionar após o sucesso
        exit;
    } else {
        $_SESSION['statusCadastroPaciente'] = "Erro ao cadastrar o paciente.";
        header('Location: ../view/criarpaciente.php');
        exit;
    }
    } else {
        $_SESSION['statusCadastroPaciente'] = "Não é uma inserção.";
        header('Location: ../view/error.php');
        exit;
    }
