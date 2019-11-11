<?php

namespace UPCN;

interface PdoABM
{
    
    /**
     * Seleccion los registro
     */
    public function select();
    
    /**
     * Inserta un registro
     */
    public function insert();
    
    /**
     * Actualiza un registro
     */
    public function update();
    
    /**
     * Borra un registro
     */
    public function delete();
    
}

