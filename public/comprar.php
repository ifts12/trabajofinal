<?php

require __DIR__ . '/../src/autoload.php';
require DIR_ROOT . '/src/session.php';

use UPCN\Hotel;
use UPCN\Viaje;

use UPCN\Compra;
$compra = new Compra();

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';

include DIR_TEMPLATE . '/_msg.html.php';

if(array_key_exists('s', $_GET) && array_key_exists('d', $_GET) && empty($_POST))
{
    if($_GET['s'] == 'hotelería')
    {
        $clase = new Hotel();
        $seccion = 'hotel';
    }
    else
    {
        $clase = new Viaje();
        $seccion = 'viaje';
    }
    $datos = $clase->findBy(['id' => $_GET['d']]);
    
    if(get_class($datos[0]) == Hotel::class)
    {
        $info = sprintf('<div class="pt-2"><span>%s</span></div>', $datos[0]->getId_provincia());
        $info .= sprintf('<h5>%s</h5>', $datos[0]->getNombre());
        $info .= sprintf('<div>%d</div>', $datos[0]->getEstrellas());
        $info .= sprintf('<div>%.2f</div>', $datos[0]->getPrecio());
    }
    echo $info;
    
    include DIR_TEMPLATE . '/_compra_form.html.php';
}
elseif(!empty($_POST) && $_POST['method'] == 'PUT')
{
    if($_GET['s'] == 'hotelería')
    {
        $clase = new Hotel();
    }
    else
    {
        $clase = new Viaje();
    }
    $compra->setData($_POST);

    echo '<pre>';
    echo var_dump($clase);
    echo '</pre>';

    $status = $compra->insert();
    $_SESSION['msg'] = json_encode($clase->getMsg());
}

include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>

