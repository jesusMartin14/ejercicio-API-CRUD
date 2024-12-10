<?php

//Conexión a la base de datos MySQL

class DBConnection extends PDO
{
    protected $host = 'localhost';
    protected $dbname = 'app';
    protected $user = 'root';
    protected $password = '';

    public function __construct()
    {
        parent::__construct('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->user, $this->password);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
}
