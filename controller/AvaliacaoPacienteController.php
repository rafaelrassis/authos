<?php
require_once '../model/AvaliacaoPaciente.php';

class AvaliacaoController {
    private $avaliacaoModel;

    public function __construct() {
        $this->avaliacaoModel = new AvaliacaoModel();
    }

    public function listarAvaliacoesPendentes($cpf) {
        return $this->avaliacaoModel->getAvaliacoesPendentes($cpf);
    }

    public function finalizarAvaliacao($idAvaliacao) {
        return $this->avaliacaoModel->finalizarAvaliacao($idAvaliacao);
    }
    public function listarJogosPendentes($cpf) {
        return $this->avaliacaoModel->listarJogosPendentes($cpf);
    }

}


?>
