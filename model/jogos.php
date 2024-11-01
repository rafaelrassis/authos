<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/authos/model/conexao.php';

class JogosModel {
    private $conexao;

    public function __construct() {
        $this->conexao = (new Conexao())->conectar();
    }

   
    public function atualizarAvaliacoesPescaria($cpf) {
        // Verifique os valores recebidos
        error_log("Atualizando avaliações. CPF: " . $cpf . ", Data e Hora de Entrada: " . $_SESSION['dataHoraEntrada']);
    
        // Verifica se a data e hora de entrada estão definidas
        if (!isset($_SESSION['dataHoraEntrada'])) {
            error_log("Data e Hora de Entrada não definida na sessão.");
            return false;
        }
    
        try {
            $query = "UPDATE avaliacao SET data_hora_inicio = :dataHoraEntrada, data_hora_fim = NOW(), status = 'finalizado' 
                      WHERE cpf = :cpf AND id_avaliacao = :id_avaliacao";
            $stmt = $this->conexao->prepare($query);
    
            // Binding dos parâmetros
            $stmt->bindParam(':dataHoraEntrada', $_SESSION['dataHoraEntrada']);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':id_avaliacao', $_SESSION['numeroJogo']);
    
            // Log dos parâmetros
            error_log("DataHoraEntrada: " . $_SESSION['dataHoraEntrada']);
            error_log("CPF: " . $cpf);
            error_log("ID Avaliacao: " . $_SESSION['numeroJogo']);
    
            // Executa a query
            $executed = $stmt->execute();
            
            // Log de erro se a execução falhar
            if (!$executed) {
                error_log("Erro ao executar a consulta: " . implode(", ", $stmt->errorInfo()));
            }
    
            // Loga o número de linhas afetadas
            error_log("Linhas afetadas: " . $stmt->rowCount());
    
            // Retorna true se a execução foi bem-sucedida e linhas foram afetadas
            return $executed && $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Erro ao atualizar avaliação: " . $e->getMessage());
            return false;
        }
    }
    
}
?>