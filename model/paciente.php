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

   public function inserePaciente($cpf, $nome, $senha, $email, $fotoPath, $cip, $data_nascimento)
    {

        try {
          $stmt = $this->pdo->prepare("INSERT INTO paciente (cpf, nome, senha, email, foto, cip, data_nascimento) VALUES (:cpf, :nome, :senha, :email, :foto, :cip, :data_nascimento)");
           // $stmt = $this->pdo->prepare("INSERT INTO paciente (cpf) VALUES (:cpf)");
         
            $stmt->bindValue(':cpf', $cpf);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':senha',$senha); 
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':foto', $fotoPath);
          $stmt->bindValue(':cip', $cip);
          $stmt->bindValue(':data_nascimento', $data_nascimento);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao inserir paciente: " . $e->getMessage());
            return false;
        }
    }


    public function buscarPorCodigo($codigo) 
    {
        try {
            $consulta = $this->pdo->prepare("SELECT cpf FROM paciente WHERE cpf = :c");
            $consulta->bindValue(":c", $codigo);
            $consulta->execute();

            return $consulta->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log('Erro ao verificar paciente: ' . $e->getMessage());
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
            error_log('Erro ao buscar informações do paciente: ' . $e->getMessage());
            return false;
        }
    }

    public function buscarPacientesPorEspecialista($cip) {
        try {
            $consulta = $this->pdo->prepare("SELECT cpf, nome, senha, email, foto, data_nascimento FROM paciente WHERE cip = :cip");
            $consulta->bindValue(":cip", $cip);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar pacientes: ' . $e->getMessage());
            return [];
        }
    }
    
}
?>
