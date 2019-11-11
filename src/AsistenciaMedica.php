<?php

namespace UPCN;

class AsistenciaMedica extends Comun
{
    protected $tabla = 'asistencia_medica';
    
    /**
     * ID
     * @var integer
     */
    protected $id;
    
    /**
     * @var float
     */
    protected $precio;
    
    /**
     * @var string
     */
    protected $detalle;
    
    
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTabla('asistencia_medica');
        $this->required = [
            'precio',
            'detalle'
        ];
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::insert()
     * return boolean
     */
    public function insert()
    {
        $this->con->beginTransaction();
        $statement = $this->con->prepare('INSERT INTO ' . $this->getTabla() . ' (precio, detalle) VALUES (:precio, :detalle)');
        $statement->bindValue(':precio', $this->getPrecio(), \PDO::PARAM_STR);
        $statement->bindValue(':detalle', $this->getDetalle(), \PDO::PARAM_STR);
        return $this->con->execute($this, $statement, "Se guardaron los datos correctamente.");
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::update()
     */
    public function update()
    {
        $this->con->beginTransaction();
        $sql = sprintf('UPDATE %s SET precio=:precio, detalle=:detalle WHERE id=:id', $this->getTabla());
        
        $statement = $this->con->prepare($sql);
        $statement->bindValue(':precio', $this->getPrecio(), \PDO::PARAM_STR);
        $statement->bindValue(':detalle', $this->getDetalle(), \PDO::PARAM_STR);
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


    

}