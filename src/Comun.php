<?php

namespace UPCN;

use UPCN\Conexion;

class Comun implements PdoABM
{
    /**
     * Conexion a la Base de Datos
     * @var \PDO
     */
    protected $con;
    
    /**
     * Nombre de la tabla
     * @var string
     */
    protected $tabla;
    
    protected $required;
    
    protected $error = [];
    
    protected $msg;
    
    public function __construct()
    {
        $this->con = new Conexion();
    }
    
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::select()
     */
    public function select()
    {
        return $this->findAll('SELECT t.* FROM ' . $this->getTabla() . ' t');
    }
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::insert()
     * return boolean
     */
    public function insert(){}
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::update()
     */
    public function update(){}
    
    /**
     * {@inheritDoc}
     * @see \UPCN\PdoABM::delete()
     */
    public function delete()
    {
        $this->con->beginTransaction();
        
        $sql = sprintf('DELETE FROM %s WHERE id=:id', $this->getTabla());
        $statement = $this->con->prepare($sql);
        $statement->bindValue(':id', $this->getId(), \PDO::PARAM_INT);
        return $this->con->execute($this, $statement, "Se borraron los datos correctamente.");
    }
    
    
    public function redirect()
    {
        if (!headers_sent()) {
            header('Location: ' . $this->getTabla() . '.php');
            exit;
        }
        else
        {
            echo '<meta http-equiv="Refresh" content="0; url=' . $this->getTabla() . '.php' . '" />';
            echo '<script>window.location.href="' . $this->getTabla() . '.php' . '"</script>';
//             window.location.hostname='$this->getTabla() . '.php''
//             window.location.replace='$this->getTabla() . '.php''
//             window.location.assign='$this->getTabla() . '.php''
        }
    }
    
    /**
     * Mapea Array a Objeto
     * @param Array $data
     */
    public function setData($data)
    {
        $reflect = new \ReflectionClass($this);
        $props   = $reflect->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED);
        
        foreach ($props as $prop)
        {
            if(array_key_exists($prop->getName(), $data))
            {
                $metodo = new \ReflectionMethod($this, 'set' . ucfirst($prop->getName()));
                $metodo->invokeArgs($this, [$data[$prop->getName()]]);

                if(empty($data[$prop->getName()]) && array_keys($this->required, $prop->getName()))
                {
                    $this->error[] = $prop->getName();
                }
            }
        }
        return $this;
    }
    
    /**
     * FileUpload
     * @return boolean
     */
    public function fileUpload($request)
    {
        if(empty($request['foto']['tmp_name']))
        {
            return FALSE;
        }
        if (is_uploaded_file($request['foto']['tmp_name']) && move_uploaded_file($request['foto']['tmp_name'], DIR_UPLOAD_IMG . DIRECTORY_SEPARATOR . basename($request['foto']['name'])))
        {
            echo "El fichero es válido y se subió con éxito.\n";
            $this->setFoto(basename($request['foto']['name']));
            $this->setMsg('success', "Se actualizaron los datos del rol correctamente.");
        }
        else
        {
            $this->setMsg('danger', "Posible ataque del archivo subido: " . $_FILES['foto']['tmp_name']);
        }
    }
    
    public function setMsg($tipo, $msg)
    {
        if(empty($tipo) || empty($msg))
        {
            return null;
        }
        $this->msg = [
            'tipo' => $tipo,
            'msg'  => $msg
        ];
    }
    
    public function getMsg()
    {
        return $this->msg;
    }
    
    /**
     * Setea imagen por defecto
     * 
     * @param string $dir
     * @param string $prefix
     * @return string
     */
    public function getDefaultImages($dir = null, $prefix = null)
    {
        if(empty($dir))
        {
            $dir = DIR_PUBLIC . DIRECTORY_SEPARATOR . DIR_IMG;
        }
        $archivo = array_slice(scandir($dir), 2); // elimina los '.' y '..'
        $imgs = array_filter($archivo, function($v, $k) {
                return preg_match('/^xd-/', $v);
            }, ARRAY_FILTER_USE_BOTH);
            
        $elemento = array_rand($imgs);
        return DIR_IMG . DIRECTORY_SEPARATOR . $imgs[$elemento];
    }
    
    /**
     * @return boolean
     */
    public function hasError()
    {
        if(!empty($this->error))
        {
            return true;
        }
        return false;
    }
    
    /**
     * @return mixed
     */
    public function getError($k = null)
    {
        if(is_null($k))
        {
            return $this->error;
        }
        if($i = array_search($k, $this->error))
        {
            return $this->error[$i];
        }
        return null;
    }
    
    /**
     * @param mixed $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }
    
    public function findAll($sql)
    {
        if(empty($sql))
        {
            return false;
        }
        $this->con->beginTransaction();
        $statement = $this->con->prepare($sql);
        if($statement->execute())
        {
            $this->con->commit();
            $row = $statement->fetchAll(\PDO::FETCH_ASSOC);
            if (!empty($row))
            {
                return $row;
            }
        }
        return false;
    }
    
    /**
     * Mapea Array a Objeto
     * @param Array $data
     */
    public function findBy($data)
    {
        if(!empty($data) && is_array($data))
        {
            $reflect = new \ReflectionClass($this);
            $props   = $reflect->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED);
            
            foreach ($props as $prop)
            {
                if(array_key_exists($prop->getName(), $data))
                {
                    $sql = 'SELECT * FROM ' . $this->getTabla() . ' WHERE ';
                    
                    foreach($data as $k => $v)
                    {
                        $sql .= sprintf("%s=:%s ", $k, $k);
                    }
                    
                    $this->con->beginTransaction();
                    $statement = $this->con->prepare($sql);
                    
                    foreach($data as $k => $v)
                    {
                        $statement->bindValue(':' . $k, $v);
                    }

                    if($statement->execute())
                    {
                        $this->con->commit();
                        $res = $statement->fetchAll(\PDO::FETCH_ASSOC);
                        
                        if(empty($res))
                        {
                            return FALSE;
                        }
                        
                        foreach($res as $class)
                        {
                            $rows[] = $this->setData($class);
                        }
                        return $rows;
                    }
                }
            }
        }
        return $this;
    }
    
    
    /**
     * Obtiene todas los roles
     * @return mixed|boolean
     */
    public function getRoles()
    {
        return $this->findAll('SELECT * FROM rol');
    }
    
    /**
     * Obtiene todas las provincias
     * @return mixed|boolean
     */
    public function getProvincias()
    {
        return $this->findAll('SELECT * FROM provincia');
    }
    
    /**
     * @return string
     */
    public function getTabla()
    {
        return $this->tabla;
    }

    /**
     * @param string $tabla
     */
    public function setTabla($tabla)
    {
        $this->tabla = $tabla;
    }


}