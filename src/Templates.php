<?php

namespace UPCN;

class Templates
{
    /**
     * Contruct
     */
    public function __construct()
    {
        $this->dirTemplate = __DIR__ . DIRECTORY_SEPARATOR . '../templates/';
    }
    
    /**
     * Verifica si exite el archivo y si existe devuelve su contenido
     * @param string $filename Nombre del archivo
     * @return string|NULL Contenido del archivo
     */
    private function getContenido($filename)
    {
        if(file_exists($this->dirTemplate . $filename . '.php'))
        {
            return file_get_contents($this->dirTemplate . $filename . '.php');
        }
        return null;
    }
    
    /**
     * Retorna el contenido del encabezado html
     * @return string 
     */
    public function getHead()
    {
        return $this->getContenido('_head.html');
    }
    
    /**
     * Retorna el contenido del menú html
     * @return string 
     */
    public function getMenu()
    {
        return $this->getContenido('_menu.html');
    }
    
    /**
     * Retorna el contenido del stylesheets html
     * @return string 
     */
    public function getStyleSheets()
    {
        return $this->getContenido('_stylesheets.html');
    }
    
    /**
     * Retorna el contenido del foot html
     * @return string 
     */
    public function getFoot()
    {
        return $this->getContenido('_foot.html');
    }
    
    /**
     * Retorna el contenido del javascripts html
     * @return string 
     */
    public function getJavascript()
    {
        return $this->getContenido('_javascripts.html');
    }
    
    /**
     * Retorna el contenido del javascripts html
     * @return string 
     */
    public function getLogin()
    {
        return $this->getContenido('login.html');
    }
}