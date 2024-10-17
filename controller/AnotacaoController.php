<?php
require_once '../model/Anotacao.php'; // Certifique-se de incluir o model Anotacao

class AnotacaoController {
    private $anotacaoModel;

    public function __construct($conexao) {
        $this->anotacaoModel = new Anotacao($conexao); // Inicializando o modelo
    }

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
            return []; // Retorna um array vazio se não houver paciente
        }
        
        return $this->anotacaoModel->listarAnotacoesPorCpf($_SESSION['pacienteCpf']);
    }

    public function deletarAnotacao($id) {
        if (!isset($_SESSION['especialistaconectado'])) {
            return false; // Retorna falso se não houver especialista
        }

        return $this->anotacaoModel->deletarAnotacao($id);
    }
}

// Lógica para processar a exclusão via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $conexao = new Conexao();
    $controller = new AnotacaoController($conexao);
    $controller->deletarAnotacao($_POST['id']);
}
?>
