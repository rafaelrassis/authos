<?php
require_once '../model/conexao.php'; 
require_once '../model/paciente.php'; 

session_start();

function validaCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = trim($_POST['cpf']);
    $nome = trim($_POST['nome']);
    $data_nascimento = $_POST['data_nascimento']; 
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $foto = $_FILES['foto'];
    $cip = trim($_POST['cip']); 
    $telefone = trim($_POST['telefone']);

    $pacienteModel = new Paciente();

    if (!validaCPF($cpf)) {
        $_SESSION['statusCadastroPaciente'] = "CPF inválido. Por favor, insira um CPF válido.";
        header('Location: ../view/criarpaciente.php');
        exit;
    }

    if ($pacienteModel->pacienteExiste($cpf, $email)) {
        $_SESSION['statusCadastroPaciente'] = "Um paciente com este CPF ou e-mail já está cadastrado.";
        header('Location: ../view/criarpaciente.php');
        exit;
    }

    $fotoPath = '';
    $allowedTypes = ['image/jpeg', 'image/png']; 
    $allowedExtensions = ['jpg', 'jpeg', 'png']; 

    if ($foto['error'] === UPLOAD_ERR_OK) {
        $fileType = mime_content_type($foto['tmp_name']); 
        $fileExtension = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION)); 
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
    } else {
        $_SESSION['statusCadastroPaciente'] = "Erro ao processar a foto.";
        header('Location: ../view/criarpaciente.php');
        exit;
    }

    if ($pacienteModel->inserePaciente($cpf, $nome, $senha, $email, $fotoPath, $cip, $data_nascimento, $telefone)) {
        $_SESSION['statusCadastroPaciente'] = "Paciente cadastrado com sucesso!";
        header('Location: ../view/formlogin.php'); 
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
