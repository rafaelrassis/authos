<?php
session_start(); // Inicia a sessão

class Conexao {
    private $pdo;

    private $host = "localhost";
    private $dbname = "authosdb";
    private $user = "root";
    private $senha = "";

    public function conectar() {
        try {
            $this->pdo = new PDO("mysql:dbname=".$this->dbname.';host='.$this->host, $this->user, $this->senha);
        } catch (PDOException $e) {
            echo "ERRO DE CONEXAO NO PDO: " . $e->getMessage();
            exit();
        }

        return $this->pdo;
    }
}

// Verifica se a sessão foi iniciada e exibe a data e hora de entrada
date_default_timezone_set('America/Sao_Paulo');
if (!isset($_SESSION['dataHoraEntrada'])) {
    $_SESSION['dataHoraEntrada'] = date('Y-m-d H:i:s');
}
echo "Sessão iniciada<br>";
echo "Você entrou na página em: " . $_SESSION['dataHoraEntrada'] . "<br>";

// Processa o formulário se enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    fecharJogo();
}

function fecharJogo() {
    // Obtém o CPF do paciente conectado
    if (!isset($_SESSION['conectadopaciente'])) {
        echo "Paciente não conectado.<br>";
        return;
    }
    
    $cpf = $_SESSION['conectadopaciente'];

    // Verifica se a data e hora de entrada estão definidas
    if (!isset($_SESSION['dataHoraEntrada'])) {
        echo "Data e Hora de Entrada não definida na sessão.<br>";
    } elseif (!isset($_SESSION['numeroJogo'])) {
        echo "ID de Avaliação não definida na sessão.<br>";
    } else {
        try {
            $conexao = (new Conexao())->conectar(); // Usa a classe Conexao para obter a conexão

            // Prepara a consulta SQL
            $query = "UPDATE avaliacao SET data_hora_inicio = :dataHoraEntrada, data_hora_fim = NOW(), status = 'finalizado' 
                      WHERE cpf = :cpf AND id_avaliacao = :id_avaliacao";
            $stmt = $conexao->prepare($query);

            // Binding dos parâmetros
            $stmt->bindParam(':dataHoraEntrada', $_SESSION['dataHoraEntrada']);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':id_avaliacao', $_SESSION['numeroJogo']);

            // Executa a query
            $executed = $stmt->execute();

            // Log de erro se a execução falhar
            if (!$executed) {
                echo "Erro ao executar a consulta: " . implode(", ", $stmt->errorInfo()) . "<br>";
            }

            // Loga o número de linhas afetadas
            echo "Linhas afetadas: " . $stmt->rowCount() . "<br>";

            // Retorna mensagem de sucesso ou falha
            if ($stmt->rowCount() > 0) {
                echo "Avaliação atualizada com sucesso!";
                header('Location: ../view/avaliacaoPaciente.php');
            } else {
                echo "Nenhuma avaliação encontrada para atualizar.";
            }
        } catch (PDOException $e) {
            echo "Erro ao atualizar avaliação: " . $e->getMessage() . "<br>";
        }
    }
}
?>
