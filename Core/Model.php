<?php


namespace Core;


use PDO;

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
            $host = "localhost";
            $dbname = "mvc";
            $username = "root";
            $password = "";

            try {
                $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

                return $db;

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

    }
}