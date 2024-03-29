<?php

namespace UPCN;

class Compra extends Comun
{
    /**
     * @var integer
     */
    protected $id;
    
    /**
     * @var integer
     */
    protected $dni;
    
    /**
     * @var integer
     */
    protected $id_adicional;
    
    /**
     * @var integer
     */
    protected $id_asistencia_medica;
    
    /**
     * @var integer
     */
    protected $id_viaje;
    
    /**
     * @var integer
     */
    protected $id_hotel;
    
    /**
     * @var integer
     */
    protected $cantidad_afiliados;
    
    /**
     * @var integer
     */
    protected $cantidad_invitados;
    
    /**
     * @var float
     */
    protected $precio_final;
    
    
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTabla('compra');
        $this->required = [
            'dni',
            'id_provincia',
            'id_asistencia_medica',
            'cantidad_invitados',
            'cantidad_invitados',
            'precio_final'
        ];
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::select()
     */
    public function selectViaje($dni = NULL)
    {
        if(empty($dni))
        {
            return FALSE;
        }
        $sql = 'SELECT c.*, am.*, v.*, p.nombre AS provincia, tv.nombre AS tipoViaje FROM ' . $this->getTabla() . ' c LEFT JOIN asistencia_medica am ON c.id_asistencia_medica = am.id LEFT JOIN viaje v ON c.id_viaje = v.id LEFT JOIN provincia p ON v.id_provincia = p.id LEFT JOIN tipo_viaje tv ON v.id_tipo_viaje = tv.id  WHERE dni=:dni AND c.id_viaje IS NOT NULL';

        $this->con->beginTransaction();
        $statement = $this->con->prepare($sql);
        if($statement->execute([':dni' => $dni]))
        {
            $this->con->commit();
            $row = $statement->fetchAll(\PDO::FETCH_ASSOC);
            if (!empty($row))
            {
                return $row;
            }
        }
        return FALSE;
    }
    
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::select()
     */
    public function selectHotel($dni = NULL)
    {
        if(empty($dni))
        {
            return FALSE;
        }
        $sql = 'SELECT c.*, am.*, h.*, p.nombre AS provincia FROM ' . $this->getTabla() . ' c LEFT JOIN asistencia_medica am ON c.id_asistencia_medica = am.id LEFT JOIN hotel h ON c.id_hotel = h.id LEFT JOIN provincia p ON h.id_provincia = p.id WHERE dni=:dni AND c.id_hotel IS NOT NULL';

        $this->con->beginTransaction();
        $statement = $this->con->prepare($sql);
        if($statement->execute([':dni' => $dni]))
        {
            $this->con->commit();
            $row = $statement->fetchAll(\PDO::FETCH_ASSOC);
            if (!empty($row))
            {
                return $row;
            }
        }
        return FALSE;
    }
    
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::select()
     */
    public function select($dni = NULL)
    {
        if(empty($dni))
        {
            return FALSE;
        }
        $sql = 'SELECT c.*, am.*, v.*, h.*, p.nombre AS provincia, prov.nombre AS prov FROM ' . $this->getTabla() . ' c LEFT JOIN asistencia_medica am ON c.id_asistencia_medica = am.id LEFT JOIN viaje v ON c.id_viaje = v.id LEFT JOIN hotel h ON c.id_hotel = h.id LEFT JOIN provincia p ON v.id_provincia = p.id LEFT JOIN provincia prov ON h.id_provincia = prov.id WHERE dni=:dni';
        
        $this->con->beginTransaction();
        $statement = $this->con->prepare($sql);
        if($statement->execute([':dni' => $dni]))
        {
            $this->con->commit();
            $row = $statement->fetchAll(\PDO::FETCH_ASSOC);
            if (!empty($row))
            {
                return $row;
            }
        }
        return FALSE;
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::insert()
     * return boolean
     */
    public function insert()
    {
        $this->con->beginTransaction();
        $sql = sprintf('INSERT INTO %s (dni, id_asistencia_medica, cantidad_afiliados, cantidad_invitados, precio_final', $this->getTabla());
        $values = sprintf('VALUES (:dni, :id_asistencia_medica, :cantidad_afiliados, :cantidad_invitados, :precio_final');
        $param = [':dni' => $this->getDni(), ':id_asistencia_medica' => $this->getId_asistencia_medica(), ':cantidad_afiliados' => $this->getCantidad_afiliados(), ':cantidad_invitados' => $this->getCantidad_invitados(), ':precio_final' => $this->getPrecio_final()];
        
        if(!empty($this->getId_adicional()))
        {
            $sql .= sprintf(', id_adicional');
            $values .= sprintf(', :id_adicional');
            $param[':id_adicional'] = $this->getId_adicional(); 
        }
        
        if(!empty($this->getId_viaje()))
        {
            $sql .= sprintf(', id_viaje');
            $values .= sprintf(', :id_viaje');
            $param[':id_viaje'] = $this->getId_viaje(); 
        }
        
        if(!empty($this->getId_hotel()))
        {
            $sql .= sprintf(', id_hotel');
            $values .= sprintf(', :id_hotel');
            $param[':id_hotel'] = $this->getId_hotel(); 
        }
        
        $sql .= sprintf(') ');
        $values .= sprintf(')');
        $statement = $this->con->prepare($sql . $values);
        return $this->con->execute($this, $statement, "Gracias por su compra!!!.", $param);
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
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param integer $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * @return integer
     */
    public function getId_adicional()
    {
        return $this->id_adicional;
    }

    /**
     * @param integer $id_adicional
     */
    public function setId_adicional($id_adicional)
    {
        $this->id_adicional = $id_adicional;
    }

    /**
     * @return integer
     */
    public function getId_asistencia_medica()
    {
        return $this->id_asistencia_medica;
    }

    /**
     * @param integer $id_asistencia_medica
     */
    public function setId_asistencia_medica($id_asistencia_medica)
    {
        $this->id_asistencia_medica = $id_asistencia_medica;
    }

    /**
     * @return integer
     */
    public function getId_viaje()
    {
        return $this->id_viaje;
    }

    /**
     * @param integer $id_viaje
     */
    public function setId_viaje($id_viaje)
    {
        $this->id_viaje = $id_viaje;
    }

    /**
     * @return integer
     */
    public function getId_hotel()
    {
        return $this->id_hotel;
    }

    /**
     * @param integer $id_hotel
     */
    public function setId_hotel($id_hotel)
    {
        $this->id_hotel = $id_hotel;
    }

    /**
     * @return integer
     */
    public function getCantidad_afiliados()
    {
        return $this->cantidad_afiliados;
    }

    /**
     * @param integer $cantidad_afiliados
     */
    public function setCantidad_afiliados($cantidad_afiliados)
    {
        $this->cantidad_afiliados = $cantidad_afiliados;
    }

    /**
     * @return integer
     */
    public function getCantidad_invitados()
    {
        return $this->cantidad_invitados;
    }

    /**
     * @param integer $cantidad_invitados
     */
    public function setCantidad_invitados($cantidad_invitados)
    {
        $this->cantidad_invitados = $cantidad_invitados;
    }

    /**
     * @return float
     */
    public function getPrecio_final()
    {
        return $this->precio_final;
    }

    /**
     * @param float $precio_final
     */
    public function setPrecio_final($precio_final)
    {
        $this->precio_final = $precio_final;
    }

    
    
}