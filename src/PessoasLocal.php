<?php

namespace Ezanon\Pessoaslocal;

use PDO;
use PDOException;

class PessoasLocal
{
    private $pdo;

    // Construtor agora usa a conexão do DB
    public function __construct()
    {
        $this->pdo = DB::getConnection();
    }

    // Método para inserir um registro com apenas o codpes
    public function inserirPessoa($codpes)
    {
        $sql = "INSERT INTO pessoas (codpes) VALUES (:codpes)";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':codpes', $codpes, PDO::PARAM_INT);
            $stmt->execute();
            return $this->pdo->lastInsertId(); // Retorna o ID da última inserção
        } catch (PDOException $e) {
            echo "Erro ao inserir pessoa: " . $e->getMessage();
            return false;
        }
    }

    // Método para buscar um registro pelo ID
    public function buscarPessoa($id)
    {
        $sql = "SELECT * FROM pessoas WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao buscar pessoa: " . $e->getMessage();
            return false;
        }
    }

    // Método para atualizar apenas o campo ODS
    public function atualizarODS($id, $ods)
    {
        $sql = "UPDATE pessoas SET ods = :ods WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':ods', $ods, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar ODS: " . $e->getMessage();
            return false;
        }
    }

    // Método para obter o campo ODS de uma pessoa
    public function obterODS($codpes)
    {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("SELECT ods FROM pessoas WHERE codpes = :codpes");
        $stmt->bindParam(':codpes', $codpes, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn();
    }


}
