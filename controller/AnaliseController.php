<?php
require_once '../model/Analise.php';

class AnaliseController {
    private $model;

    public function __construct($conexao) {
        $this->model = new Analise($conexao);
    }

    public function getTempoPorDia($cpf) {
        return $this->model->getTempoPorDia($cpf);
    }



    public function getAtividadesPorCpf($cpf) {
        return $this->model->getAtividadesPorCpf($cpf);
    }

    // Novo método para obter a quantidade de tarefas por dia
    public function getQuantidadeTarefasPorDia($cpf) {
        return $this->model->getQuantidadeTarefasPorDia($cpf);
    }
}
?>
