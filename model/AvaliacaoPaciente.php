<?php
require_once '../model/conexao.php';



class AvaliacaoModel {
    private $conexao;

    public function __construct() {
        $this->conexao = (new Conexao())->conectar();
    }

    public function getAvaliacoesPendentes($cpf) {
        $sql = "SELECT `id_avaliacao`, `nome`, `tipo`, `data_hora_inicio`, `data_hora_fim`, 
                       `tempo_estimado`, `descricao`, `cip`, `cpf`, `data_cadastro`, `status` 
                FROM `avaliacao` 
                WHERE `cpf` = :cpf AND `status` = 'pendente' AND `tipo` = 'tarefa'";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function finalizarAvaliacao($idAvaliacao) {
        $sql = "UPDATE `avaliacao` 
                SET `data_hora_fim` = NOW(), `status` = 'finalizado' 
                WHERE `id_avaliacao` = :idAvaliacao";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':idAvaliacao', $idAvaliacao, PDO::PARAM_INT);
        return $stmt->execute();
    }
}