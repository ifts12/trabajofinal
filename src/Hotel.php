<?php

namespace UPCN;

class Hotel extends Comun
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $estrellas;
    
    /**
     * @var string
     */
    protected $nombre;
    
    /**
     * @var string
     */
    protected $foto;
    
    /**
     * @var integer
     */
    protected $id_provincia;
    
    /**
     * @var float
     */
    protected $precio;
    
    /**
     * @var integer
     */
    protected $cantidad;
    
    
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTabla('hotel');
        $this->required = [
            'estrellas',
            'nombre',
            'id_provincia',
            'precio',
            'cantidad'
        ];
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::select()
     */
    public function select()
    {
        return $this->findAll('SELECT t.*, p.nombre AS provincia FROM ' . $this->getTabla() . ' t LEFT JOIN provincia p ON t.id_provincia=p.id');
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::insert()
     * return boolean
     */
    public function insert()
    {
        $this->con->beginTransaction();
        $statement = $this->con->prepare('INSERT INTO ' . $this->getTabla() . ' (nombre, id_provincia, foto, estrellas, precio, cantidad) VALUES (:nombre, :id_provincia, :foto, :estrellas, :precio, :cantidad)');
        $statement->bindValue(':nombre', $this->getNombre(), \PDO::PARAM_STR);
        $statement->bindValue(':id_provincia', $this->getId_provincia(), \PDO::PARAM_INT);
        $statement->bindValue(':foto', $this->getFoto(), \PDO::PARAM_STR);
        $statement->bindValue(':estrellas', $this->getEstrellas(), \PDO::PARAM_INT);
        $statement->bindValue(':precio', $this->getPrecio(), \PDO::PARAM_INT);
        $statement->bindValue(':cantidad', $this->getCantidad(), \PDO::PARAM_INT);
        return $this->con->execute($this, $statement, "Se guardaron los datos correctamente.");
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::update()
     */
    public function update()
    {
        $this->con->beginTransaction();
        $sql = sprintf('UPDATE %s SET nombre=:nombre, id_provincia=:id_provincia, foto=:foto, estrellas=:estrellas, precio=:precio, cantidad=:cantidad WHERE id=:id', $clase->getTabla());
        
        $statement = $this->con->prepare($sql);
        $statement->bindValue(':nombre', $this->getNombre(), \PDO::PARAM_STR);
        $statement->bindValue(':id_provincia', $this->getId_provincia(), \PDO::PARAM_INT);
        $statement->bindValue(':foto', $this->getFoto(), \PDO::PARAM_STR);
        $statement->bindValue(':estrellas', $this->getEstrellas(), \PDO::PARAM_INT);
        $statement->bindValue(':precio', $this->getPrecio(), \PDO::PARAM_STR);
        $statement->bindValue(':cantidad', $this->getCantidad(), \PDO::PARAM_INT);
        $statement->bindValue(':id', $this->getId(), \PDO::PARAM_INT);
        return $this->con->execute($this, $statement, "Se actualizaron los datos correctamente.");
    }
    
//     /**
//      * {@inheritDoc}
//      * @see \UPCN\PdoABM::delete()
//      */
//     public function delete()
//     {
//         $this->con->beginTransaction();
        
//         $sql = sprintf('DELETE FROM %s WHERE id=:id', $this->getTabla());
//         $statement = $this->con->prepare($sql);
//         $statement->bindValue(':id', $this->getId(), \PDO::PARAM_INT);
//         $this->con->execute($this, $statement, "Se borraron los datos correctamente.");
//     }
    
    
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