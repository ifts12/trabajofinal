
<div class="container">
<h1 class="t1"><?php echo sprintf("%s de %s", (isset($accion) ? $accion : 'Listado'), ucfirst($clase->getTabla())); ?></h1>

<form enctype="multipart/form-data" name="forms" method="post" class="">

<?php 
if($_GET['a'] == 'edit')
{
    echo '<input type="hidden" name="method" value="PUT">';

?>
    
    <div class="form-group">
        <label for="id">ID</label>
        <input name="id" type="number" class="form-control" id="id" value="<?php echo $clase->getId() ?>" aria-describedby="idRolHelp" placeholder="" readonly>
    </div>
    
<?php 
}

include DIR_TEMPLATE . '/_form_tipo_viaje.php';
include DIR_TEMPLATE . '/_form_provincia.php';
?>
    
    <div class="form-group">
        <label for="lugar">Lugar</label>
        <input name="lugar" type="text" class="form-control<?php echo $clase->getError('lugar') ? ' is-invalid' : '' ?>" id="lugar" value="<?php echo $clase->getLugar() ?>" aria-describedby="lugarHelp" placeholder="Lugar">
        <small id="lugarHelp" class="form-text text-muted">Lugar.</small>
        <div class="invalid-feedback">Debe ingresar un lugar</div>
    </div>
    
    <div class="form-group">
        <label for="precio">Precio</label>
        <input name="precio" type="text" class="form-control<?php echo $clase->getError('precio') ? ' is-invalid' : '' ?>" id="precio" value="<?php echo $clase->getPrecioArg() ?>" aria-describedby="precioHelp" placeholder="Precio">
        <small id="precioHelp" class="form-text text-muted">Precio.</small>
        <div class="invalid-feedback">Debe ingresar un precio</div>
    </div>
    
    <div class="form-group">
        <label for="detalle">Detalle</label>
        <textarea name="detalle" type="text" class="form-control<?php echo $clase->getError('detalle') ? ' is-invalid' : '' ?>" id="detalle" aria-describedby="detalleHelp" placeholder="Detalle"><?php echo $clase->getDetalle() ?></textarea>
        <small id="detalleHelp" class="form-text text-muted">Detalle.</small>
        <div class="invalid-feedback">Debe ser un detalle válido</div>
    </div>
    
    <div class="form-group">
        <label for="dias">Dias</label>
        <input name="dias" type="number" class="form-control<?php echo $clase->getError('dias') ? ' is-invalid' : '' ?>" id="dias" value="<?php echo $clase->getDias() ?>" aria-describedby="diasHelp" placeholder="Dias" min="1">
        <small id="diasHelp" class="form-text text-muted">Dias.</small>
        <div class="invalid-feedback">Dias válido</div>
    </div>
    
    <div class="form-group">
        <label for="noches">Noches</label>
        <input name="noches" type="number" class="form-control<?php echo $clase->getError('noches') ? ' is-invalid' : '' ?>" id="noches" value="<?php echo $clase->getNoches() ?>" aria-describedby="nochesHelp" placeholder="Noches" min="1">
        <small id="nochesHelp" class="form-text text-muted">Noches.</small>
        <div class="invalid-feedback">Dias válido</div>
    </div>
    
    <div class="form-group">
        <label for="fecha_desde">Fecha Desde</label>
        <input name="fecha_desde" type="date" class="form-control<?php echo $clase->getError('fecha_desde') ? ' is-invalid' : '' ?>" id="fecha_desde" value="<?php echo $clase->getFecha_desde() ?>" aria-describedby="fecha_desdeHelp" placeholder="Fecha Desde" min="1">
        <small id="fecha_desdeHelp" class="form-text text-muted">Dias.</small>
        <div class="invalid-feedback">Dias válido</div>
    </div>
    
    <div class="form-group">
        <label for="fecha_hasta">Fecha Hasta</label>
        <input name="fecha_hasta" type="date" class="form-control<?php echo $clase->getError('fecha_hasta') ? ' is-invalid' : '' ?>" id="fecha_hasta" value="<?php echo $clase->getFecha_hasta() ?>" aria-describedby="fecha_hastaHelp" placeholder="Fecha Hasta" min="1">
        <small id="fecha_hastaHelp" class="form-text text-muted">Dias.</small>
        <div class="invalid-feedback">Dias válido</div>
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
