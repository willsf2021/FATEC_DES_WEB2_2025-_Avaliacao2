<?php

class DB
{
    private $pdo;
    private $table = 'produtos_artesanais';

    public function __construct()
    {
        $host = 'localhost';
        $dbname = 'artesanato_db';
        $user = 'root';
        $pass = '';

        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
            $this->pdo = new PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    public function conn()
    {
        return $this->pdo;
    }

    public function cadastrar($nome_produto, $descricao, $preco, $categoria)
    {
        $sql = "INSERT INTO {$this->table} (nome_produto, descricao, preco, categoria)
                VALUES (:nome_produto, :preco, :descricao, :categoria)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome_produto', $nome_produto);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':categoria', $categoria);
        return $stmt->execute();
    }

    public function listarTodos()
    {
        $sql = "SELECT id, nome_produto, descricao, preco, categoria FROM {$this->table}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT id, nome_produto, descricao, preco, categoria FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deletar($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public function atualizar($id, $nome_produto, $descricao, $preco, $categoria)
    {
        $sql = "UPDATE {$this->table} 
            SET nome_produto = :nome_produto, 
                descricao = :descricao, 
                preco = :preco, 
                categoria = :categoria 
            WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome_produto', $nome_produto);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':categoria', $categoria);
        return $stmt->execute();
    }
}
