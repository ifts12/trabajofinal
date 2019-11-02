<?php

require __DIR__ . '/../src/autoload.php';
require DIR_ROOT . '/src/session.php';


use UPCN\Conexion;
use UPCN\Tipo;

$c = new Conexion();
$clase = new Tipo();

if(!empty($_POST))
{
    $clase->validar($_POST);
    if(!$clase->hasError())
    {
        $c->beginTransaction();
        $statement = $c->prepare('INSERT INTO tipo (nombre) VALUES (:nombre)');
        $statement->bindValue(':nombre', $clase->getNombre(), \PDO::PARAM_STR);
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
    
    <div class="form-group">
        <button type="submit" class="btn btn-rect btn-grad btn-primary">Guardar</button>
    </div>
</form>

<div class="form-group">
	<a class="btn btn-rect btn-grad btn-info" href="tipo.php" role="button">Volver</a>
</div>

</div>

<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
