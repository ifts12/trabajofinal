<?php

namespace UPCN;

class Comun
{
    private $error = [];
    private $hasError = false;
    
    public function validar($request)
    {
        $reflect = new \ReflectionClass($this);
        $props   = $reflect->getProperties(\ReflectionProperty::IS_PRIVATE);
        
        foreach ($props as $prop)
        {
            if(array_key_exists($prop->getName(), $request))
            {
                $metodo = new \ReflectionMethod($this, 'set' . ucfirst($prop->getName()));
                echo $metodo->invokeArgs($this, [$request[$prop->getName()]]);
                
                $this->error[$prop->getName()] = false;
                if(empty($request[$prop->getName()]))
                {
                    $this->error[$prop->getName()] = true;
                    $this->hasError = true;
                }
            }
        }
    }
    
    /**
     * FileUpload
     * @return boolean
     */
    public function fileUpload($request)
    {
        if (is_uploaded_file($request['foto']['tmp_name']))
        {
            if (move_uploaded_file($request['foto']['tmp_name'], DIR_UPLOAD_IMG . DIRECTORY_SEPARATOR . basename($request['foto']['name'])))
            {
                echo "El fichero es válido y se subió con éxito.\n";
                $this->setFoto(basename($request['foto']['name']));
            }
            else
            {
                echo "¡Posible ataque de subida de ficheros!\n";
            }
        }
        else
        {
            echo "Posible ataque del archivo subido: ";
            echo "nombre del archivo '". $_FILES['foto']['tmp_name'] . "'.";
        }
    }
    
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
    
    public function hasError()
    {
        if($this->hasError)
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
        if(array_key_exists($k, $this->error))
        {
            return $this->error[$k];
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

    

}