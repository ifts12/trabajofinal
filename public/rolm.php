<?php

require __DIR__ . '/../src/autoload.php';

use UPCN\Conexion;
use UPCN\Rol;

$c = new Conexion();

if(!empty($_POST))
{
    $rol = new Rol();
    $rol->validar($_POST);
    if(!$rol->hasError())
    {
        $c->beginTransaction();
        
        if(array_key_exists('method', $_POST) && $_POST['method'] == "DELETE")
        {
            $statement = $c->prepare('DELETE FROM rol WHERE id=:id AND rol=:rol');
            $statement->bindValue(':id', $rol->getId(), \PDO::PARAM_INT);
            $statement->bindValue(':rol', $rol->getRol(), \PDO::PARAM_STR);
            $msg = [
                'tipo' => 'warning',
                'msg'  => "Se borraron los datos del rol correctamente."
            ];
            $rol = null;
            unset($rol);
        }
        else 
        {
            $statement = $c->prepare('UPDATE rol SET rol=:rol WHERE id=:id');
            $statement->bindValue(':id', $rol->getId(), \PDO::PARAM_INT);
            $statement->bindValue(':rol', $rol->getRol(), \PDO::PARAM_STR);
            $msg = [
                'tipo' => 'success',
                'msg'  => "Se actualizaron los datos del rol correctamente."
            ];
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
        $statement = $c->prepare('SELECT * FROM rol WHERE id=:id');
        $statement->bindValue(':id', $_GET['edit'], \PDO::PARAM_INT);
        $statement->execute();
        $rol = $statement->fetchObject(UPCN\Rol::class);
        if(empty($rol))
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

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';


include DIR_TEMPLATE . '/_msg.html.php';
?>

<div class="container">
<?php 
if(isset($rol) && !empty($rol))
{
?>
<form name="roles" method="post">
    <div class="form-group">
        <label for="id">rol</label>
        <input name="id" type="number" class="form-control" id="id" value="<?php echo $rol->getId() ?>" aria-describedby="idRolHelp" placeholder="" readonly>
    </div>
    
    <div class="form-group">
        <label for="rol">Rol</label>
        <input name="rol" type="text" class="form-control<?php echo $rol->getError('rol') ? ' is-invalid' : '' ?>" id="rol" value="<?php echo $rol->getRol() ?>" aria-describedby="rolHelp" placeholder="rol">
        <small id="rolHelp" class="form-text text-muted">Ingrese el rol.</small>
        <div class="invalid-feedback">Debe elegir un rol</div>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>
<form method="post" onsubmit="return confirm('¿Esta seguro que quiere borrar este item?');">
    <input type="hidden" name="id" value="<?php echo $rol->getId() ?>">
    <input type="hidden" name="rol" value="<?php echo $rol->getRol() ?>">
    <input type="hidden" name="method" value="DELETE">
    <button class="btn btn-rect btn-grad btn-danger">Borrar</button>
</form>
<?php 
}
?>
<div class="form-group">
	<a class="btn btn-rect btn-grad btn-info" href="rol.php" role="button">Volver</a>
</div>

</div>

<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
