<?php
// Inicia a sessão para acessar as variáveis $_SESSION
session_start();

require_once '../model/conexao.php'; // Inclui o arquivo de conexão

class JogosController {
    private $conexao;

    public function __construct() {
        $this->conexao = (new Conexao())->conectar(); // Usa a classe Conexao para obter a conexão
        echo "Conexão ao banco de dados estabelecida.<br>";
    }

    public function atualizarAvaliacoesPescaria($cpf) {
        echo "Chamando atualizarAvaliacoesPescaria com CPF: $cpf<br>";
        
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
            // Prepara a consulta SQL
            $query = "UPDATE avaliacao SET data_hora_inicio = :dataHoraEntrada, data_hora_fim = NOW(), status = 'finalizado' 
                      WHERE cpf = :cpf AND id_avaliacao = :id_avaliacao";
            $stmt = $this->conexao->prepare($query);

            // Binding dos parâmetros
            $stmt->bindParam(':dataHoraEntrada', $_SESSION['dataHoraEntrada']);
            $stmt->bindParam(':cpf', $cpf); // Usando o CPF recebido como argumento
            $stmt->bindParam(':id_avaliacao', $_SESSION['numeroJogo']);

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

// Executando o controller
$controller = new JogosController();
$resultado = $controller->atualizarAvaliacoesPescaria($_SESSION['conectadopaciente']); // Passando o CPF da sessão

if ($resultado) {
    echo "Avaliação atualizada com sucesso!";
} else {
    echo "Falha ao atualizar avaliação.";
}
?>
