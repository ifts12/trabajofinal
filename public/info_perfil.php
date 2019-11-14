<?php

require __DIR__ . '/../src/autoload.php';
require DIR_ROOT . '/src/session.php';

use UPCN\Perfil;
$clase = new Perfil();

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';

$clase->findByDni($_SESSION['u']);

// include DIR_TEMPLATE . '/_perfil_form.html.php';

echo '<div class="container my-4">';
$info = '<table>';
$info .= sprintf('<tr><th>Nombre</th><td>%s</td></tr>', $clase->getNombre());
$info .= sprintf('<tr><th>Apellido</th><td>%s</td></tr>', $clase->getApellido());
$info .= sprintf('<tr><th>Foto</th><td>%s</td></tr>', $clase->getFoto());
$info .= sprintf('<tr><th>Fecha Nac.</th><td>%s</td></tr>', $clase->getFecha_nac());
$info .= sprintf('<tr><th>Email</th><td>%s</td></tr>', $clase->getEmail());
$info .= '</table>';

echo $info;
echo '</div>';

include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
