<?php

require __DIR__ . '/../src/autoload.php';
require DIR_ROOT . '/src/session.php';


use UPCN\Conexion;
use UPCN\Viaje;

$c = new Conexion();

if(!empty($_POST))
{
    $clase = new Viaje();
    $clase->validar($_POST);
    if(!$clase->hasError())
    {
        $c->beginTransaction();
        if(array_key_exists('method', $_POST) && $_POST['method'] == "DELETE")
        {
            $statement = $c->prepare('DELETE FROM viaje WHERE id=:id');
            $statement->bindValue(':id', $clase->getId(), \PDO::PARAM_INT);
            $msg = [
                'viaje' => 'warning',
                'msg'  => "Se borraron los datos del rol correctamente."
            ];
            $clase = null;
            unset($clase);
        }
        else 
        {
            $statement = $c->prepare('UPDATE viaje SET foto=:foto, id_provincia=:id_provincia, lugar=:lugar, precio=:precio, detalle=:detalle, dias=:dias, cantidad=:cantidad, id_tipo=:id_tipo WHERE id=:id');
            $statement->bindValue(':foto', $clase->getFoto(), \PDO::PARAM_STR);
            $statement->bindValue(':id_provincia', $clase->getId_provincia(), \PDO::PARAM_INT);
            $statement->bindValue(':lugar', $clase->getLugar(), \PDO::PARAM_STR);
            $statement->bindValue(':precio', $clase->getPrecio(), \PDO::PARAM_INT);
            $statement->bindValue(':detalle', $clase->getDetalle(), \PDO::PARAM_STR);
            $statement->bindValue(':dias', $clase->getDias(), \PDO::PARAM_STR);
            $statement->bindValue(':cantidad', $clase->getCantidad(), \PDO::PARAM_INT);
            $statement->bindValue(':id_tipo', $clase->getId_tipo(), \PDO::PARAM_INT);
            $statement->bindValue(':id', $clase->getId(), \PDO::PARAM_INT);
            
            if($statement->execute())
            {
                $msg = [
                    'tipo' => 'success',
                    'msg'  => "Se actualizaron los datos del rol correctamente."
                ];
                $c->commit();
            }
            else
            {
                $msg = [
                    'tipo' => 'danger',
                    'msg'  => 'Codigo: ' . $statement->errorInfo()[0] . ', Error: ' . $statement->errorInfo()[2]
                ];
                $c->rollBack();
            }
        }
    }
}
elseif($_GET && array_key_exists('edit', $_GET) && !empty($_GET['edit']))
{
    try {
        $statement = $c->prepare('SELECT * FROM viaje WHERE id=:id');
        $statement->bindValue(':id', $_GET['edit'], \PDO::PARAM_INT);
        $statement->execute();
        $clase = $statement->fetchObject(UPCN\Viaje::class);
        if(empty($clase))
        {
            $msg = [
                'viaje' => 'info',
                'msg'  => 'No se encontraron registros'
            ];
        }
    }
    catch (\PDOException $e)
    {
        $e->getMessage();
    }
}
else
{
    header('location: viaje.php');
}

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';

include DIR_TEMPLATE . '/_msg.html.php';
?>

<div class="container">
<?php 
if(isset($clase) && !empty($clase))
{
?>

<form name="forms" method="post">
	<input type="hidden" name="id" value="<?php echo $clase->getId() ?>">

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
        <button type="submit" class="btn btn-rect btn-grad btn-primary">Actualizar</button>
    </div>
</form>
<form method="post" onsubmit="return confirm('¿Esta seguro que quiere borrar este item?');">
    <input type="hidden" name="id" value="<?php echo $clase->getId() ?>">
    <input type="hidden" name="method" value="DELETE">
    <button class="btn btn-rect btn-grad btn-danger">Borrar</button>
</form>
<?php 
}
?>


<div class="form-group">
	<a class="btn btn-rect btn-grad btn-info" href="viaje.php" role="button">Volver</a>
</div>

</div>

<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
