<?php

namespace UPCN;

class Perfil extends Login
{
    protected $tabla = 'perfil';
    
    protected $id;
    
    protected $dni;
    
    protected $nombre;
    
    protected $apellido;
    
    protected $pass;
    
    protected $pass2;
    
    protected $foto;
    
    protected $telefono;
    
    protected $direccion;
    
    protected $id_provincia;
    
    protected $fecha_nac;
    
    protected $email;
    
    protected $id_rol;
    
    /**
     * Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTabla('perfil');
        $this->required = [
            'dni',
            'nombre',
            'apellido',
            'telefono',
            'direccion',
            'id_provincia',
            'fecha_nac',
            'email',
            'id_rol' 
        ];
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::select()
     */
    public function select()
    {
        return $this->findAll('SELECT * FROM ' . $this->getTabla());
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::insert()
     * return boolean
     */
    public function insert()
    {
        if(!$this->checkPass())
        {
            $this->setMsg('danger', 'Las contraseñas no coinciden o estan vacias');
            return false;
        }
        
        $this->con->beginTransaction();
        $statement = $this->con->prepare('INSERT INTO perfil (dni, nombre, apellido, foto, telefono, direccion, fecha_nac, email, id_rol, id_provincia, pass) VALUES (:dni, :nombre, :apellido, :foto, :telefono, :direccion, :fecha_nac, :email, :id_rol, :id_provincia, :pass)');
        $statement->bindValue(':dni', $this->getDni(), \PDO::PARAM_INT);
        $statement->bindValue(':nombre', $this->getNombre(), \PDO::PARAM_STR);
        $statement->bindValue(':apellido', $this->getApellido(), \PDO::PARAM_STR);
        $statement->bindValue(':foto', $this->getFoto(), \PDO::PARAM_STR);
        $statement->bindValue(':telefono', $this->getTelefono(), \PDO::PARAM_STR);
        $statement->bindValue(':direccion', $this->getDireccion(), \PDO::PARAM_STR);
        $statement->bindValue(':fecha_nac', $this->getFecha_nac(), \PDO::PARAM_STR);
        $statement->bindValue(':email', $this->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue(':id_rol', $this->getId_rol(), \PDO::PARAM_INT);
        $statement->bindValue(':id_provincia', $this->getId_provincia(), \PDO::PARAM_STR);
        $statement->bindValue(':pass', password_hash($this->getPass(), PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]), \PDO::PARAM_STR);
        return $this->con->execute($this, $statement, "Se guardaron los datos correctamente.");
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::update()
     */
    public function update()
    {
        $this->con->beginTransaction();
        
        $sql = 'UPDATE perfil SET nombre=:nombre, apellido=:apellido, foto=:foto, telefono=:telefono, direccion=:direccion, fecha_nac=:fecha_nac, email=:email, id_rol=:id_rol, id_provincia=:id_provincia';
        
        if(!empty($this->getPass()) && $this->checkPass())
        {
            $sql .= ', pass=:pass';
        }
        
        $sql .= ' WHERE dni=:dni';
        
        $statement = $this->con->prepare($sql);

        $statement->bindValue(':dni', $this->getDni(), \PDO::PARAM_INT);
        $statement->bindValue(':nombre', $this->getNombre(), \PDO::PARAM_STR);
        $statement->bindValue(':apellido', $this->getApellido(), \PDO::PARAM_STR);
        $statement->bindValue(':foto', $this->getFoto(), \PDO::PARAM_STR);
        $statement->bindValue(':telefono', $this->getTelefono(), \PDO::PARAM_STR);
        $statement->bindValue(':direccion', $this->getDireccion(), \PDO::PARAM_STR);
        $statement->bindValue(':fecha_nac', $this->getFecha_nac(), \PDO::PARAM_STR);
        $statement->bindValue(':email', $this->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue(':id_rol', $this->getId_rol(), \PDO::PARAM_INT);
        $statement->bindValue(':id_provincia', $this->getId_provincia(), \PDO::PARAM_STR);
        if(!empty($this->getPass()) && $this->checkPass())
        {
            $statement->bindValue(':pass', password_hash($this->getPass(), PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]), \PDO::PARAM_STR);
        }
        
        return $this->con->execute($this, $statement, "Se actualizaron los datos correctamente.");
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::delete()
     */
    public function delete()
    {
        $this->con->beginTransaction();
        
        $sql = sprintf('DELETE FROM %s WHERE dni=:id', $this->getTabla());
        $statement = $this->con->prepare($sql);
        $statement->bindValue(':id', $this->getDni(), \PDO::PARAM_INT);
        return $this->con->execute($this, $statement, "Se borraron los datos correctamente.");
    }
    
    /**
     * Chequea el login
     * 
     * @param integer $dni
     * @return boolean
     */
    public function findByDni($dni)
    {
        if(empty($dni))
        {
            $this->setMsg('danger', 'Error en login!');
            return false;
        }
        
        $this->con->beginTransaction();
        $statement = $this->con->prepare('SELECT * FROM perfil WHERE dni=:dni');
        $statement->bindValue(':dni', $dni, \PDO::PARAM_INT);
        
        if($statement->execute())
        {
            $this->con->commit();
            $row = $statement->fetch(\PDO::FETCH_ASSOC);
            $this->setData($row);
            
            if(!empty($row))
            {
                return true;
            }
            else
            {
                $this->setMsg('danger', 'Error en login');
                return false;
            }
        }
    }
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     */
    public function setId($dni)
    {
        $this->dni = $dni;
    }
    
    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getPass2()
    {
        return $this->pass2;
    }

    /**
     * @param mixed $pass2
     */
    public function setPass2($pass)
    {
        $this->pass2 = $pass;
    }

    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param mixed $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return mixed
     */
    public function getId_provincia()
    {
        return $this->id_provincia;
    }

    /**
     * @param mixed $id_provincia
     */
    public function setId_provincia($id_provincia)
    {
        $this->id_provincia = $id_provincia;
    }

    /**
     * @return mixed
     */
    public function getFecha_nac()
    {
        return $this->fecha_nac;
    }

    /**
     * @param mixed $fecha_nac
     */
    public function setFecha_nac($fecha_nac)
    {
        $this->fecha_nac = $fecha_nac;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getId_rol()
    {
        return $this->id_rol;
    }

    /**
     * @param mixed $id_rol
     */
    public function setId_rol($id_rol)
    {
        $this->id_rol = $id_rol;
    }


}