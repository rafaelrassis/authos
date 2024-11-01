<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/authos/model/jogos.php';

class jogosController {
    private $jogosModel;

    public function __construct() {
        $this->jogosModel = new JogosModel();
    }

    public function atualizarAvaliacoesPescaria($cpf) {
        return $this->jogosModel->atualizarAvaliacoesPescaria($cpf);
    }
}

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    // Verifica se as sessões necessárias estão definidas
    if (isset($_SESSION['conectadopaciente']) && isset($_SESSION['numeroJogo'])) {
        $controller = new jogosController();
        $resultado = $controller->atualizarAvaliacoesPescaria($_SESSION['conectadopaciente']);
        
        if ($resultado) {
            echo "Avaliação atualizada com sucesso!";
        } else {
            echo "Falha ao atualizar avaliação.";
        }
    } else {
        echo "Dados da sessão não estão completos.";
    }
}
?>
