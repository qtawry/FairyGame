<?php

namespace Library;

use \PDO;
use \PDOException;
use \PDORow;
use \PDOStatement;
use Web\Resources\config;

class sqlLibrary {

    public static $PDO = null;

    public function myDatabase() {
        if (self::$PDO == null) {
            try {
                self::$PDO = new PDO('mysql:host=' . config::DB_HOST . ';'
                        . 'dbname=' . config::DB_NAME . '', config::DB_USERNAME, config::DB_PASSWORD);
            } catch (PDOException $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return self::$PDO;
    }

    public function query($string, &$id = 0) {
        $PDO = $this->myDatabase();
        $sql = $PDO->prepare($string);

        if (!$sql) {
            echo $string . '<br />';
            echo "\nPDO::errorInfo():\n";
            print_r($PDO->errorInfo());
        } else {
            $sql->execute();
            $id = $PDO->lastInsertId();
            return $sql->fetchAll();
        }
    }

}

?>
