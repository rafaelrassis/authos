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

    public function inserePaciente($cpf, $nome, $dta, $email, $senha, $foto)
    {
        try {
            $insere = $this->pdo->prepare("INSERT INTO paciente (cpf, nome, data_nascimento, email, senha, foto) VALUES (:c, :n, :d, :em, :se, :fo)");
            $insere->bindValue(":c", $cpf);
            $insere->bindValue(":n", $nome);
            $insere->bindValue(":d", $dta);
            $insere->bindValue(":em", $email);
            $insere->bindValue(":se", $senha);
            $insere->bindValue(":fo", $foto);
            $insere->execute();
    
            return true;
        } catch (PDOException $e) {
            error_log('Erro ao inserir: ' . $e->getMessage());
            return false;
        }
    }

    public function pacienteExiste($cpf, $email)
    {
        try {
            $consulta = $this->pdo->prepare("SELECT COUNT(*) FROM paciente WHERE cpf = :c OR email = :e");
            $consulta->bindValue(":c", $cpf);
            $consulta->bindValue(":e", $email);
            $consulta->execute();

            return $consulta->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log('Erro ao verificar paciente: ' . $e->getMessage());
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
    public function obterInformacoes($cpf) {
        try {
            $consulta = $this->pdo->prepare("SELECT cpf, nome, data_nascimento, email, foto FROM paciente WHERE cpf = :c");
            $consulta->bindValue(":c", $cpf);
            $consulta->execute();
    
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao obter informações do paciente: ' . $e->getMessage());
            return false;
        }
    }
}


?>
