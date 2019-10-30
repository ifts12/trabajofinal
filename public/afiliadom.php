<?php

require __DIR__ . '/../src/autoload.php';

use UPCN\Conexion;
use UPCN\Afiliado;

$c = new Conexion();

if(!empty($_POST))
{
    
    $afiliado = new Afiliado();

    $afiliado->validar($_POST);
    if(!$afiliado->hasError())
    {
        $c->beginTransaction();
        
        $statement = $c->prepare('UPDATE perfil SET nombre=:nombre, apellido=:apellido, telefono=:telefono, direccion=:direccion, fechaNacimiento=:fechaNacimiento, email=:email, rol=:rol, provincia=:provincia WHERE dni=:dni');
        $statement->bindValue(':dni', $afiliado->getDni(), \PDO::PARAM_INT);
        $statement->bindValue(':nombre', $afiliado->getNombre(), \PDO::PARAM_STR);
        $statement->bindValue(':apellido', $afiliado->getApellido(), \PDO::PARAM_STR);
        $statement->bindValue(':telefono', $afiliado->getTelefono(), \PDO::PARAM_STR);
        $statement->bindValue(':direccion', $afiliado->getDireccion(), \PDO::PARAM_STR);
        $statement->bindValue(':fechaNacimiento', $afiliado->getFechaNacimiento(), \PDO::PARAM_STR);
        $statement->bindValue(':email', $afiliado->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue(':rol', $afiliado->getRol(), \PDO::PARAM_STR);
        $statement->bindValue(':provincia', $afiliado->getProvincia(), \PDO::PARAM_STR);
        
        if($statement->execute())
        {
            $msg['success'] = "Se actualizaron los datos del afiliado correctamente.";
            $c->commit();
        }
        else
        {
            $msg['error'] = 'Codigo: ' . $statement->errorInfo()[0] . ', Error: ' . $statement->errorInfo()[2];
            $c->rollBack();
        }
    }
}
elseif($_GET && array_key_exists('edit', $_GET) && !empty($_GET['edit']))
{
    try {
        $statement = $c->prepare('SELECT * FROM perfil WHERE dni=:dni');
        $statement->bindValue(':dni', $_GET['edit'], \PDO::PARAM_INT);
        $statement->execute();
        $afiliado = $statement->fetchObject(UPCN\Afiliado::class);
		//var_dump($afiliado);
        $msg['success'] = true;
    }
    catch (\PDOException $e)
    {
        $e->getMessage();
    }
}

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';

if($afiliado->hasError() || array_key_exists('error', $msg))
{
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error </strong> en los datos del afiliado.
    <strong>
<?php echo $msg['error'];
} else {
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>
<?php echo $msg['success'];
} ?>
    </strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="container">
<form name="afiliado" method="post">
    <div class="form-group">
        <label for="dni">DNI</label>
        <input name="dni" type="number" class="form-control" id="dni" value="<?php echo $afiliado->getDni() ?>" aria-describedby="dniHelp" placeholder="D.N.I." min="2000000" max="50000000" readonly>
        <small id="emailHelp" class="form-text text-muted">Documento Nacional de Identidad (sin puntos).</small>
    </div>
    
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input name="nombre" type="text" class="form-control<?php echo $afiliado->getError('nombre') ? ' is-invalid' : '' ?>" id="nombre" value="<?php echo $afiliado->getNombre() ?>" aria-describedby="nombreHelp" placeholder="Nombre">
        <small id="nombreHelp" class="form-text text-muted">Ingrese el nombre.</small>
        <div class="invalid-feedback">Debe ser un nombre válido</div>
    </div>
    
    <div class="form-group">
        <label for="apellido">Apellido</label>
        <input name="apellido" type="text" class="form-control<?php echo $afiliado->getError('apellido') ? ' is-invalid' : '' ?>" id="apellido" value="<?php echo $afiliado->getApellido() ?>" aria-describedby="apellidoHelp" placeholder="Apellido">
        <small id="apellidoHelp" class="form-text text-muted">Ingrese el apellido.</small>
        <div class="invalid-feedback">Debe ser un apellido válido</div>
    </div>
    
    <div class="form-group">
        <label for="telefono">Telefono</label>
        <input name="telefono" type="tel" class="form-control<?php echo $afiliado->getError('telefono') ? ' is-invalid' : '' ?>" id="telefono" value="<?php echo $afiliado->getTelefono() ?>" aria-describedby="telefonoHelp" placeholder="Telefono" size="18" minlength="8" maxlength="14">
        <small id="telefonoHelp" class="form-text text-muted">Ingrese el telefono.</small>
    </div>
    
    <div class="form-group">
        <label for="direccion">direccion</label>
        <input name="direccion" type="text" class="form-control<?php echo $afiliado->getError('direccion') ? ' is-invalid' : '' ?>" id="direccion" value="<?php echo $afiliado->getDireccion() ?>" aria-describedby="direccionHelp" placeholder="direccion">
        <small id="direccionHelp" class="form-text text-muted">Ingrese el direccion.</small>
        <div class="invalid-feedback">Debe ingresar una direccion válida</div>
    </div>
    
    <div class="form-group">
        <label for="email">provincia</label>
        <input name="provincia" type="text" class="form-control<?php echo $afiliado->getError('provincia') ? ' is-invalid' : '' ?>" id="provincia" value="<?php echo $afiliado->getProvincia() ?>" aria-describedby="emailHelp" placeholder="Provincia">
        <small id="provinciaHelp" class="form-text text-muted">Ingrese el provincia.</small>
        <div class="invalid-feedback">Debe ingresar una provincia válida</div>
    </div>
    
    <div class="form-group">
        <label for="fechaNacimiento">fechaNacimiento</label>
        <input name="fechaNacimiento" type="date" min="1900-01-01" max="2019-12-31" class="form-control<?php echo $afiliado->getError('fechaNacimiento') ? ' is-invalid' : '' ?>" id="fechaNacimiento" value="<?php echo $afiliado->getFechaNacimiento() ?>" aria-describedby="fechaNacimientoHelp" placeholder="fechaNacimiento">
        <small id="fechaNacimientoHelp" class="form-text text-muted">Ingrese el fecha de nacimiento.</small>
        <div class="invalid-feedback">Debe ingresar una fecha de nacimiento válido</div>
    </div>
    
    <div class="form-group">
        <label for="email">email</label>
        <input name="email" type="email" class="form-control<?php echo $afiliado->getError('email') ? ' is-invalid' : '' ?>" id="email" value="<?php echo $afiliado->getEmail() ?>" aria-describedby="emailHelp" placeholder="email">
        <small id="emailHelp" class="form-text text-muted">Ingrese el email.</small>
        <div class="invalid-feedback">Debe ingresar un correo válido</div>
    </div>
    
    <div class="form-group">
        <label for="rol">rol</label>
        <input name="rol" type="text" class="form-control<?php echo $afiliado->getError('rol') ? ' is-invalid' : '' ?>" id="rol" value="<?php echo $afiliado->getRol() ?>" aria-describedby="rolHelp" placeholder="rol">
        <small id="rolHelp" class="form-text text-muted">Ingrese el rol.</small>
        <div class="invalid-feedback">Debe elegir un rol</div>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>
<form method="post" onsubmit="return confirm('¿Esta seguro que quiere borrar este item?');">
    <input type="hidden" name="dni" value="<?php echo $afiliado->getDni() ?>">
    <input type="hidden" name="method" value="DELETE">
    <button class="btn btn-flat btn-danger">Borrar</button>
</form>

</div>

<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
