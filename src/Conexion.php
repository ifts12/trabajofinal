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
    
    public function execute($self, $statement, $msg, $param = NULL)
    {
        try
        {
            if(empty($param))
            {
                if($statement->execute())
                {
                    $self->setMsg('success', $msg);
                    $this->conexion->commit();
                    return TRUE;
                }
                else
                {
                    
                    $self->setMsg('danger', 'Codigo: ' . $statement->errorInfo()[0] . ', Error: (' . $statement->errorInfo()[1] . ') ' . $statement->errorInfo()[2]);
                    $this->conexion->rollBack();
                    return FALSE;
                }
            }
            else 
            {
                if($statement->execute($param))
                {
                    $self->setMsg('success', $msg);
                    $this->conexion->commit();
                    return TRUE;
                }
                else
                {
                    
                    $self->setMsg('danger', 'Codigo: ' . $statement->errorInfo()[0] . ', Error: (' . $statement->errorInfo()[1] . ') ' . $statement->errorInfo()[2]);
                    $this->conexion->rollBack();
                    return FALSE;
                }
            }
        }
        catch(\Exception $e)
        {
            $self->setMsg('danger', 'Codigo: ' . $e->getCode() . ', Error: ' . $e->getMessage());
            $this->conexion->rollBack();
            return FALSE;
        }
    }
    
}