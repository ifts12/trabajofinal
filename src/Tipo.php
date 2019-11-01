<?php

namespace UPCN;

class Tipo extends Comun
{
    /**
     * ID
     * @var integer
     */
    private $id;
    
    /**
     * Nombre
     * @var string
     */
    private $nombre;
    
    
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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }




}