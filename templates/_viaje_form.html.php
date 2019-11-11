
<div class="container">
<h1 class="t1"><?php echo sprintf("%s de %s", (isset($accion) ? $accion : 'Listado'), ucfirst($clase->getTabla())); ?></h1>

<form enctype="multipart/form-data" name="forms" method="post" class="">

<?php 
if($_GET['a'] == 'edit')
{
    echo '<input type="hidden" name="method" value="PUT">';

?>
    
    <div class="form-group">
        <label for="id">rol</label>
        <input name="id" type="number" class="form-control" id="id" value="<?php echo $clase->getId() ?>" aria-describedby="idRolHelp" placeholder="" readonly>
    </div>
    
<?php 
}
?>
    
<?php 
$selected = $clase->getId_provincia();
include DIR_TEMPLATE . '/_form_provincia.php';
?>
    
    <div class="form-group">
        <label for="lugar">Lugar</label>
        <input name="lugar" type="text" class="form-control<?php echo $clase->getError('lugar') ? ' is-invalid' : '' ?>" id="lugar" value="<?php echo $clase->getLugar() ?>" aria-describedby="lugarHelp" placeholder="Nombre">
        <small id="lugarHelp" class="form-text text-muted">Lugar.</small>
        <div class="invalid-feedback">Debe ingresar un lugar</div>
    </div>
    
    <div class="form-group">
        <label for="precio">Precio</label>
        <input name="precio" type="text" class="form-control<?php echo $clase->getError('precio') ? ' is-invalid' : '' ?>" id="precio" value="<?php echo $clase->getPrecio() ?>" aria-describedby="precioHelp" placeholder="Nombre">
        <small id="precioHelp" class="form-text text-muted">Precio.</small>
        <div class="invalid-feedback">Debe ingresar un precio</div>
    </div>
    
    <div class="form-group">
        <label for="detalle">detalle</label>
        <textarea name="detalle" type="text" class="form-control<?php echo $clase->getError('detalle') ? ' is-invalid' : '' ?>" id="detalle" aria-describedby="detalleHelp" placeholder="Detalle"><?php echo $clase->getDetalle() ?></textarea>
        <small id="detalleHelp" class="form-text text-muted">Detalle.</small>
        <div class="invalid-feedback">Debe ser un detalle válido</div>
    </div>
    
    <div class="form-group">
        <label for="dias">dias</label>
        <input name="dias" type="text" class="form-control<?php echo $clase->getError('dias') ? ' is-invalid' : '' ?>" id="dias" value="<?php echo $clase->getDias() ?>" aria-describedby="nombreHelp" placeholder="Nombre">
        <small id="diasHelp" class="form-text text-muted">Dias.</small>
        <div class="invalid-feedback">Dias válido</div>
    </div>
    
    <div class="form-group">
        <label for="cantidad">cantidad</label>
        <input name="cantidad" type="number" class="form-control<?php echo $clase->getError('cantidad') ? ' is-invalid' : '' ?>" id="cantidad" value="<?php echo $clase->getCantidad() ?>" aria-describedby="cantidadHelp" placeholder="Cantidad" min="1">
        <small id="cantidadHelp" class="form-text text-muted">Cantidad.</small>
        <div class="invalid-feedback">Debe ser un número válido</div>
    </div>
    
<?php 
$selected = $clase->getId_tipo();
include DIR_TEMPLATE . '/_form_tipo.php';
?>
    
    <div class="form-group">
        <button type="submit" class="btn btn-rect btn-grad btn-success float-left">Guardar</button>
    </div>
</form>

    <div class="form-group">
    	<a class="btn btn-rect btn-grad btn-info float-left ml-3" href="<?php echo $clase->getTabla() ?>.php" role="button">Volver</a>
    </div>
    

<?php 
if($_GET['a'] == 'edit')
{
    include DIR_TEMPLATE . '/_form_borrar.php';
}
?>
    
    
</div>
