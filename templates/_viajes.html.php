<?php
include DIR_TEMPLATE . '/_content_head.html.php';
foreach($datos as $dato)
{
    $img = $clase->getImage($dato['foto']);
    include DIR_TEMPLATE . '/_content_body_head.html.php';
    ?>
    
    <div class="pt-2"><span><?php echo $dato['provincia'] ?></span></div>
	<h5><?php echo $dato['nombre'] ?></h5>
	<p><?php echo $dato['estrellas'] ?></p>
	<p><?php echo $dato['precio'] ?></p>
	<p><a class="btn btn-outline-success" role="button"  href="<?php echo (isset($_SESSION['u']) ? sprintf('comprar.php?s=%s&d=%d', strtolower($titulo), $dato["id"]) : 'login.php') ?>"><?php echo (isset($_SESSION['u']) ? 'Comprar' : 'Ingresar') ?></a></p>
    
<?php 
    include DIR_TEMPLATE . '/_content_body_foot.html.php';
}
include DIR_TEMPLATE . '/_content_foot.html.php';
?>