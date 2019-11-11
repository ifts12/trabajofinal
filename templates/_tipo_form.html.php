
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
        <label for="nombre">nombre</label>
        <input name="nombre" type="text" class="form-control<?php echo $clase->getError('nombre') ? ' is-invalid' : '' ?>" id="nombre" value="<?php echo $clase->getNombre() ?>" aria-describedby="nombreHelp" placeholder="Nombre">
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
