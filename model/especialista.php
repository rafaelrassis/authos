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
    public function consultaEspecialistaPorCIP($cip)
    {
        try {
            $consulta = $this->pdo->prepare("SELECT cip, nome, email, id_especialidade, senha FROM especialista WHERE cip = :c");
            $consulta->bindValue(":c", $cip);
            $consulta->execute();

            return $consulta->fetch(PDO::FETCH_ASSOC);
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
    public function atualizaEspecialista($cip, $nome, $email, $senha, $id_especialidade)
{
    try {
        $sql = "UPDATE especialista SET nome = :n, email = :em, id_especialidade = :es";
        if ($senha) {
            $sql .= ", senha = :s";
        }
        $sql .= " WHERE cip = :c";

        $atualiza = $this->pdo->prepare($sql);
        $atualiza->bindValue(":n", $nome);
        $atualiza->bindValue(":em", $email);
        $atualiza->bindValue(":es", $id_especialidade);
        $atualiza->bindValue(":c", $cip);

        if ($senha) {
            $atualiza->bindValue(":s", $senha);
        }

        return $atualiza->execute();
    } catch (PDOException $e) {
        error_log('Erro ao atualizar: ' . $e->getMessage());
        return false;
    }
}

public function getPacientesComEspecialistas()
{
    try {
        // Preparar a consulta SQL com o JOIN entre Paciente e Especialista
        $sql = "SELECT 
                    p.cpf, 
                    p.nome AS nome_paciente, 
                    p.email AS email_paciente, 
                    p.data_nascimento, 
                    p.telefone, 
                    e.nome AS nome_especialista, 
                    e.email AS email_especialista, 
                    e.id_especialidade
                FROM 
                    Paciente p
                JOIN 
                    Especialista e 
                ON 
                    p.cip = e.cip";
        
        // Preparar e executar a consulta
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        // Retornar os resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Em caso de erro, log o erro e retorne um array vazio
        error_log('Erro ao consultar pacientes e especialistas: ' . $e->getMessage());
        return [];
    }
}

    
}
?>
