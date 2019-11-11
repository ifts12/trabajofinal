
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
    <div class="form-group">
        <label for="precio">Precio</label>
        <input name="precio" type="text" class="form-control<?php echo $clase->getError('precio') ? ' is-invalid' : '' ?>" id="precio" value="<?php echo $clase->getPrecio() ?>" aria-describedby="precioHelp" placeholder="Precio">
        <small id="precioHelp" class="form-text text-muted">Ingrese un valor.</small>
        <div class="invalid-feedback">Debe ser un valor válido</div>
    </div>
    
    <div class="form-group">
        <label for="nombre">Detalle</label>
        <textarea name="detalle" class="form-control<?php echo $clase->getError('detalle') ? ' is-invalid' : '' ?>" id="detalle" aria-describedby="nombreHelp" placeholder="Detalle"><?php echo $clase->getDetalle() ?></textarea>
        <small id="nombreHelp" class="form-text text-muted">Ingrese un tipo de viaje.</small>
        <div class="invalid-feedback">Debe ser un tipo de viaje válido</div>
    </div>
    
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
