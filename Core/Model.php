<?php


namespace Core;

use PDO;
use \App\Config;

abstract class Model
{
    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    public static function getDB()
    {
        static $db = null;

        if ($db === null) {

            try {
                $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NANE . ';charset=utf8';
                $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

                return $db;

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

    }
}