<?php

namespace UPCN;

class Compra extends Comun
{
    /**
     * @var integer
     */
    private $id;
    
    /**
     * @var integer
     */
    private $dni;
    
    /**
     * @var integer
     */
    private $id_adicional;
    
    /**
     * @var integer
     */
    private $id_asist;
    
    /**
     * @var integer
     */
    private $id_viaje;
    
    /**
     * @var integer
     */
    private $id_hotel;
    
    /**
     * @var integer
     */
    private $cantidad;
    
    /**
     * @var float
     */
    private $precio_final;
    
    
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
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param number $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * @return number
     */
    public function getId_adicional()
    {
        return $this->id_adicional;
    }

    /**
     * @param number $id_adicional
     */
    public function setId_adicional($id_adicional)
    {
        $this->id_adicional = $id_adicional;
    }

    /**
     * @return number
     */
    public function getId_asist()
    {
        return $this->id_asist;
    }

    /**
     * @param number $id_asist
     */
    public function setId_asist($id_asist)
    {
        $this->id_asist = $id_asist;
    }

    /**
     * @return number
     */
    public function getId_viaje()
    {
        return $this->id_viaje;
    }

    /**
     * @param number $id_viaje
     */
    public function setId_viaje($id_viaje)
    {
        $this->id_viaje = $id_viaje;
    }

    /**
     * @return number
     */
    public function getId_hotel()
    {
        return $this->id_hotel;
    }

    /**
     * @param number $id_hotel
     */
    public function setId_hotel($id_hotel)
    {
        $this->id_hotel = $id_hotel;
    }

    /**
     * @return number
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @param number $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    /**
     * @return number
     */
    public function getPrecio_final()
    {
        return $this->precio_final;
    }

    /**
     * @param number $precio_final
     */
    public function setPrecio_final($precio_final)
    {
        $this->precio_final = $precio_final;
    }

    
    
    
    
}