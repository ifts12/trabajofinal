<?php
use UPCN\Hotel;

include DIR_TEMPLATE . '/_content_head.html.php';
foreach($datos as $v)
{
    $dato = $clase->findBy($v['id']);
    $img = $clase->getImage($dato->getFoto());
    include DIR_TEMPLATE . '/_content_body_head.html.php';
    
    $provincia = $clase->findProvinciaById($dato->getId_provincia());
    
    $img = $clase->getImage($dato->getFoto());
    $asistenciaMedica = $clase->getAsistenciaMedica();
    
    $precio = $dato->getPrecio();
    $precioAsistencia = $asistenciaMedica->getPrecio();
    $info = null;
    
    if(get_class($dato) == Hotel::class)
    {
        $info .= sprintf('<h3>%s</h3>', $dato->getNombre());
        $info .= sprintf('<h4>%s</h4>', $provincia->getNombre());
        $info .= sprintf('<div>%d estrella%s</div>', $dato->getEstrellas(), ($dato->getEstrellas() > 1 ? 's' : ''));
    }
    else
    {
        $info .= sprintf('<h3>%s</h3>', $dato->getLugar());
        $info .= sprintf('<h4>%s</h4>', $provincia->getNombre());
        $info .= sprintf('<div>%s</div>', $dato->getDetalle());
        $info .= sprintf('<div>%d día%s / %d noche%s</div>', $dato->getDias(), ($dato->getDias() > 1 ? 's' : ''), $dato->getNoches(), ($dato->getNoches() > 1 ? 's' : ''));
    }
    $info .= sprintf('<div id="precio" class="precio">$ %.2f</div>', $dato->getPrecio());
    if($asistenciaMedica)
    {
        $info .= sprintf('<div><small>%s ($ %0.2f)</small></div>', $asistenciaMedica->getDetalle(), $asistenciaMedica->getPrecio());
        $info .= '<div><small><strong>Bonificado para el afiliado y grupo familiar</strong></small></div>';
    }
    
    $url = (isset($_SESSION['u']) ? sprintf('compra.php?s=%s&d=%d', strtolower($titulo), $dato->getId()) : 'login.php');
    $txtLink = (isset($_SESSION['u']) ? 'Comprar' : 'Ingresar');
    
    $info .= sprintf('<div class="mt-2"><a class="btn btn-outline-success" role="button"  href="%s">%s</a></div>', $url, $txtLink);
    echo $info;
?>
	
    
<?php 
    include DIR_TEMPLATE . '/_content_body_foot.html.php';
}
include DIR_TEMPLATE . '/_content_foot.html.php';
?>