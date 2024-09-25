<?php
require_once '../model/conexao.php';

class Login {
    private $pdo;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->pdo = $conexao->conectar();
    }

    public function loginEspecialista($cip, $senha)
    {
        try {
            $login = $this->pdo->prepare("SELECT cip, nome, email FROM especialista WHERE cip = :cip AND senha = :senha");
            $login->bindValue(":cip", $cip);
            $login->bindValue(":senha", $senha); 
            $login->execute();

            if ($login->rowCount() > 0) {
                return $login->fetch(PDO::FETCH_ASSOC);
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            error_log('Erro ao realizar login: ' . $e->getMessage());
            return false;
        }
    }

    public function loginPaciente($cpf, $senha)
    {
        try {
            $login = $this->pdo->prepare("SELECT cpf, nome, email, senha FROM paciente WHERE cpf = :cpf AND senha = :senha");
            $login->bindValue(":cpf", $cpf);
            $login->bindValue(":senha", $senha); 
            $login->execute();
    
            if ($login->rowCount() > 0) {
                return $login->fetch(PDO::FETCH_ASSOC);
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            error_log('Erro ao realizar login: ' . $e->getMessage());
            return false;
        }
    }
    
    
}
?>
