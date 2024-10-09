<?php

namespace Ezanon\Pessoaslocal;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class DB
{
    private static $instance = null;

    public static function getConnection()
    {
        if (!self::$instance) {

            $connection = getenv("DB_CONNECTION");
            $host = getenv("DB_HOST");
            $db = getenv("DB_DATABASE");
            $user = getenv("DB_USERNAME");
            $password = getenv("DB_PASSWORD");
            $port = getenv("DB_PORT");

            // Monta o DSN com base no tipo de conexão
            if ($connection === 'mysql') {
                $dsn = "mysql:host=$host;port=$port;dbname=$db";
            } else {
                throw new PDOException("Conexão $connection não suportada.");
            }

            try {
                self::$instance = new PDO($dsn, $user, $password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Erro de conexão: " . $e->getMessage();
                die();
            }
        }

        return self::$instance;
    }
}



//    public static function getConnection()
//    {
//        if (!self::$instance) {
//            // Carregar variáveis de ambiente do arquivo .env
//            $dotenv = Dotenv::createImmutable(__DIR__ . '/../'); // Corrigido para o caminho correto
//            $dotenv->load();
//
//            // Recuperar as variáveis de ambiente
//            $connection = getenv('DB_CONNECTION');
//            $host = getenv('DB_HOST');
//            $db = getenv('DB_DATABASE');
//            $user = getenv('DB_USERNAME');
//            $password = getenv('DB_PASSWORD');
//            $port = getenv('DB_PORT') ?: 3306;
//
//            // Montar o DSN com base no tipo de conexão
//            if ($connection === 'mysql') {
//                $dsn = "mysql:host=$host;port=$port;dbname=$db";
//            } else {
//                throw new PDOException("Conexão $connection não suportada.");
//            }
//
//            try {
//                self::$instance = new PDO($dsn, $user, $password);
//                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            } catch (PDOException $e) {
//                echo "Erro de conexão: " . $e->getMessage();
//                die();
//            }
//        }
//
//        return self::$instance;
//    }

