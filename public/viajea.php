<?php

require __DIR__ . '/../src/autoload.php';
require DIR_ROOT . '/src/session.php';


use UPCN\Conexion;
use UPCN\Viaje;

$c = new Conexion();
$clase = new Viaje();

if(!empty($_POST))
{
    $clase->validar($_POST);
    if(!$clase->hasError())
    {
        $c->beginTransaction();
        $statement = $c->prepare('INSERT INTO viaje (foto, id_provincia, lugar, precio, detalle, dias, cantidad, id_tipo) VALUES (:foto, :id_provincia, :lugar, :precio, :detalle, :dias, :cantidad, :id_tipo)');
        $statement->bindValue(':foto', $clase->getLugar(), \PDO::PARAM_STR);
        $statement->bindValue(':id_provincia', $clase->getId_provincia(), \PDO::PARAM_INT);
        $statement->bindValue(':lugar', $clase->getLugar(), \PDO::PARAM_STR);
        $statement->bindValue(':precio', $clase->getPrecio(), \PDO::PARAM_INT);
        $statement->bindValue(':detalle', $clase->getDetalle(), \PDO::PARAM_STR);
        $statement->bindValue(':dias', $clase->getDias(), \PDO::PARAM_STR);
        $statement->bindValue(':cantidad', $clase->getCantidad(), \PDO::PARAM_INT);
        $statement->bindValue(':id_tipo', $clase->getId_tipo(), \PDO::PARAM_INT);
        if($statement->execute())
        {
            $msg = [
                'viaje' => 'success',
                'msg'  => "Se guardaron los datos correctamente."
            ];
            $c->commit();
        }
        else
        {
            $msg = [
                'viaje' => 'danger',
                'msg'  => 'Codigo: ' . $statement->errorInfo()[0] . ', Error: ' . $statement->errorInfo()[2]
            ];
            $c->rollBack();
        }
    }
}

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';

include DIR_TEMPLATE . '/_msg.html.php';
?>

<div class="container">
<form name="forms" method="post">
    
<?php 
include DIR_TEMPLATE . '/_form_foto.php';
?>
    
    
<?php 
$selected = $clase->getId_provincia();
include DIR_TEMPLATE . '/_form_provincia.php';
?>
    
    <div class="form-group">
        <label for="lugar">Lugar</label>
        <input name="lugar" type="text" class="form-control<?php echo $clase->getError('lugar') ? ' is-invalid' : '' ?>" id="lugar" value="<?php echo $clase->getLugar() ?>" aria-describedby="nombreHelp" placeholder="Nombre">
        <small id="lugarHelp" class="form-text text-muted">Lugar.</small>
        <div class="invalid-feedback">Debe ingresar un lugar</div>
    </div>
    
    <div class="form-group">
        <label for="precio">Precio</label>
        <input name="precio" type="text" class="form-control<?php echo $clase->getError('precio') ? ' is-invalid' : '' ?>" id="precio" value="<?php echo $clase->getPrecio() ?>" aria-describedby="nombreHelp" placeholder="Nombre">
        <small id="precioHelp" class="form-text text-muted">Precio.</small>
        <div class="invalid-feedback">Debe ingresar un precio</div>
    </div>
    
    <div class="form-group">
        <label for="detalle">detalle</label>
        <input name="detalle" type="text" class="form-control<?php echo $clase->getError('detalle') ? ' is-invalid' : '' ?>" id="detalle" value="<?php echo $clase->getDetalle() ?>" aria-describedby="nombreHelp" placeholder="Nombre">
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
        <input name="cantidad" type="text" class="form-control<?php echo $clase->getError('cantidad') ? ' is-invalid' : '' ?>" id="cantidad" value="<?php echo $clase->getCantidad() ?>" aria-describedby="nombreHelp" placeholder="Nombre">
        <small id="cantidadHelp" class="form-text text-muted">Cantidad.</small>
        <div class="invalid-feedback">Debe ser un número válido</div>
    </div>
     
<?php 
$selected = $clase->getId_tipo();
include DIR_TEMPLATE . '/_form_tipo.php';
?>
    
    
    <div class="form-group">
        <button type="submit" class="btn btn-rect btn-grad btn-primary">Guardar</button>
    </div>
</form>

<div class="form-group">
	<a class="btn btn-rect btn-grad btn-info" href="viaje.php" role="button">Volver</a>
</div>

</div>

<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
