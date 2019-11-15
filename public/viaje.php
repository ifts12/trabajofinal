<?php

require __DIR__ . '/../src/autoload.php';
require DIR_ROOT . '/src/session.php';

/* Chequea permisos */
if(!$user->hasRol(['Empleado', 'Administrador']))
{
    header('Location: ' . LOGIN);
}

use UPCN\Viaje;
$clase = new Viaje();

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';

include DIR_TEMPLATE . '/_msg.html.php';

if(!array_key_exists('a', $_GET) && empty($_POST))
{
    include DIR_TEMPLATE . '/_' . $clase->getTabla() . '_list.html.php';
}
else
{
    if(!empty($_POST))
    {
        if(!empty($_FILES))
        {
            $_SESSION['msg'] = json_encode($clase->fileUpload($_FILES));
            $foto = $clase->getFoto();
        }
        
        $clase->setData($_POST, TRUE);
        if(isset($foto))
        {
            $clase->setFoto($foto);
        }
        
        if(!empty($_POST['method']) && $_POST['method'] === 'DELETE')
        {
            $status = $clase->delete();
            $clase->redirect();
        }
        elseif(!$clase->hasError())
        {
            if(!empty($_POST['method']) && $_POST['method'] === 'PUT')
            {
                $status = $clase->update();
            }
            else
            {
                $status = $clase->insert();
            }
            $_SESSION['msg'] = json_encode($clase->getMsg());
            if($status)
            {
                $clase->redirect();
            }
        }
        else
        {
            $_SESSION['msg'] = json_encode([
                'tipo' => 'danger',
                'msg'  => $clase->getError()
            ]);
        }
    }
    elseif(array_key_exists('a', $_GET) && !empty($_GET['a']))
    {
        $accion = 'Nuevo';
        if($_GET['a'] == 'edit' && !empty($_GET['d']))
        {
            $status = $clase->findBy(['id' => $_GET['d']]);
            if(!$status)
            {
                $clase->redirect();
            }
            $accion = 'Editar';
        }
    }
    include DIR_TEMPLATE . '/_' . $clase->getTabla() . '_form.html.php';
}

include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>

