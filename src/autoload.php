<?php

define('DIR_ROOT', dirname(__DIR__));
define('DIR_TEMPLATE', DIR_ROOT . '/templates');
define('DIR_PUBLIC', DIR_ROOT . '/public');
define('DIR_IMG', './images');
define('DIR_UPLOAD', './upload');
define('DIR_UPLOAD_IMG', DIR_UPLOAD . '/images');
define('LOGIN', 'login.php');

spl_autoload_register('clasesNamespaceAutoload');

function clasesNamespaceAutoload($classname)
{
    $class = explode("\\", $classname);
    if(file_exists(__DIR__ . DIRECTORY_SEPARATOR . $class[count($class)-1] . '.php'))
    {
        include __DIR__ . DIRECTORY_SEPARATOR . $class[count($class)-1] . '.php';
    }
}

