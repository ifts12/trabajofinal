<?php

@session_start();

use UPCN\Conexion;

if (!isset($_SESSION['u']))
{
    header('Location: login.php');
}
else
{
    try {
        $c = new Conexion();
        $statement = $c->prepare('SELECT p.*, r.* FROM perfil p LEFT JOIN rol r ON p.id_rol=r.id WHERE dni=:dni');
        $statement->bindValue(':dni', $_SESSION['u'], \PDO::PARAM_INT);
        $statement->execute();
        $user = $statement->fetch(\PDO::FETCH_ASSOC);
    }
    catch (\PDOException $e)
    {
        echo $e->getMessage();
    }
}
