<?php

namespace UPCN;

class Login extends Comun
{
    /**
     * ID
     * @var integer
     */
    private $dni;
    
    /**
     * Pass
     * @var string
     */
    private $pass;
    
    
    /**
     * @return number
     */
    public function getDni()
    {
        return $this->dni;
    }
    
    /**
     * @param number $id
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }
    
    /**
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }
    
    /**
     * @param string $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }
}