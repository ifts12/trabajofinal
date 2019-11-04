<?php

namespace UPCN;

class Hotel extends Comun
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $estrellas;
    
    /**
     * @var string
     */
    private $nombre;
    
    /**
     * @var string
     */
    private $foto;
    
    /**
     * @var integer
     */
    private $id_provincia;
    
    /**
     * @var float
     */
    private $precio;
    
    /**
     * @var integer
     */
    private $cantidad;
    
    
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
    public function getEstrellas()
    {
        return $this->estrellas;
    }

    /**
     * @param number $estrellas
     */
    public function setEstrellas($estrellas)
    {
        $this->estrellas = $estrellas;
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

    
    

}