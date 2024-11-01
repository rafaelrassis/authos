<?php
require_once '../model/conexao.php';

class JogosModel {
    private $conexao;

    public function __construct() {
        $this->conexao = (new Conexao())->conectar();
        echo "Conexão ao banco de dados estabelecida.<br>";
    }

    public function atualizarAvaliacoesPescaria($cpf) { 
        // Verifique os valores recebidos
        echo "Atualizando avaliações. CPF: " . $cpf . "<br>";
        echo "Data e Hora de Entrada: " . $_SESSION['dataHoraEntrada'] . "<br>";
        
        // Verifica se a data e hora de entrada estão definidas
        if (!isset($_SESSION['dataHoraEntrada'])) {
            echo "Data e Hora de Entrada não definida na sessão.<br>";
            return false;
        }
        
        // Verifica se o número do jogo está definido
        if (!isset($_SESSION['numeroJogo'])) {
            echo "ID de Avaliação não definida na sessão.<br>";
            return false;
        }
    
        try {
            $query = "UPDATE avaliacao SET data_hora_inicio = :dataHoraEntrada, data_hora_fim = NOW(), status = 'finalizado' 
                      WHERE cpf = :cpf AND id_avaliacao = :id_avaliacao";
            $stmt = $this->conexao->prepare($query);
    
            // Binding dos parâmetros
            $stmt->bindParam(':dataHoraEntrada', $_SESSION['dataHoraEntrada']);
            $stmt->bindParam(':cpf', $cpf); // Usando o CPF recebido como argumento
            $stmt->bindParam(':id_avaliacao', $_SESSION['numeroJogo']); // Assegure-se que esta variável está definida
    
            // Log dos parâmetros
            echo "DataHoraEntrada: " . $_SESSION['dataHoraEntrada'] . "<br>";
            echo "CPF: " . $cpf . "<br>";
            echo "ID Avaliacao: " . $_SESSION['numeroJogo'] . "<br>";
    
            // Executa a query
            $executed = $stmt->execute();
            
            // Log de erro se a execução falhar
            if (!$executed) {
                echo "Erro ao executar a consulta: " . implode(", ", $stmt->errorInfo()) . "<br>";
            }
    
            // Loga o número de linhas afetadas
            echo "Linhas afetadas: " . $stmt->rowCount() . "<br>";
    
            // Retorna true se a execução foi bem-sucedida e linhas foram afetadas
            return $executed && $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Erro ao atualizar avaliação: " . $e->getMessage() . "<br>";
            return false;
        }
    }
    
}
?>
