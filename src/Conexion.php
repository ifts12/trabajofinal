<?php

namespace UPCN;

use UPCN\Config;

class Conexion
{
    
    protected $conexion;
    
    public function __construct()
    {
		$config = new Config();
	   
        try
        {
            $this->conexion = new \PDO($config->getDSN(), $config->getUser(), $config->getPass());
        }
        catch (\PDOException $e)
        {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
        return $this->conexion;
    }
    
    public function beginTransaction()
    {
        return $this->conexion->beginTransaction();
    }
    
    public function prepare($sql)
    {
        return $this->conexion->prepare($sql);
    }
    
    public function rollBack()
    {
        return $this->conexion->rollBack();
    }
    
    public function commit()
    {
        return $this->conexion->commit();
    }
    
}