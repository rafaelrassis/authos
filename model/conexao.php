<?php

Class Conexao {
    private $pdo;

    private $host = "localhost";
    private $dbname = "authosdb";
    private $user = "root";
    private $senha = "";

    public function Conectar (){
        try{
            $this->pdo = new PDO("mysql:dbname=".$this->dbname.';host='.$this->host,$this->user,$this->senha);
        }

            catch (PDOException $e){
            echo "ERRO DE CONEXAO NO PDO:".$e->getMessage();
            exit();
        }

            catch (Exception $e){
            echo "ERRO não passou da conexão:".$e->getMessage();
            exit();
            }

            return $this->pdo;
}

    }
    ?>