<?php

class Database
{
    private $_connection;
    private static $_instance;
    private $_host = "sql309.infinityfree.com"; // Host de InfinityFree
    private $_username = "if0_38007614";       // Usuario de InfinityFree
    private $_password = "Amaya1603";           // Contraseña de InfinityFree
    private $_database = "if0_38007614_proyecto_final"; // Nombre de la base de datos

    public static function getInstance()
    {
        if (!self::$_instance) { 
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        if ($_SERVER['SERVER_NAME'] === 'localhost') {
            $this->_host = "localhost";
            $this->_username = "root";
            $this->_password = "";
            $this->_database = "tarea1";
        } else {
            $this->_host = "sql309.infinityfree.com"; // Host de InfinityFree
            $this->_username = "if0_38007614";       // Usuario de InfinityFree
            $this->_password = "Amaya1603";           // Contraseña de InfinityFree
            $this->_database = "if0_38007614_proyecto_final"; // Base de datos
        }

        $this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

        if ($this->_connection->connect_error) {
            die("Conexión fallida: " . $this->_connection->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->_connection;
    }

    public function exec($sql)
    {
        $mysqli = $this->getConnection();
        $res = $mysqli->query($sql);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }
}
?>
