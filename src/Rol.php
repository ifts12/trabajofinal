<?php

namespace UPCN;

class Rol extends Comun
{
    /**
     * ID
     * @var integer
     */
    private $id;
    
    /**
     * Rol
     * @var string
     */
    private $rol;
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param string $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }



}