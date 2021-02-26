<?php
namespace App\Core\Database;

/**
 * SQLite connnection PHP DATA OBJECT
 */

class Connection
{
    public static function make()
    {
        try {
            return new \PDO("sqlite:".$_SERVER['DOCUMENT_ROOT'].'/app/core/database/sinuca.db');
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}