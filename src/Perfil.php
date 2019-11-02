<?php

namespace UPCN;

class Perfil extends Comun
{
    private $dni;
    
    private $nombre;
    
    private $apellido;
    
    private $telefono;
    
    private $direccion;
    
    private $fecha_nac;
    
    private $email;
    
    private $id_provincia;
    
    private $id_rol;
    
    private $pass;
    
    private $rol;
    
    
    public function hasRol($rol)
    {
        if($this->getRol() === $rol)
        {
            return true;
        }
        return false;
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
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param mixed $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }


    
    

}