<?php

namespace UPCN;

use UPCN\Config;

class Conexion
{
    protected $config;
    protected $conexion;
    
    public function __construct()
    {
        $config = new Config();
        $conf = $config->getConfig('basedatos');
        $dsn = $conf['driver'] . ':dbname=' . $conf['dbname'] . ';host=' . $conf['host'];

        try
        {
            $this->conexion = new \PDO($dsn, $conf['user'], $conf['pass']);
        }
        catch (PDOException $e)
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
    
    
    
//     $calorías = 150;
//     $color = 'red';
//     $gsent = $gbd->prepare('SELECT name, colour, calories
//     FROM fruit
//     WHERE calories < :calories AND colour = :colour');
//     $gsent->bindParam(':calories', $calorías, PDO::PARAM_INT);
//     $gsent->bindParam(':colour', $color, PDO::PARAM_STR, 12);
//     $gsent->execute();
    
    
    
    
    
}