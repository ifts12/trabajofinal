<?php

namespace UPCN;

class Rol extends Comun
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
    protected $rol;
    
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTabla('rol');
        $this->required = [
            'rol'
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
        $statement = $this->con->prepare('INSERT INTO ' . $this->getTabla() . ' (rol) VALUES (:rol)');
        $statement->bindValue(':rol', $this->getRol(), \PDO::PARAM_STR);
        return $this->con->execute($this, $statement, "Se guardaron los datos correctamente.");
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::update()
     */
    public function update()
    {
        $this->con->beginTransaction();
        $sql = sprintf('UPDATE %s SET rol=:rol WHERE id=:id', $this->getTabla());
        
        $statement = $this->con->prepare($sql);
        $statement->bindValue(':rol', $this->getRol(), \PDO::PARAM_STR);
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
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param string $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }



}