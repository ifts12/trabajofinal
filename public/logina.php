<?php

require __DIR__ . '/../src/autoload.php';

use UPCN\Conexion;
use UPCN\Login;

$c = new Conexion();

$clase = new Login();
if(!empty($_POST))
{
    $clase->validar($_POST);
    if(!$clase->hasError())
    {
        $c->beginTransaction();
        
        $statement = $c->prepare('INSERT INTO login (dni, pass) VALUES (:dni, :pass)');
        $statement->bindValue(':dni', $clase->getDni(), \PDO::PARAM_INT);
        $statement->bindValue(':pass', password_hash($clase->getPass(), PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]), \PDO::PARAM_STR);
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
