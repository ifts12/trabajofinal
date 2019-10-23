<?php

namespace UPCN;

class Config
{
    private $fileConfig = __DIR__ . '/config.yaml';
    protected $config;

    public function __construct()
    {
        if(file_exists($this->fileConfig))
        {
            $this->setConfig(yaml_parse_file($this->fileConfig));
        }
        else
        {
            die('Falta el archivo de configuración ' . $this->fileConfig);
        }
    }
    
    /**
     * @return mixed
     */
    public function getConfig($parametro = null)
    {
        if(!empty($parametro))
        {
            return $this->config[$parametro];
        }
        return $this->config;
    }
    
    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }
    
}