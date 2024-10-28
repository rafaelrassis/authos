<?php

class Avaliacao {
 
    private $pdo;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->pdo = $conexao->conectar();
    }

    public function inserirJogo($nome, $tipo, $tempo_estimado, $cip, $cpf) {
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

    public function inserirTarefa($nome, $descricao, $tipo, $tempo_estimado, $cip, $cpf) {
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
            error_log("Erro ao inserir jogo: " . $e->getMessage());
            return false;
        }
    }    
}    



?>
