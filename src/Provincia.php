<?php

namespace UPCN;

class Provincia extends Comun
{
    /**
     * ID
     * @var integer
     */
    protected $id;
    
    /**
     * Rol
     * @var string
     */
    protected $nombre;
    
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTabla('provincia');
    }
    
    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
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