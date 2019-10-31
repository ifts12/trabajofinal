<?php

require __DIR__ . '/../src/autoload.php';

use UPCN\Conexion;
use UPCN\Login;

$c = new Conexion();

if(!empty($_POST))
{
    $clase = new Login();
    $clase->validar($_POST);
    if(!$clase->hasError())
    {
        $c->beginTransaction();
        
        if(array_key_exists('method', $_POST) && $_POST['method'] == "DELETE")
        {
            $statement = $c->prepare('DELETE FROM rol WHERE id=:id AND rol=:rol');
            $statement->bindValue(':id', $clase->getId(), \PDO::PARAM_INT);
            $statement->bindValue(':rol', $clase->getRol(), \PDO::PARAM_STR);
            $msg = [
                'tipo' => 'warning',
                'msg'  => "Se borraron los datos del rol correctamente."
            ];
            $clase = null;
            unset($clase);
        }
        else 
        {
            $statement = $c->prepare('UPDATE rol SET rol=:rol WHERE id=:id');
            $statement->bindValue(':id', $clase->getId(), \PDO::PARAM_INT);
            $statement->bindValue(':rol', $clase->getRol(), \PDO::PARAM_STR);
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
        $clase = $statement->fetchObject(UPCN\Rol::class);
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

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';


include DIR_TEMPLATE . '/_msg.html.php';
?>

<div class="container">
<?php 
if(isset($clase) && !empty($clase))
{
?>
<form name="logines" method="post">
    <div class="form-group">
        <label for="dni">DNI</label>
        <input name="dni" type="number" class="form-control<?php echo $clase->getError('dni') ? ' is-invalid' : '' ?>" id="dni" value="<?php echo $clase->getDni() ?>" aria-describedby="dniHelp" placeholder="D.N.I." min="2000000" max="50000000">
        <small id="emailHelp" class="form-text text-muted">Documento Nacional de Identidad (sin puntos).</small>
        <div class="invalid-feedback">Debe ser un número de documento válido</div>
    </div>
    
    <div class="form-group">
        <label for="pass">Contraseña</label>
        <input name="pass" type="password" class="form-control<?php echo $clase->getError('pass') ? ' is-invalid' : '' ?>" id="pass" value="<?php echo $clase->getPass() ?>" aria-describedby="passHelp" placeholder="Contraseña">
        <small id="passHelp" class="form-text text-muted">Ingrese una contraseña.</small>
        <div class="invalid-feedback">Debe ser un nombre válido</div>
    </div>
    
    
    <div class="form-group">
        <label for="pass2">Reingresar la Contraseña</label>
        <input name="pass2" type="password" class="form-control<?php echo $clase->getError('pass') ? ' is-invalid' : '' ?>" id="pass2" value="<?php echo $clase->getPass() ?>" aria-describedby="pass2Help" placeholder="Contraseña">
        <small id="pass2Help" class="form-text text-muted">Reingresar la contraseña.</small>
        <div class="invalid-feedback">Debe ser un nombre válido</div>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>

<form method="post" onsubmit="return confirm('¿Esta seguro que quiere borrar este item?');">
    <input type="hidden" name="id" value="<?php echo $clase->getId() ?>">
    <input type="hidden" name="rol" value="<?php echo $clase->getRol() ?>">
    <input type="hidden" name="method" value="DELETE">
    <button class="btn btn-flat btn-danger">Borrar</button>
</form>
<?php 
}
?>
<div class="form-group">
	<a class="btn btn-info" href="logins.php" role="button">Volver</a>
</div>

</div>

<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
