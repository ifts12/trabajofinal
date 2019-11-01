<?php

require __DIR__ . '/../src/autoload.php';

use UPCN\Conexion;
use UPCN\Tipo;

$c = new Conexion();

if(!empty($_POST))
{
    $clase = new Tipo();
    $clase->validar($_POST);
    if(!$clase->hasError())
    {
        $c->beginTransaction();
        if(array_key_exists('method', $_POST) && $_POST['method'] == "DELETE")
        {
            $statement = $c->prepare('DELETE FROM tipo WHERE id=:id');
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
            $statement = $c->prepare('UPDATE tipo SET nombre=:nombre WHERE id=:id');
            $statement->bindValue(':nombre', $clase->getNombre(), \PDO::PARAM_STR);
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
        $statement = $c->prepare('SELECT * FROM tipo WHERE id=:id');
        $statement->bindValue(':id', $_GET['edit'], \PDO::PARAM_INT);
        $statement->execute();
        $clase = $statement->fetchObject(UPCN\Tipo::class);
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
    header('location: tipo.php');
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
        <small id="nombreHelp" class="form-text text-muted">Tipo de Turismo.</small>
        <div class="invalid-feedback">Debe ingresar un nombre</div>
    </div>
    
	
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
	<a class="btn btn-rect btn-grad btn-info" href="tipo.php" role="button">Volver</a>
</div>

</div>

<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
