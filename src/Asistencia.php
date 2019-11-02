<?php

namespace UPCN;

class Asistencia extends Comun
{
    /**
     * ID
     * @var integer
     */
    private $id;
    
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