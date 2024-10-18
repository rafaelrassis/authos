<?php
require_once '../model/Anotacao.php'; 

class AnotacaoController {
    private $anotacaoModel;

    public function __construct($conexao) {
        $this->anotacaoModel = new Anotacao($conexao); 

    public function criarAnotacao($titulo, $conteudo) {
        if (!isset($_SESSION['especialistaconectado'])) {
            $_SESSION['statusAnotacao'] = "Erro: Especialista não encontrado.";
            return;
        }
    
      
        $success = $this->anotacaoModel->criarAnotacao($titulo, $conteudo, $_SESSION['pacienteCpf'], $_SESSION['especialistaconectado']);
        $_SESSION['statusAnotacao'] = $success ? "Anotação criada com sucesso!" : "Erro ao criar anotação.";
    }
    public function listarAnotacoes() {
        if (!isset($_SESSION['pacienteCpf'])) {
            return []; 
        }
        
        return $this->anotacaoModel->listarAnotacoesPorCpf($_SESSION['pacienteCpf']);
    }

    public function deletarAnotacao($id) {
        if (!isset($_SESSION['especialistaconectado'])) {
            return false; 
        }

        return $this->anotacaoModel->deletarAnotacao($id);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $conexao = new Conexao();
    $controller = new AnotacaoController($conexao);
    $controller->deletarAnotacao($_POST['id']);
}
?>
