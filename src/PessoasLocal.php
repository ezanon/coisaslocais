<?php

namespace Ezanon\CoisasLocais;

use PDO;
use PDOException;

class PessoasLocal
{
    private static $pdo; // Propriedade estática para armazenar a conexão

    // Método estático para garantir que a conexão seja estabelecida uma vez
    private static function getConnection()
    {
        if (self::$pdo === null) {
            self::$pdo = DB::getConnection(); // Conexão é estabelecida apenas uma vez
        }
        return self::$pdo;
    }

    // Método estático para inserir um registro com apenas o codpes
    public static function inserirPessoa($codpes)
    {
        $pdo = self::getConnection();
        $sql = "INSERT INTO pessoas (codpes) VALUES (:codpes)";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codpes', $codpes, PDO::PARAM_INT);
            $stmt->execute();
            return $pdo->lastInsertId(); // Retorna o ID da última inserção
        } catch (PDOException $e) {
            echo "Erro ao inserir pessoa: " . $e->getMessage();
            return false;
        }
    }

    // Método estático para buscar um registro pelo ID
    public static function buscarPessoa($id)
    {
        $pdo = self::getConnection();
        $sql = "SELECT * FROM pessoas WHERE id = :id";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao buscar pessoa: " . $e->getMessage();
            return false;
        }
    }

    // Método estático para atualizar apenas o campo ODS
    public static function atualizarODS($id, $ods)
    {
        $pdo = self::getConnection();
        $sql = "UPDATE pessoas SET ods = :ods WHERE id = :id";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':ods', $ods, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar ODS: " . $e->getMessage();
            return false;
        }
    }

    // Método estático para obter o campo ODS de uma pessoa
    public static function obterODS($codpes)
    {
        $pdo = self::getConnection();
        $sql = "SELECT ods FROM pessoas WHERE codpes = :codpes";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codpes', $codpes, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo "Erro ao obter ODS: " . $e->getMessage();
            return false;
        }
    }
}
