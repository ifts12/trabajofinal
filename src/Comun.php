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
            $metodo = new \ReflectionMethod($this, 'set' . ucfirst($prop->getName()));
            echo $metodo->invokeArgs($this, [$request[$prop->getName()]]);
            
            $this->error[$prop->getName()] = false;
            if(array_key_exists($prop->getName(), $request) && empty($request[$prop->getName()]))
            {
                $this->error[$prop->getName()] = true;
                $this->hasError = true;
            }
        }
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