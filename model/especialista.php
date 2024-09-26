<?php
require_once '../model/conexao.php';

class Especialista
{
    private $pdo;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->pdo = $conexao->conectar();
    }

    // Método para inserir especialista
    public function insereEspecialista($cip, $nome, $email, $senha, $id_especialidade)
    {
        try {
            $insere = $this->pdo->prepare("INSERT INTO especialista (cip, nome, email, id_especialidade, senha) 
                                           VALUES (:c, :n, :em, :es, :s)");

            $insere->bindValue(":c", $cip);
            $insere->bindValue(":n", $nome);
            $insere->bindValue(":em", $email);
            $insere->bindValue(":es", $id_especialidade); 
            $insere->bindValue(":s", $senha);
            $insere->execute();

            return true;
        } catch (PDOException $e) {
            error_log('Erro ao inserir: ' . $e->getMessage());
            return json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    // Método para retornar especialistas
    public function consultaEspecialistas()
    {
        $consulta = $this->pdo->query("SELECT cip, nome FROM especialista");
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para verificar se o especialista já existe
    public function especialistaExiste($cip, $email)
    {
        try {
            $consulta = $this->pdo->prepare("SELECT COUNT(*) FROM especialista WHERE cip = :c OR email = :e");
            $consulta->bindValue(":c", $cip);
            $consulta->bindValue(":e", $email);
            $consulta->execute();

            return $consulta->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log('Erro ao verificar especialista: ' . $e->getMessage());
            return false;
        }
    }

    public function consultaEspecialidade()
    {
        try {
            $consulta = $this->pdo->prepare("SELECT id_especialidade, nome_especialidade FROM especialidade");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC); // Alterado para fetchAll
        } catch (PDOException $e) {
            error_log('Erro ao consultar especialidades: ' . $e->getMessage());
            return []; // Retorne um array vazio em caso de erro
        }
    }
    
}
?>
