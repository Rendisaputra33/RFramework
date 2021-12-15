<?php

namespace Rendi\Rframework\App\Core\Database;

use Rendi\Rframework\App\Core\Database\Config;

class Database extends Config
{
    protected static ?\PDO $dbConnect = null;

    public static function getConnection(?string $env)
    {
        // 
        if (self::$dbConnect === null) {
            // 
            $config = new Config();
            $options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];
            // 
            try {
                self::$dbConnect = new \PDO(
                    "mysql:host=$config->host:$config->port;dbname=$config->db",
                    $config->username,
                    $config->password,
                    $options
                );
            } catch (\PDOException $e) {
                self::envException($e);
            }
        }
        return self::$dbConnect;
    }
    // connection error handler
    private static function envException(\PDOException $e)
    {
        if ($_ENV['APP_ENV'] === 'development') {
            echo $e->getMessage();
            exit();
        } else {
            throw new \Exception($e->getMessage());
            exit();
        }
    }
    /**
     * set binding 
     */
    public function setBinding(string $key, mixed $value, $type = null): ?array
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                    return ['t' => $type, 'v' => $value, 'k' => $key];
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    return ['t' => $type, 'v' => $value, 'k' => $key];
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    return ['t' => $type, 'v' => $value, 'k' => $key];
                default:
                    $type = \PDO::PARAM_STR;
                    return ['t' => $type, 'v' => $value, 'k' => $key];
            }
        }
        return null;
    }
    /**
     * 
     */
    public static function beginTransaction(): void
    {
        try {
            self::$dbConnect->beginTransaction();
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
            die();
        }
    }

    /**
     * rollback transaction
     */
    public static function rollbackTransaction(): void
    {
        try {
            self::$dbConnect->rollBack();
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
            die();
        }
    }

    /**
     * @return mixed|string
     */
    public static function commitTransaction(): void
    {
        try {
            self::$dbConnect->commit();
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
            die();
        }
    }
}
