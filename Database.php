<?php

class Database
{        
    private $_connection;
    private static $_instance; // La instancia única
    private $_host = "localhost";
    private $_username = "root";
    private $_password = "";
    private $_database = "tarea1";  // Nombre de tu base de datos

    /*
    Obtener una instancia de la base de datos
    @return Instance
    */
    public static function getInstance()
    {
        if(!self::$_instance) // Si no existe una instancia, crear una
        { 
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Constructor
    public function __construct()
    {
        $this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
        // Manejo de errores
        if(mysqli_connect_error())
        {
            trigger_error("Error al conectar con MySQL: " . mysqli_connect_error(), E_USER_ERROR);
        }
    }

    // Método para prevenir la clonación de la conexión
    public function __clone() { }

    // Obtener la conexión mysqli
    public function getConnection()
    {
        return $this->_connection;
    }

    // Ejecutar una consulta SELECT y obtener los datos
    public function get_data($sql)
    {
        $ret = array('STATUS'=>'ERROR', 'ERROR'=>'', 'DATA'=>array());

        $mysqli = $this->getConnection();
        $res = $mysqli->query($sql);

        if($res)
            $ret['STATUS'] = "OK";
        else
            $ret['ERROR'] = mysqli_error();

        while($row = $res->fetch_array(MYSQLI_ASSOC))
        {
            $ret['DATA'][] = $row;
        }
        return $ret;
    }

    // Ejecutar cualquier consulta (INSERT, UPDATE, DELETE)
    public function exec($sql)
    {
        $ret = array('STATUS'=>'ERROR', 'ERROR'=>'');

        $mysqli = $this->getConnection();
        $res = $mysqli->query($sql);

        if($res)
            $ret['STATUS'] = "OK";
        else
            $ret['ERROR'] = mysqli_error();

        return $ret;
    }
} // Esta es la llave de cierre que estaba faltando

?>
