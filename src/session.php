<?php

@session_start();

use UPCN\Conexion;

if (!isset($_SESSION['u']))
{
    session_unset();
    session_destroy();
//     header('Location: ' . LOGIN);
}
else
{
    try {
        $c = new Conexion();
        $statement = $c->prepare('SELECT p.*, r.* FROM perfil p LEFT JOIN rol r ON p.id_rol=r.id WHERE dni=:dni');
        $statement->bindValue(':dni', $_SESSION['u'], \PDO::PARAM_INT);
        $statement->execute();
        $user = $statement->fetchObject(\UPCN\Perfil::class);
        if(!$user)
        {
            header('Location: ' . LOGIN);
        }
    }
    catch (\PDOException $e)
    {
        echo $e->getMessage();
    }
}
