<?php

namespace application\libs;

use PDO;
use PDOException;

class Db
{
    public $db;

    public function __construct()
    {
        $this->db_connection();
    }

    private function db_connection(): void
    {
        try {
            $config = require_once('./application/config/db.php');
            $this->db = new PDO('mysql:host=' . $config['DBHOST'] . ';dbname=' . $config['DBNAME'] . '', $config['DBUSER'], $config['DBPASS'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $this->db->bindValue(':' . $key, $val);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function row($sql)
    {
        $result = $this->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql)
    {
        $result = $this->query($sql);
        return $result->fetchColumn();
    }
}
