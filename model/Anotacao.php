<?php
require_once '../model/conexao.php';

class Anotacao {
    private $pdo;

    public function __construct($conexao = null) {
        if ($conexao) {
            $this->pdo = $conexao->conectar();
        } else {
            $conexao = new Conexao();
            $this->pdo = $conexao->conectar();
        }
    }

    public function criarAnotacao($titulo, $conteudo, $cpfEspecialista, $cipEspecialista) {
        $sql = "INSERT INTO anotacoes (titulo, conteudo, data_criacao, cpf, cip) VALUES (:titulo, :conteudo, NOW(), :cpf, :cip)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':conteudo', $conteudo);
        $stmt->bindParam(':cpf', $cpfEspecialista);
        $stmt->bindParam(':cip', $cipEspecialista);
        return $stmt->execute();
    }

    public function listarAnotacoesPorCpf($cpfPaciente) {
        $sql = "SELECT a.id_relatorio, a.titulo, a.conteudo, a.data_criacao, e.nome AS nome_especialista 
                FROM anotacoes a 
                JOIN especialista e ON a.cip = e.cip 
                JOIN paciente p ON a.cpf = p.cpf 
                WHERE p.cpf = ? 
                ORDER BY id_relatorio desc"; // Use a coluna correta aqui
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$cpfPaciente]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function deletarAnotacao($id) {
        $sql = "DELETE FROM anotacoes WHERE id_relatorio = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}

?>
