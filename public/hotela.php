<?php

require __DIR__ . '/../src/autoload.php';

use UPCN\Conexion;
use UPCN\Hotel;

$c = new Conexion();
$clase = new Hotel();

if(!empty($_POST))
{
    $clase->validar($_POST);
    if(!$clase->hasError())
    {
        $c->beginTransaction();
        $statement = $c->prepare('INSERT INTO hotel (nombre, id_provincia, estrellas, precio, cantidad) VALUES (:nombre, :id_provincia, :estrellas, :precio, :cantidad)');
        $statement->bindValue(':nombre', $clase->getNombre(), \PDO::PARAM_STR);
        $statement->bindValue(':id_provincia', $clase->getId_provincia(), \PDO::PARAM_INT);
        $statement->bindValue(':estrellas', $clase->getEstrellas(), \PDO::PARAM_INT);
        $statement->bindValue(':precio', $clase->getPrecio(), \PDO::PARAM_INT);
        $statement->bindValue(':cantidad', $clase->getCantidad(), \PDO::PARAM_INT);
        if($statement->execute())
        {
            $msg = [
                'tipo' => 'success',
                'msg'  => "Se guardaron los datos correctamente."
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

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';

include DIR_TEMPLATE . '/_msg.html.php';
?>

<div class="container">
<form name="logines" method="post">
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
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>

<div class="form-group">
	<a class="btn btn-info" href="login.php" role="button">Volver</a>
</div>

</div>

<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
