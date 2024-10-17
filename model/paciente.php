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

    public function atualizaPaciente($cpf, $nome, $senha, $data_nascimento, $telefone, $email, $foto) {
        // Usa o método conectar() para obter a conexão
        $this->pdo = (new Conexao())->conectar();
    
        // Primeiro, busque a senha atual do paciente
        $querySenhaAtual = "SELECT senha FROM paciente WHERE cpf = ?";
        $stmtSenha = $this->pdo->prepare($querySenhaAtual);
        $stmtSenha->execute([$cpf]);
        $senhaAtual = $stmtSenha->fetchColumn();
    
        // Inicializa a parte da consulta
        $query = "UPDATE paciente SET nome = ?, data_nascimento = ?, telefone = ?, email = ?";
        
        // Inicializa um array para os parâmetros
        $params = [$nome, $data_nascimento, $telefone, $email];
    
        // Adiciona a nova senha se fornecida
        if ($senha !== null) {
            $query .= ", senha = ?";
            $params[] = $senha; // Adiciona a nova senha
        } else {
            // Se a senha não for fornecida, mantém a senha atual
            // Não precisamos adicionar a senha ao array de parâmetros, pois ela não será usada na atualização
        }
    
        // Adiciona a foto se fornecida
        if ($foto !== null) {
            $query .= ", foto = ?";
            $params[] = $foto; // Adiciona a foto
        }
    
        // Finaliza a consulta
        $query .= " WHERE cpf = ?";
        $params[] = $cpf; // Adiciona o CPF no final
    
        // Verifique o número de parâmetros e o número de tokens
        $numTokens = substr_count($query, '?'); // Conta quantos ? existem na consulta
        if (count($params) !== $numTokens) {
            throw new Exception("Número de parâmetros não corresponde ao número de tokens na consulta. Tokens: $numTokens, Parâmetros: " . count($params));
        }
    
        // Prepara e executa a consulta
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($params); // Executa a consulta
    }
    
    
    
}
?>
