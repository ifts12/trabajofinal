<?php

require __DIR__ . '/../src/autoload.php';

use UPCN\Conexion;
use UPCN\Hotel;

$c = new Conexion();

if(!empty($_POST))
{
    $clase = new Hotel();
    $clase->validar($_POST);
    if(!$clase->hasError())
    {
        $c->beginTransaction();
        if(array_key_exists('method', $_POST) && $_POST['method'] == "DELETE")
        {
            $statement = $c->prepare('DELETE FROM hotel WHERE id=:id');
            $statement->bindValue(':id', $clase->getId(), \PDO::PARAM_INT);
            $msg = [
                'tipo' => 'warning',
                'msg'  => "Se borraron los datos del rol correctamente."
            ];
            $clase = null;
            unset($clase);
        }
        else 
        {
            $statement = $c->prepare('UPDATE hotel SET nombre=:nombre, id_provincia=:id_provincia, estrellas=:estrellas, precio=:precio, cantidad=:cantidad WHERE id=:id');
            $statement->bindValue(':nombre', $clase->getNombre(), \PDO::PARAM_STR);
            $statement->bindValue(':id_provincia', $clase->getId_provincia(), \PDO::PARAM_INT);
            $statement->bindValue(':estrellas', $clase->getEstrellas(), \PDO::PARAM_INT);
            $statement->bindValue(':precio', $clase->getPrecio(), \PDO::PARAM_INT);
            $statement->bindValue(':cantidad', $clase->getCantidad(), \PDO::PARAM_INT);
            $statement->bindValue(':id', $clase->getId(), \PDO::PARAM_INT);
        }
        
        if($statement->execute())
        {
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
elseif($_GET && array_key_exists('edit', $_GET) && !empty($_GET['edit']))
{
    try {
        $statement = $c->prepare('SELECT * FROM hotel WHERE id=:id');
        $statement->bindValue(':id', $_GET['edit'], \PDO::PARAM_INT);
        $statement->execute();
        $clase = $statement->fetchObject(UPCN\Hotel::class);
        if(empty($clase))
        {
            $msg = [
                'tipo' => 'info',
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
    header('location: hotels.php');
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

    <div class="form-group">
        <label for="nombre">nombre</label>
        <input name="nombre" type="text" class="form-control<?php echo $clase->getError('nombre') ? ' is-invalid' : '' ?>" id="nombre" value="<?php echo $clase->getNombre() ?>" aria-describedby="nombreHelp" placeholder="Nombre">
        <small id="nombreHelp" class="form-text text-muted">Documento Nacional de Identidad (sin puntos).</small>
        <div class="invalid-feedback">Debe ser un número de documento válido</div>
    </div>
    
<?php 
$selected = $clase->getId_provincia();
include DIR_TEMPLATE . '/_form_provincia.php';
?>
    
    <div class="form-group">
        <label for="estrellas">Estrellas</label>
        <input name="estrellas" type="number" class="form-control<?php echo $clase->getError('estrellas') ? ' is-invalid' : '' ?>" id="estrellas" value="<?php echo $clase->getEstrellas() ?>" aria-describedby="estrellasHelp" placeholder="Estrellas" min="1" max="5">
        <small id="estrellasHelp" class="form-text text-muted">Ingrese una contraseña.</small>
        <div class="invalid-feedback">Debe ser un nombre válido</div>
    </div>
    
    <div class="form-group">
        <label for="pass">Precio</label>
        <input name="precio" type="text" class="form-control<?php echo $clase->getError('precio') ? ' is-invalid' : '' ?>" id="precio" value="<?php echo $clase->getPrecio() ?>" aria-describedby="precioHelp" placeholder="precio">
        <small id="precioHelp" class="form-text text-muted">Ingrese una contraseña.</small>
        <div class="invalid-feedback">Debe ser un nombre válido</div>
    </div>
    
    <div class="form-group">
        <label for="cantidad">Cantidad</label>
        <input name="cantidad" type="number" class="form-control<?php echo $clase->getError('cantidad') ? ' is-invalid' : '' ?>" id="cantidad" value="<?php echo $clase->getCantidad() ?>" aria-describedby="cantidadHelp" placeholder="Cantidad">
        <small id="cantidadHelp" class="form-text text-muted">Ingrese una contraseña.</small>
        <div class="invalid-feedback">Debe ser un nombre válido</div>
    </div>
    
	
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>
<form method="post" onsubmit="return confirm('¿Esta seguro que quiere borrar este item?');">
    <input type="hidden" name="id" value="<?php echo $clase->getId() ?>">
    <input type="hidden" name="method" value="DELETE">
    <button class="btn btn-flat btn-danger">Borrar</button>
</form>
<?php 
}
?>


<div class="form-group">
	<a class="btn btn-info" href="hotels.php" role="button">Volver</a>
</div>

</div>

<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
