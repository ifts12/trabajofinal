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
    if(empty($datos))
    {
        echo "Error: No existe la promoción.";        
        echo $clase->redirect('paquete.php', 10);
    }
    
    $dato = $datos[0];
    $info = sprintf('<h3>%s</h3>', ucfirst($_GET['s']));
    
    $provincia = $clase->findProvinciaById($dato->getId_provincia());
    if($provincia)
    {
        $info .= sprintf('<div class="pt-2">%s</div>', $provincia->getNombre());
    }
    
    $img = $clase->getImage($dato->getFoto());
    $asistenciaMedica = $clase->getAsistenciaMedica();
    
    if(get_class($dato) == Hotel::class)
    {
        $info .= sprintf('<h5>%s</h5>', $dato->getNombre());
        $info .= sprintf('<div>%d</div>', $dato->getEstrellas());
    }
    else
    {
        $info .= sprintf('<h5>%s</h5>', $dato->getLugar());
        $info .= sprintf('<div>%s</div>', $dato->getDetalle());
        $info .= sprintf('<div>%d días / %d noches</div>', $dato->getDias(), $dato->getNoches());
    }
    $info .= sprintf('<div id="precio" class="precio">$ %.2f</div>', $dato->getPrecio());
    if($asistenciaMedica)
    {
        $info .= sprintf('<small>%s ($ %0.2f)</small>', $asistenciaMedica->getDetalle(), $asistenciaMedica->getPrecio());
    }

?>

<div class="container">
    <div class="row my-3">
        <div class="caja-thumb col-6" style="background-image: url(<?php echo $img ?>);"></div>
    	<div class="p-4 border col-6"><?php echo $info; ?></div>
    </div>
</div>


    
<?php 
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
    $compra->setDni($_SESSION['u']);
    
    
    
echo '<=============>';

    echo '<pre>';
    echo var_dump($compra);
    echo '<=============>';
    echo var_dump($clase);
    echo '</pre>';
exit;
    $status = $compra->insert();
    $_SESSION['msg'] = json_encode($clase->getMsg());
}

include DIR_TEMPLATE . '/_javascripts.html.php';
?>


<script type="text/javascript">
$(document).ready(function() {

	
	precio = <?php echo $dato->getPrecio() ? $dato->getPrecio() : 0 ?>;
	precioAsistencia = <?php echo $asistenciaMedica->getPrecio() ? $asistenciaMedica->getPrecio() : 0 ?>;
	
	$('#cantidad_afiliados, #cantidad_invitados, #id_adicional').on('change', function()
	{
		calcularPrecio();
	});
			
	$('#cantidad_invitados').on('change', function()
	{
		if($(this).val() == 0)
		{
    		$('#id_adicional').attr('disabled', true);
		}
		else
		{
    		$('#id_adicional').attr('disabled', false);
		}
	});
	
	$('#term').on('change', function()
	{
		$(':submit').attr('disabled', false);
	});
	
	function calcularPrecio()
	{
		total = $('#cantidad_afiliados').val() * precio + $('#cantidad_invitados').val() * precio;
		if($('#id_adicional:checked').length > 0)
		{
			total += $('#cantidad_invitados').val() * precioAsistencia
		}
		$('#precio').html('$ ' + total);
	}
	
});

</script>


<?php 
include  DIR_TEMPLATE . '/_foot.html.php';
?>


