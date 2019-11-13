<?php

namespace UPCN;

class TipoViaje extends Comun
{
    /**
     * ID
     * @var integer
     */
    protected $id;
    
    /**
     * Nombre
     * @var string
     */
    protected $nombre;
    
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTabla('tipo_viaje');
        $this->required = [
            'nombre'
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
        $statement = $this->con->prepare('INSERT INTO ' . $this->getTabla() . ' (nombre) VALUES (:nombre)');
        $statement->bindValue(':nombre', $this->getNombre(), \PDO::PARAM_STR);
        return $this->con->execute($this, $statement, "Se guardaron los datos correctamente.");
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::update()
     */
    public function update()
    {
        $this->con->beginTransaction();
        $sql = sprintf('UPDATE %s SET nombre=:nombre WHERE id=:id', $this->getTabla());
        
        $statement = $this->con->prepare($sql);
        $statement->bindValue(':nombre', $this->getNombre(), \PDO::PARAM_STR);
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