<?php
require __DIR__ . '/../src/autoload.php';

// Administrador / Empleado / Afiliado
require DIR_ROOT . '/src/session.php';

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';

include DIR_TEMPLATE . '/paquetes.html.php';

include DIR_TEMPLATE . '/_javascripts.html.php';
include DIR_TEMPLATE . '/_foot.html.php';
