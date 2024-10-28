<?php
require_once '../model/conexao.php';

class Analise {
    private $pdo;

    public function __construct($conexao = null) {
        if ($conexao) {
            $this->pdo = $conexao->conectar();
        } else {
            $conexao = new Conexao();
            $this->pdo = $conexao->conectar();
        }
    }

    public function getTempoPorDia($cpf) {
        try {
            $query = "
               SELECT 
               DATE(data_hora_inicio) AS dia,
               ROUND(SUM(TIMESTAMPDIFF(SECOND, data_hora_inicio, data_hora_fim)) / 3600, 2) AS tempo_total
           FROM 
               avaliacao
           WHERE 
               cpf = ? AND 
               tipo = 'jogo' AND
               status = 'finalizado'
           GROUP BY 
               dia
           ORDER BY 
               dia;
            ";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$cpf]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage()); // Log do erro
            return [];
        }
    }

    public function getQuantidadeTarefasPorDia($cpf) {
        try {
            $query = "
               SELECT 
                DATE(`data_hora_fim`) AS data_finalizacao,
                COUNT(*) AS total_tarefas_finalizadas
            FROM 
                avaliacao
            WHERE 
                cpf = ? 
                AND tipo = 'tarefa' 
                AND status = 'finalizado'
            GROUP BY 
                DATE(`data_hora_fim`);  // Remover ponto e vírgula extra
            ";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$cpf]);
            
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Debug: Verificar os resultados
            // var_dump($resultados); // Remover em produção
            return $resultados;
        } catch (PDOException $e) {
            error_log($e->getMessage()); // Log do erro
            return [];
        }
    }

    public function getAtividadesPorCpf($cpf) {
        try {
            $query = "
                SELECT 
                    nome, tipo, data_hora_inicio, data_hora_fim, tempo_estimado, descricao, cip, cpf, data_cadastro, status 
                FROM 
                    avaliacao 
                WHERE 
                    cpf = ?  
                ORDER BY 
                    id_avaliacao DESC;
            ";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$cpf]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage()); // Log do erro
            return [];
        }
    }
}
?>
