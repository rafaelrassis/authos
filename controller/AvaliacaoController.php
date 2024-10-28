<?php
require_once '../model/conexao.php';
require_once '../model/avaliacao.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = trim($_POST['tipo'] ?? '');
    $nome = trim($_POST['nome'] ?? '');
    $tempo_estimado = isset($_POST['tempo_estimado']) ? (int) $_POST['tempo_estimado'] : 0;
    $descricao = trim($_POST['descricao'] ?? '');
    $cip = $_SESSION['especialistaconectado'] ?? null;

    if (empty($cip) || empty($tipo) || empty($nome) || $tempo_estimado <= 0) {
        $_SESSION['statusCadastroAvaliacao'] = "Dados incompletos para cadastro.";
        header('Location: ../view/erro.php');
        exit;
    }

    $avaliacaoModel = new Avaliacao();

    if ($tipo === 'jogo') {
        $resultado = $avaliacaoModel->inserirJogo($nome, $tipo, $tempo_estimado, $_SESSION['especialistaconectado'], $_SESSION['pacienteCpf']);
    } elseif ($tipo === 'tarefa') {
        $resultado = $avaliacaoModel->inserirTarefa($nome, $descricao, $tipo, $tempo_estimado, $_SESSION['especialistaconectado'], $_SESSION['pacienteCpf']);
    } else {
        $_SESSION['statusCadastroAvaliacao'] = "Tipo de avaliação inválido.";
        header('Location: ../view/avaliacao.php');
        exit;
    }

    if ($resultado) {
        $_SESSION['statusCadastroAvaliacao'] = ucfirst($tipo) . " cadastrado com sucesso!";
        header('Location: ../view/avaliacao.php');
    } else {
        $_SESSION['statusCadastroAvaliacao'] = "Erro ao cadastrar " . $tipo . ".";
        header('Location: ../view/erro.php');
    }
    exit;
} else {
    $_SESSION['statusCadastroAvaliacao'] = "Requisição inválida.";
    header('Location: ../view/erro.php');
    exit;
}
