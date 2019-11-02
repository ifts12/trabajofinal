<?php

namespace UPCN;

class Adicional extends Comun
{
    /**
     * ID
     * @var integer
     */
    private $id;
    
    /**
     * @var float
     */
    private $precio;
    
    /**
     * @var string
     */
    private $detalle;
    
    
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
     * @return number
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param number $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * @return string
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * @param string $detalle
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
    }

    

}