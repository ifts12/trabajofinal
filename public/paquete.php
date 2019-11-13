<?php
require __DIR__ . '/../src/autoload.php';
require DIR_ROOT . '/src/session.php';

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';

use UPCN\Viaje;
$clase = new Viaje();
$datos = $clase->findByTipoViaje('Paquete');
$portada = 'images/khachik-simonian-nXOB-wh4Oyc-unsplash.jpg';
$titulo = 'Paquete';
include DIR_TEMPLATE . '/_viajes.html.php';

include DIR_TEMPLATE . '/_javascripts.html.php';
include DIR_TEMPLATE . '/_foot.html.php';

