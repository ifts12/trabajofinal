<?php

define('DIR_ROOT', dirname(__DIR__ . '/../../'));
define('DIR_TEMPLATE', DIR_ROOT . '/templates');

define('CONTROLLER_DIR', __DIR__ . '/Controlador');
spl_autoload_register('clasesNamespaceAutoload');

function clasesNamespaceAutoload($classname)
{
    $class = explode("\\", $classname);
    if(file_exists(__DIR__ . DIRECTORY_SEPARATOR . $class[count($class)-1] . '.php'))
    {
        include __DIR__ . DIRECTORY_SEPARATOR . $class[count($class)-1] . '.php';
    }
    elseif(file_exists(CONTROLLER_DIR . DIRECTORY_SEPARATOR . $class[count($class)-1] . '.php'))
    {
        include CONTROLLER_DIR . DIRECTORY_SEPARATOR . $class[count($class)-1] . '.php';
    }
}
