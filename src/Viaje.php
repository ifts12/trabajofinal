<?php

namespace UPCN;

class Viaje extends Comun
{
    /**
     * ID
     * @var integer
     */
    private $id;
    
    /**
     * @var string
     */
    private $foto;
    
    /**
     * Provincia
     * @var integer
     */
    private $id_provincia;
    
    /**
     * @var string
     */
    private $lugar;
    
    /**
     * @var float
     */
    private $precio;
    
    /**
     * @var string
     */
    private $detalle;
    
    /**
     * @var string
     */
    private $dias;
    
    /**
     * @var integer
     */
    private $cantidad;
    
    /**
     * Tipo
     * @var integer
     */
    private $id_tipo;
    
    
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
    public function getId_provincia()
    {
        return $this->id_provincia;
    }

    /**
     * @param number $id_provincia
     */
    public function setId_provincia($id_provincia)
    {
        $this->id_provincia = $id_provincia;
    }

    /**
     * @return string
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * @param string $lugar
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;
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

    /**
     * @return string
     */
    public function getDias()
    {
        return $this->dias;
    }

    /**
     * @param string $dias
     */
    public function setDias($dias)
    {
        $this->dias = $dias;
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
    public function getId_tipo()
    {
        return $this->id_tipo;
    }

    /**
     * @param number $id_tipo
     */
    public function setId_tipo($id_tipo)
    {
        $this->id_tipo = $id_tipo;
    }
    
    /**
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param string $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }


}