<?php
require_once '../model/conexao.php'; // Inclua o arquivo de conexão com o banco de dados
require_once '../model/paciente.php'; // Inclua o model que contém a classe Paciente

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperando dados do formulário
    $cpf = trim($_POST['cpf']);
    $nome = trim($_POST['nome']);
    $data_nascimento = $_POST['data_nascimento']; // Alterado para o nome correto
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $foto = $_FILES['foto'];
    $cip = trim($_POST['cip']); // CPF do especialista
    $telefone = trim($_POST['telefone']);

    $pacienteModel = new Paciente();

    // Verifica se o paciente já existe
    if ($pacienteModel->pacienteExiste($cpf, $email)) {
        $_SESSION['statusCadastroPaciente'] = "Um paciente com este CPF ou e-mail já está cadastrado.";
        header('Location: ../view/formlogin.php');
        exit;
    }

    // Lógica de upload de foto
    $fotoPath = '';
    $allowedTypes = ['image/jpeg', 'image/png']; // Tipos MIME permitidos
    $allowedExtensions = ['jpg', 'jpeg', 'png']; // Extensões permitidas

    if ($foto['error'] === UPLOAD_ERR_OK) {
        $fileType = mime_content_type($foto['tmp_name']); // Obtém o tipo MIME
        $fileExtension = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION)); // Obtém a extensão do arquivo

        // Verifica se o tipo MIME e a extensão são permitidos
        if (in_array($fileType, $allowedTypes) && in_array($fileExtension, $allowedExtensions)) {
            $uploadDir = '../uploads/'; // Diretório de upload
            $fotoPath = $uploadDir . basename($foto['name']); // Caminho do arquivo

            // Move o arquivo para o diretório de uploads
            if (!move_uploaded_file($foto['tmp_name'], $fotoPath)) {
                $_SESSION['statusCadastroPaciente'] = "Erro ao fazer upload da foto.";
                header('Location: ../view/formlogin.php');
                exit;
            }
        } else {
            $_SESSION['statusCadastroPaciente'] = "Formato de arquivo não suportado. Aceito apenas JPG e PNG.";
            header('Location: ../view/formlogin.php');
            exit;
        }
    } else {
        $_SESSION['statusCadastroPaciente'] = "Erro ao processar a foto.";
        header('Location: ../view/formlogin.php');
        exit;
    }

    // Debug: Mostra os dados que serão inseridos
    var_dump($cpf, $nome, $senha, $email, $fotoPath, $cip, $data_nascimento, $telefone);

    // Insere o paciente no banco de dados
    if ($pacienteModel->inserePaciente($cpf, $nome, $senha, $email, $fotoPath, $cip, $data_nascimento, $telefone)) {
        $_SESSION['statusCadastroPaciente'] = "Paciente cadastrado com sucesso!";
        header('Location: ../view/formlogin.php'); // Redirecionar após o sucesso
        exit;
    } else {
        $_SESSION['statusCadastroPaciente'] = "Erro ao cadastrar o paciente.";
        header('Location: ../view/formlogin.php');
        exit;
    }
} else {
    $_SESSION['statusCadastroPaciente'] = "Não é uma inserção.";
    header('Location: ../view/error.php');
    exit;
}
