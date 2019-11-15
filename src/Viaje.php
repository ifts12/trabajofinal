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
    protected $id_tipo_viaje;
    
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
            'id_tipo_viaje',
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
        return $this->findAll('SELECT v.*, p.nombre AS provincia, t.nombre AS tipo_viaje FROM ' . $this->getTabla() . ' v LEFT JOIN provincia p ON v.id_provincia=p.id LEFT JOIN tipo_viaje t ON v.id_tipo_viaje=t.id');
    }
    
    /**
     */
    public function findByTipoViaje($tipoViaje = NULL)
    {
     
        if(empty($tipoViaje))
        {
            $tipoViaje = 'Paquete';
        }
        
        $this->con->beginTransaction();
        $sql = 'SELECT v.*, p.nombre AS provincia, t.nombre AS tipo_viaje FROM ' . $this->getTabla() . ' v LEFT JOIN provincia p ON v.id_provincia=p.id LEFT JOIN tipo_viaje t ON v.id_tipo_viaje=t.id WHERE t.nombre=:tipoViaje';
        $statement = $this->con->prepare($sql);
        $statement->bindValue(':tipoViaje', $tipoViaje);
        $res = FALSE;
        if($statement->execute())
        {
            $this->con->commit();
            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        else
        {
            $arr = $statement->errorInfo();
            print_r($arr);
        }
        return $res;
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::insert()
     * return boolean
     */
    public function insert()
    {
        $this->con->beginTransaction();
        $statement = $this->con->prepare('INSERT INTO ' . $this->getTabla() . ' (id_tipo_viaje, foto, id_provincia, lugar, precio, detalle, dias, noches, fecha_desde, fecha_hasta) VALUES (:id_tipo_viaje, :foto, :id_provincia, :lugar, :precio, :detalle, :dias, :noches, :fecha_desde, :fecha_hasta)');
        $statement->bindValue(':id_tipo_viaje', $this->getId_tipo_viaje(), \PDO::PARAM_INT);
        $statement->bindValue(':foto', $this->getLugar(), \PDO::PARAM_STR);
        $statement->bindValue(':id_provincia', $this->getId_provincia(), \PDO::PARAM_INT);
        $statement->bindValue(':lugar', $this->getLugar(), \PDO::PARAM_STR);
        $statement->bindValue(':precio', $this->getPrecio(), \PDO::PARAM_STR);
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
        $sql = sprintf('UPDATE %s SET id_tipo_viaje=:id_tipo_viaje, foto=:foto, id_provincia=:id_provincia, lugar=:lugar, precio=:precio, detalle=:detalle, dias=:dias, noches=:noches, fecha_desde=:fecha_desde, fecha_hasta=:fecha_hasta WHERE id=:id', $this->getTabla());
        
        $statement = $this->con->prepare($sql);
        $statement->bindValue(':id_tipo_viaje', $this->getId_tipo_viaje(), \PDO::PARAM_INT);
        $statement->bindValue(':foto', $this->getLugar(), \PDO::PARAM_STR);
        $statement->bindValue(':id_provincia', $this->getId_provincia(), \PDO::PARAM_INT);
        $statement->bindValue(':lugar', $this->getLugar(), \PDO::PARAM_STR);
        $statement->bindValue(':precio', $this->getPrecio(), \PDO::PARAM_STR);
        $statement->bindValue(':detalle', $this->getDetalle(), \PDO::PARAM_STR);
        $statement->bindValue(':dias', $this->getDias(), \PDO::PARAM_INT);
        $statement->bindValue(':noches', $this->getNoches(), \PDO::PARAM_INT);
        $statement->bindValue(':fecha_desde', $this->getFecha_desde(), \PDO::PARAM_STR);
        $statement->bindValue(':fecha_hasta', $this->getFecha_hasta(), \PDO::PARAM_STR);
        $statement->bindValue(':id', $this->getId(), \PDO::PARAM_INT);
        return $this->con->execute($this, $statement, "Se actualizaron los datos correctamente.");
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
     * @return integer
     */
    public function getId_tipo_viaje()
    {
        return $this->id_tipo_viaje;
    }

    /**
     * @param integer $id_tipo_viaje
     */
    public function setId_tipo_viaje($id_tipo_viaje)
    {
        $this->id_tipo_viaje = $id_tipo_viaje;
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
     * @return integer
     */
    public function getId_provincia()
    {
        return $this->id_provincia;
    }

    /**
     * @param integer $id_provincia
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
     * @return float
     */
    public function getPrecioArg()
    {
        return number_format(floatval($this->precio), 2, ',', '.');
    }

    /**
     * @param float $precio
     */
    public function setPrecioArg($precio)
    {
        $precio = str_replace('.', '', $precio);
        $precio = str_replace(',', '.', $precio);
        $this->precio = $precio;
    }

    /**
     * @return float
     */
    public function getPrecio()
    {
        return floatval($this->precio);
    }

    /**
     * @param float $precio
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
     * @return integer
     */
    public function getDias()
    {
        return $this->dias;
    }

    /**
     * @param integer $dias
     */
    public function setDias($dias)
    {
        $this->dias = $dias;
    }

    /**
     * @return integer
     */
    public function getNoches()
    {
        return $this->noches;
    }

    /**
     * @param integer $noches
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