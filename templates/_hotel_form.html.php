
<div class="container">
<h1 class="t1"><?php echo sprintf("%s de %s", (isset($accion) ? $accion : 'Listado'), ucfirst($clase->getTabla())); ?></h1>

<form enctype="multipart/form-data" name="forms" method="post" class="">

<?php 
if($_GET['a'] == 'edit')
{
    echo '<input type="hidden" name="method" value="PUT">';
    echo sprintf('<input type="hidden" name="id" value="%d">', $clase->getId());
}
?>
    
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input name="nombre" type="text" class="form-control<?php echo $clase->getError('nombre') ? ' is-invalid' : '' ?>" id="nombre" value="<?php echo $clase->getNombre() ?>" aria-describedby="nombreHelp" placeholder="Nombre">
        <small id="nombreHelp" class="form-text text-muted">Ingrese el nombre.</small>
        <div class="invalid-feedback">Debe ser un nombre válido</div>
    </div>
    
<?php 
include DIR_TEMPLATE . '/_form_provincia.php';

include DIR_TEMPLATE . '/_form_foto.php';
?>

    <div class="form-group">
        <label for="estrellas">Estrellas</label>
        <input name="estrellas" type="number" class="form-control<?php echo $clase->getError('estrellas') ? ' is-invalid' : '' ?>" id="estrellas" value="<?php echo $clase->getEstrellas() ?>" aria-describedby="estrellasHelp" placeholder="Estrellas" min="1" max="5">
        <small id="estrellasHelp" class="form-text text-muted">Ingrese cantidad de estrellas del hotel.</small>
        <div class="invalid-feedback">Debe ser una cantidad válida (de 1 a 5 estrellas)</div>
    </div>
    
    <div class="form-group">
        <label for="pass">Precio</label>
        <input name="precio" type="text" class="form-control<?php echo $clase->getError('precio') ? ' is-invalid' : '' ?>" id="precio" value="<?php echo $clase->getPrecio() ?>" aria-describedby="precioHelp" placeholder="precio">
        <small id="precioHelp" class="form-text text-muted">Ingrese el precio.</small>
        <div class="invalid-feedback">Debe ser un valor válido</div>
    </div>
    
    <div class="form-group">
        <label for="cantidad">Cantidad</label>
        <input name="cantidad" type="number" class="form-control<?php echo $clase->getError('cantidad') ? ' is-invalid' : '' ?>" id="cantidad" value="<?php echo $clase->getCantidad() ?>" aria-describedby="cantidadHelp" placeholder="Cantidad">
        <small id="cantidadHelp" class="form-text text-muted">Ingrese una cantidad.</small>
        <div class="invalid-feedback">Debe ser una cantidad válida</div>
    </div>
    
    
    <div class="form-group">
        <button type="submit" class="btn btn-rect btn-grad btn-success float-left">Guardar</button>
    </div>
</form>

    <div class="form-group">
    	<a class="btn btn-rect btn-grad btn-info float-left ml-3" href="perfil.php" role="button">Volver</a>
    </div>
    

<?php 
if($_GET['a'] == 'edit')
{
    include DIR_TEMPLATE . '/_form_borrar.php';
}
?>
    
    
</div>
