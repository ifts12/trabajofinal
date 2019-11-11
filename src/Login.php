<?php

namespace UPCN;

class Login extends Comun
{
    protected $rol = null;
    
    protected $required;
    
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Chequea el login
     * 
     * @param integer $dni
     * @return boolean
     */
    public function login($dni)
    {
        if(empty($dni))
        {
            $this->setMsg('danger', 'Error en login!');
            return false;
        }
        
        $this->con->beginTransaction();
        $statement = $this->con->prepare('SELECT * FROM perfil WHERE dni=:dni');
        $statement->bindValue(':dni', $dni, \PDO::PARAM_INT);
        
        if($statement->execute())
        {
            $this->con->commit();
            $row = $statement->fetch(\PDO::FETCH_ASSOC);
            if (password_verify($this->getPass(), $row['pass']))
            {
                return true;
            }
            else
            {
                $this->setMsg('danger', 'Error en login');
                return false;
            }
        }
    }
    
    public function checkPass()
    {
        if($this->getPass() === $this->getPass2() && !(empty($this->getPass()) || empty($this->getPass2())))
        {
            return true;
        }
        return false;
    }
    
    /**
     * @return mixed
     */
    public function getRol($id = null)
    {
        $this->con->beginTransaction();
        $statement = $this->con->prepare('SELECT * FROM rol WHERE id=:id');
        
        if(is_null($id))
        {
            $statement->bindValue(':id', $this->getId_rol(), \PDO::PARAM_INT);
        }
        else
        {
            $statement->bindValue(':id', filter_var($id, FILTER_SANITIZE_NUMBER_INT), \PDO::PARAM_INT);
        }
        
        if($statement->execute())
        {
            $this->con->commit();
            $row = $statement->fetch(\PDO::FETCH_ASSOC);
            $this->rol = $row['rol']; 
        }
        return $this->rol;
    }

    public function hasRol($rol)
    {
        if((is_array($rol) && array_keys($rol, $this->getRol())) || $this->getRol() === $rol)
        {
            return true;
        }
        return false;
    }


}