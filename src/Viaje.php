<?php

namespace UPCN;

class Viaje extends Comun
{
    /**
     * ID
     * @var integer
     */
    protected $id;
    
    /**
     * Tipo
     * @var integer
     */
    protected $id_tipo_paquete;
    
    /**
     * @var string
     */
    protected $foto;
    
    /**
     * Provincia
     * @var integer
     */
    protected $id_provincia;
    
    /**
     * @var string
     */
    protected $lugar;
    
    /**
     * @var float
     */
    protected $precio;
    
    /**
     * @var string
     */
    protected $detalle;
    
    /**
     * @var integer
     */
    protected $dias;
    
    /**
     * @var integer
     */
    protected $noches;
    
    /**
     * @var \DateTime
     */
    protected $fecha_desde;

    /**
     * @var \DateTime
     */
    protected $fecha_hasta;

    
    
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTabla('viaje');
        $this->required = [
            'id_tipo_paquete',
            'id_provincia',
            'lugar',
            'precio',
            'detalle',
            'dias',
            'noches',
            'fecha_desde',
            'fecha_hasta'
        ];
    }
    
    
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::select()
     */
    public function select()
    {
        return $this->findAll('SELECT v.*, p.nombre AS provincia, t.nombre AS tipo FROM ' . $this->getTabla() . ' v LEFT JOIN provincia p ON v.id_provincia=p.id LEFT JOIN tipo t ON v.id_tipo=t.id');
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::insert()
     * return boolean
     */
    public function insert()
    {
        $this->con->beginTransaction();
        $statement = $this->con->prepare('INSERT INTO viaje (id_tipo_paquete, foto, id_provincia, lugar, precio, detalle, dias, noches, fecha_desde, fecha_hasta) VALUES (:id_tipo_paquete, :foto, :id_provincia, :lugar, :precio, :detalle, :dias, :noches, :fecha_desde, :fecha_hasta)');
        $statement->bindValue(':id_tipo_paquete', $this->getId_tipo(), \PDO::PARAM_INT);
        $statement->bindValue(':foto', $this->getLugar(), \PDO::PARAM_STR);
        $statement->bindValue(':id_provincia', $this->getId_provincia(), \PDO::PARAM_INT);
        $statement->bindValue(':lugar', $this->getLugar(), \PDO::PARAM_STR);
        $statement->bindValue(':precio', $this->getPrecio(), \PDO::PARAM_INT);
        $statement->bindValue(':detalle', $this->getDetalle(), \PDO::PARAM_STR);
        $statement->bindValue(':dias', $this->getDias(), \PDO::PARAM_INT);
        $statement->bindValue(':noches', $this->getNoches(), \PDO::PARAM_INT);
        $statement->bindValue(':fecha_desde', $this->getFecha_desde(), \PDO::PARAM_STR);
        $statement->bindValue(':fecha_hasta', $this->getFecha_hasta(), \PDO::PARAM_STR);
        return $this->con->execute($this, $statement, "Se guardaron los datos correctamente.");
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::update()
     */
    public function update()
    {
        $this->con->beginTransaction();
        $sql = sprintf('UPDATE %s SET id_tipo_paquete=:id_tipo_paquete, foto=:foto, id_provincia=:id_provincia, lugar=:lugar, precio=:precio, detalle=:detalle, dias=:dias, noches=:noches, fecha_desde=:fecha_desde, fecha_hasta=:fecha_hasta WHERE id=:id', $this->getTabla());
        
        $statement = $this->con->prepare($sql);
        $statement->bindValue(':id_tipo_paquete', $this->getId_tipo(), \PDO::PARAM_INT);
        $statement->bindValue(':foto', $this->getLugar(), \PDO::PARAM_STR);
        $statement->bindValue(':id_provincia', $this->getId_provincia(), \PDO::PARAM_INT);
        $statement->bindValue(':lugar', $this->getLugar(), \PDO::PARAM_STR);
        $statement->bindValue(':precio', $this->getPrecio(), \PDO::PARAM_INT);
        $statement->bindValue(':detalle', $this->getDetalle(), \PDO::PARAM_STR);
        $statement->bindValue(':dias', $this->getDias(), \PDO::PARAM_INT);
        $statement->bindValue(':noches', $this->getNoches(), \PDO::PARAM_INT);
        $statement->bindValue(':fecha_desde', $this->getFecha_desde(), \PDO::PARAM_STR);
        $statement->bindValue(':fecha_hasta', $this->getFecha_hasta(), \PDO::PARAM_STR);
        $statement->bindValue(':id', $this->getId(), \PDO::PARAM_INT);
        return $this->con->execute($this, $statement, "Se actualizaron los datos correctamente.");
    }
    
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
    /**
     * @return number
     */
    public function getId_tipo_paquete()
    {
        return $this->id_tipo_paquete;
    }

    /**
     * @param number $id_tipo_paquete
     */
    public function setId_tipo_paquete($id_tipo_paquete)
    {
        $this->id_tipo_paquete = $id_tipo_paquete;
    }

    /**
     * @return number
     */
    public function getNoches()
    {
        return $this->noches;
    }

    /**
     * @param number $noches
     */
    public function setNoches($noches)
    {
        $this->noches = $noches;
    }

    /**
     * @return \DateTime
     */
    public function getFecha_desde()
    {
        return $this->fecha_desde;
    }

    /**
     * @param \DateTime $fecha_desde
     */
    public function setFecha_desde($fecha_desde)
    {
        $this->fecha_desde = $fecha_desde;
    }

    /**
     * @return \DateTime
     */
    public function getFecha_hasta()
    {
        return $this->fecha_hasta;
    }

    /**
     * @param \DateTime $fecha_hasta
     */
    public function setFecha_hasta($fecha_hasta)
    {
        $this->fecha_hasta = $fecha_hasta;
    }



}