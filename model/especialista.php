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

    public function consultaEspecialidade()
    {
        $consultaEspecialidade = $this->pdo->query("SELECT id_especialidade, nome_especialidade FROM especialidade");
        $retorna = $consultaEspecialidade->fetchAll(PDO::FETCH_ASSOC);
        return $retorna;
    }
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
}
?>
