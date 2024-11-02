<?php
require_once '../model/conexao.php';
require_once '../model/avaliacao.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = trim($_POST['tipo'] ?? '');
    $nomeTarefa = trim($_POST['nome'] ?? '');
    $nomeJogo = trim($_POST['nomeSelect'] ?? '');
    $tempo_estimado = isset($_POST['tempo_estimado']) ? (int) $_POST['tempo_estimado'] : 0;
    $descricao = trim($_POST['descricao'] ?? '');

    // Verifique se o 'cip' está na sessão
    if (!isset($_SESSION['pacienteCpf'])) {
        $_SESSION['statusCadastroAvaliacao'] = "Erro: CPF do paciente não encontrado na sessão.";
      //  header('Location: ../view/erro.php');
        exit;
    }
    
    $avaliacaoModel = new Avaliacao();

    if ($tipo === 'jogo') {
        $resultado = $avaliacaoModel->inserirJogo($nomeJogo, $tipo, $tempo_estimado, $_SESSION['pacienteCpf']);
    } elseif ($tipo === 'tarefa') {
        $resultado = $avaliacaoModel->inserirTarefa($nomeTarefa, $descricao, $tipo, $tempo_estimado, $_SESSION['pacienteCpf']);
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
    header('Location: ../view/erro.php'); // Redireciona para uma página de erro
    }
    exit;
} else {
    $_SESSION['statusCadastroAvaliacao'] = "Requisição inválida.";
  header('Location: ../view/erro.php'); // Redireciona para uma página de erro
    exit;
}
