<?php

require __DIR__ . '/../src/autoload.php';
require DIR_ROOT . '/src/session.php';

use UPCN\Compra;
$clase = new Compra();

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';

?>

<div class="container">
    
    <?php 
        $datosViajes = $clase->selectViaje($_SESSION['u']);
        if(!empty($datosViajes))
        {
            echo '<h1>Viajes</h1>';
            echo sprintf('<table id="table" class="table"><tr><th>Tipo</th><th>Detalle</th><th>Lugar</th><th>Días/Noches</th><th>Provincia</th><th>Afiliados</th><th>Invitados</th><th>Precio</th></tr>');
            foreach($datosViajes as $dato)
            {
                echo sprintf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%d Días / %d Noches</td><td>%s</td><td>%d</td><td>%d</td><td>%.2f</td></tr>', $dato['tipoViaje'], $dato['detalle'], $dato['lugar'], $dato['dias'], $dato['noches'], $dato['provincia'], $dato['cantidad_afiliados'], $dato['cantidad_invitados'], $dato['precio_final']);
            }
            echo '</table>';
        }
        
        $datosHoteles = $clase->selectHotel($_SESSION['u']);
        if(!empty($datosHoteles))
        {
            echo '<h1>Hoteles</h1>';
            echo sprintf('<table id="table" class="table"><tr><th>Nombre</th><th>Estrellas</th><th>Provincia</th><th>Afiliados</th><th>Invitados</th><th>Precio</th></tr>');
            foreach($datosHoteles as $dato)
            {
                echo sprintf('<tr><td>%s</td><td>%d</td><td>%s</td><td>%d</td><td>%d</td><td>%.2f</td></tr>', $dato['nombre'], $dato['estrellas'], $dato['provincia'], $dato['cantidad_afiliados'], $dato['cantidad_invitados'], $dato['precio_final']);
            }
            echo '</table>';
        }
    ?>
    </table>
</div>


<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
