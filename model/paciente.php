<?php
require_once '../model/conexao.php';

class Paciente
{
    private $pdo;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->pdo = $conexao->conectar();
    }

    public function pacienteExiste($cpf, $email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM paciente WHERE cpf = :cpf OR email = :email");
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function inserePaciente($cpf, $nome, $senha, $email, $fotoPath, $cip, $data_nascimento, $telefone)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO paciente (cpf, nome, senha, email, foto, cip, data_nascimento, telefone) VALUES (:cpf, :nome, :senha, :email, :foto, :cip, :data_nascimento, :telefone)");
            
            $stmt->bindValue(':cpf', $cpf);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':senha', $senha); 
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':foto', $fotoPath);
            $stmt->bindValue(':cip', $cip);
            $stmt->bindValue(':data_nascimento', $data_nascimento);
            $stmt->bindValue(':telefone', $telefone);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao inserir paciente: " . $e->getMessage());
            return false;
        }
    }

    public function obterInformacoesPaciente($codigo)
    {
        try {
            $consulta = $this->pdo->prepare("SELECT * FROM paciente WHERE cpf = :c");
            $consulta->bindValue(":c", $codigo);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao obter informações do paciente: " . $e->getMessage());
            return false;
        }
    }

    public function atualizaPaciente($cpf, $nome, $senha, $data_nascimento, $telefone, $email, $foto, $cip) {
        $this->pdo = (new Conexao())->conectar();
    
        $query = "UPDATE paciente SET nome = ?, data_nascimento = ?, telefone = ?, email = ?, cip = ?";
        
        $params = [$nome, $data_nascimento, $telefone, $email, $cip];
    
        if (!empty($senha)) {
            $query .= ", senha = ?";
            $params[] = $senha;
        }
    
        if (!empty($foto)) {
            $query .= ", foto = ?";
            $params[] = $foto;
        }
    
        $query .= " WHERE cpf = ?";
        $params[] = $cpf;
    
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($params);
    }
    

    public function buscarPacientesPorEspecialista($cip) {
        try {
            $consulta = $this->pdo->prepare("SELECT cpf, nome, senha, email, foto, data_nascimento, telefone FROM paciente WHERE cip = :cip");
            $consulta->bindValue(":cip", $cip);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar pacientes: ' . $e->getMessage());
            return [];
        }
    }
    public function obterEspecialistaAtual($cpfPaciente)
    {
    try {
        $consulta = $this->pdo->prepare("
            SELECT especialista.cip, especialista.nome 
            FROM paciente 
            JOIN especialista ON paciente.cip = especialista.cip 
            WHERE paciente.cpf = :cpf
        ");
        $consulta->bindValue(":cpf", $cpfPaciente);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao obter o especialista atual: " . $e->getMessage());
        return false;
    }
}
public function listarEspecialistas()
{
    try {
        $consulta = $this->pdo->query("SELECT cip, nome FROM especialista");
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao listar especialistas: " . $e->getMessage());
        return [];
    }
}
    
    
}
?>
