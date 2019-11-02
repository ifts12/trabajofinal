<?php

require __DIR__ . '/../src/autoload.php';
require DIR_ROOT . '/src/session.php';


use UPCN\Conexion;
use UPCN\Rol;

$c = new Conexion();

$rol = new Rol();
if(!empty($_POST))
{
    $rol->validar($_POST);
    if(!$rol->hasError())
    {
        $c->beginTransaction();
        
        $statement = $c->prepare('INSERT INTO rol (rol) VALUES (:rol)');
        $statement->bindValue(':rol', $rol->getRol(), \PDO::PARAM_STR);
        
        if($statement->execute())
        {
            $msg = [
                'tipo' => 'success',
                'msg'  => "Se guardaron los datos del afiliado correctamente."
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
<form name="roles" method="post">
    <div class="form-group">
        <label for="rol">Rol</label>
        <input name="rol" type="text" class="form-control<?php echo $rol->getError('rol') ? ' is-invalid' : '' ?>" id="rol" value="<?php echo $rol->getRol() ?>" aria-describedby="rolHelp" placeholder="rol">
        <small id="rolHelp" class="form-text text-muted">Ingrese el rol.</small>
        <div class="invalid-feedback">Debe elegir un rol</div>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-rect btn-grad btn-primary">Guardar</button>
    </div>
</form>

<div class="form-group">
	<a class="btn btn-rect btn-grad btn-info" href="rol.php" role="button">Volver</a>
</div>

</div>

<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
