<?php
namespace UPCN;

interface abm
{
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

