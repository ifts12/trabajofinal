<?php
require __DIR__ . '/../src/autoload.php';
require DIR_ROOT . '/src/session.php';

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';

use UPCN\Hotel;
$clase = new Hotel();
$datos = $clase->select();
$portada = 'images/khachik-simonian-nXOB-wh4Oyc-unsplash.jpg';
$titulo = 'Hotelería';
include DIR_TEMPLATE . '/_viajes.html.php';
// include DIR_TEMPLATE . '/hoteleria.html.php';

include DIR_TEMPLATE . '/_javascripts.html.php';
include DIR_TEMPLATE . '/_foot.html.php';

