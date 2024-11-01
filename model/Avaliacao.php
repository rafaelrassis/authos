<?php

class Avaliacao {

    private $pdo;

    public function __construct() {
        $conexao = new Conexao();
        $this->pdo = $conexao->conectar();
    }

    private function obterIdEspecialista() {
        try {
            $cpf = $_SESSION['conectadopaciente'];
            $stmt = $this->pdo->prepare("SELECT cip FROM paciente WHERE cpf = :cpf");
            $stmt->bindValue(':cpf', $cpf);
            $stmt->execute();
            return $stmt->fetchColumn(); // Retorna o ID do especialista
        } catch (PDOException $e) {
            error_log("Erro ao obter ID do especialista: " . $e->getMessage());
            return false;
        }
    }

    public function inserirJogo($nome, $tipo, $tempo_estimado, $cpf) {
        $cip = $this->obterIdEspecialista();
        if ($cip === false) {
            return false; // Ou trate o erro de acordo com sua lógica
        }

        try {
            $stmt = $this->pdo->prepare("INSERT INTO avaliacao (nome, tipo, tempo_estimado, cip, cpf, data_cadastro, status) VALUES (:nome, :tipo, :tempo_estimado, :cip, :cpf, NOW(), 'pendente')");
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':tipo', $tipo);
            $stmt->bindValue(':tempo_estimado', $tempo_estimado);
            $stmt->bindValue(':cip', $cip);
            $stmt->bindValue(':cpf', $cpf);
                
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao inserir jogo: " . $e->getMessage());
            return false;
        }
    }

    public function inserirTarefa($nome, $descricao, $tipo, $tempo_estimado, $cpf) {
        $cip = $this->obterIdEspecialista();
        if ($cip === false) {
            return false; // Ou trate o erro de acordo com sua lógica
        }

        try {
            $stmt = $this->pdo->prepare("INSERT INTO avaliacao (nome, descricao, tipo, tempo_estimado, cip, cpf, data_cadastro, status) VALUES (:nome, :descricao, :tipo, :tempo_estimado, :cip, :cpf, NOW(), 'pendente')");  
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':descricao', $descricao);
            $stmt->bindValue(':tipo', $tipo);
            $stmt->bindValue(':tempo_estimado', $tempo_estimado);
            $stmt->bindValue(':cip', $cip);
            $stmt->bindValue(':cpf', $cpf);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao inserir tarefa: " . $e->getMessage());
            return false;
        }
    }    
}

?>
