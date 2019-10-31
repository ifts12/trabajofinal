<?php

session_start();

if (!isset($_SESSION['u']))
{
//     header('Location: login.php');
}

try {
    $statement = $c->prepare('SELECT * FROM perfil WHERE dni=:dni');
    $statement->execute();
    $row = $statement->fetch(\PDO::FETCH_ASSOC);
}
catch (\PDOException $e)
{
    echo $e->getMessage();
}


echo htmlspecialchars(SID); 