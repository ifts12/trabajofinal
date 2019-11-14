<?php

@session_start();

if (!isset($_SESSION['u']))
{
    session_unset();
    session_destroy();
//     header('Location: ' . LOGIN);
}
else
{
    $user = new UPCN\Perfil();
    if(isset($user) && @get_class($user) && !$user->findByDni(filter_var($_SESSION['u'], FILTER_SANITIZE_NUMBER_INT)))
    {
        header('Location: ' . LOGIN);
    }
}
