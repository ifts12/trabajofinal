<?php

@session_start();

use UPCN\Conexion;

if (!isset($_SESSION['u']))
{
    header('Location: login.php');
}

try {
    $c = new Conexion();
    $statement = $c->prepare('SELECT * FROM perfil WHERE dni=:dni');
    $statement->bindValue(':dni', $_SESSION['u'], \PDO::PARAM_INT);
    $statement->execute();
    $row = $statement->fetch(\PDO::FETCH_ASSOC);
}
catch (\PDOException $e)
{
    echo $e->getMessage();
}

