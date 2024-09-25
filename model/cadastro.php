<?php
require_once '../model/conexao.php'; 

class Cadastro
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function create($data)
    {

        if (!isset($data['cip'], $data['cnpj'], $data['cpf'])) {
            return json_encode(['message' => 'Dados inválidos']);
        }

 
        $sql = "INSERT INTO cadastro (cip, cnpj, cpf) VALUES (:cip, :cnpj, :cpf)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':cip', $data['cip'], PDO::PARAM_STR);
        $stmt->bindParam(':cnpj', $data['cnpj'], PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $data['cpf'], PDO::PARAM_STR);

    
        if ($stmt->execute()) {
            return json_encode(['message' => 'Especialista criado com sucesso!']);
        } else {
            return json_encode(['message' => 'Falha ao criar especialista']);
        }
    }
}
