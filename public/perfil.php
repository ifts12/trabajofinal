<?php

require __DIR__ . '/../src/autoload.php';
require DIR_ROOT . '/src/session.php';


use UPCN\Conexion;
use UPCN\Perfil;

$c = new Conexion();

$clase = new Perfil();
if(!empty($_POST))
{
    $clase->validar($_POST);
    if(!$clase->hasError())
    {
        $c->beginTransaction();
        $statement = $c->prepare('SELECT * FROM perfil where dni=:dni');
        $statement->bindValue(':dni', $clase->getDni(), \PDO::PARAM_INT);
        if($statement->execute())
        {
            $row = $statement->fetch(\PDO::FETCH_ASSOC);
            $msg = [
                'tipo' => 'success',
                'msg'  => "Se encontraron los datos del Perfil correctamente."
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
<form enctype="multipart/form-data"  name="Perfil" method="post" class="">
    <div class="form-group">
        <label for="dni">DNI</label>
        <input name="dni" type="number" class="form-control<?php echo $clase->getError('dni') ? ' is-invalid' : '' ?>" id="dni" value="<?php echo $clase->getDni() ?>" aria-describedby="dniHelp" placeholder="D.N.I." min="2000000" max="50000000">
       
		
		<small id="emailHelp" class="form-text text-muted">Documento Nacional de Identidad (sin puntos).</small>
        <div class="invalid-feedback">Debe ser un número de documento válido</div>
    </div>
	
	<div class="form-group">
		<button type="submit" class="btn btn-rect btn-grad btn-primary" onclick = "funcion();">BUSCAR </button>
    </div>
    
	<div class="form-group">
        <label for="nombre">Nombre</label>
        <input name="nombre" type="text" class="form-control<?php echo $clase->getError('nombre') ? ' is-invalid' : '' ?>" id="nombre" value="<?php echo $clase->getNombre() ?>" aria-describedby="nombreHelp" placeholder="Nombre">
        <small id="nombreHelp" class="form-text text-muted">Ingrese el nombre.</small>
        <div class="invalid-feedback">Debe ser un nombre válido</div>
    </div>
    
    <div class="form-group">
        <label for="apellido">Apellido</label>
        <input name="apellido" type="text" class="form-control<?php echo $clase->getError('apellido') ? ' is-invalid' : '' ?>" id="apellido" value="<?php echo $clase->getApellido() ?>" aria-describedby="apellidoHelp" placeholder="Apellido">
        <small id="apellidoHelp" class="form-text text-muted">Ingrese el apellido.</small>
        <div class="invalid-feedback">Debe ser un apellido válido</div>
    </div>
    
    <div class="form-group">
        <label for="telefono">Telefono</label>
        <input name="telefono" type="tel" class="form-control<?php echo $clase->getError('telefono') ? ' is-invalid' : '' ?>" id="telefono" value="<?php echo $clase->getTelefono() ?>" aria-describedby="telefonoHelp" placeholder="Telefono" size="18" minlength="8" maxlength="14">
        <small id="telefonoHelp" class="form-text text-muted">Ingrese el telefono.</small>
    </div>
    
    <div class="form-group">
        <label for="direccion">direccion</label>
        <input name="direccion" type="text" class="form-control<?php echo $clase->getError('direccion') ? ' is-invalid' : '' ?>" id="direccion" value="<?php echo $clase->getDireccion() ?>" aria-describedby="direccionHelp" placeholder="direccion">
        <small id="direccionHelp" class="form-text text-muted">Ingrese el direccion.</small>
        <div class="invalid-feedback">Debe ingresar una direccion válida</div>
    </div>
    

<?php 
$selected = $clase->getId_provincia();
include DIR_TEMPLATE . '/_form_provincia.php';
?>
        
    <div class="form-group">
        <label for="fechaNacimiento">fechaNacimiento</label>
        <input name="fecha_nac" type="date" min="1900-01-01" max="2019-12-31" class="form-control<?php echo $clase->getError('fecha_nac') ? ' is-invalid' : '' ?>" id="fechaNacimiento" value="<?php echo $clase->getFecha_nac() ?>" aria-describedby="fechaNacimientoHelp" placeholder="fechaNacimiento">
        <small id="fechaNacimientoHelp" class="form-text text-muted">Ingrese el fecha de nacimiento.</small>
        <div class="invalid-feedback">Debe ingresar una fecha de nacimiento válido</div>
    </div>
    
    <div class="form-group">
        <label for="email">email</label>
        <input name="email" type="email" class="form-control<?php echo $clase->getError('email') ? ' is-invalid' : '' ?>" id="email" value="<?php echo $clase->getEmail() ?>" aria-describedby="emailHelp" placeholder="email">
        <small id="emailHelp" class="form-text text-muted">Ingrese el email.</small>
        <div class="invalid-feedback">Debe ingresar un correo válido</div>
    </div>
</form>
</div>

<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
