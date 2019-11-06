<?php

require __DIR__ . '/../src/autoload.php';
require DIR_ROOT . '/src/session.php';


use UPCN\Conexion;
use UPCN\afiliado;

$c = new Conexion();
$clase = new Afiliado();

if(!empty($_POST))
{
    $clase->validar($_POST);
    if(!$clase->hasError())
    {
        $c->beginTransaction();
        
        $statement = $c->prepare('UPDATE afiliado SET nombre=:nombre, apellido=:apellido, foto=:foto, telefono=:telefono, direccion=:direccion, fecha_nac=:fecha_nac, email=:email, id_rol=:id_rol, provincia=:provincia WHERE dni=:dni');
        $statement->bindValue(':dni', $clase->getDni(), \PDO::PARAM_INT);
        $statement->bindValue(':nombre', $clase->getNombre(), \PDO::PARAM_STR);
        $statement->bindValue(':apellido', $clase->getApellido(), \PDO::PARAM_STR);
        $statement->bindValue(':foto', $clase->getFoto(), \PDO::PARAM_STR);
        $statement->bindValue(':telefono', $clase->getTelefono(), \PDO::PARAM_STR);
        $statement->bindValue(':direccion', $clase->getDireccion(), \PDO::PARAM_STR);
        $statement->bindValue(':fecha_nac', $clase->getFecha_nac(), \PDO::PARAM_STR);
        $statement->bindValue(':email', $clase->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue(':id_rol', $clase->getId_rol(), \PDO::PARAM_STR);
        $statement->bindValue(':provincia', $clase->getProvincia(), \PDO::PARAM_STR);
        
        if($statement->execute())
        {
            $msg = [
                'tipo' => 'success',
                'msg'  => "Se actualizaron los datos del rol correctamente."
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
elseif($_GET && array_key_exists('edit', $_GET) && !empty($_GET['edit']))
{
    try {
        $statement = $c->prepare('SELECT * FROM afiliado WHERE dni=:dni');
        $statement->bindValue(':dni', $_GET['edit'], \PDO::PARAM_INT);
        $statement->execute();
        $clase = $statement->fetchObject(UPCN\afiliado::class);
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
	header('location: afiliado.php');
}

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';


include DIR_TEMPLATE . '/_msg.html.php';
?>

<div class="container">
<form enctype="multipart/form-data"  name="afiliado" method="post">
    <div class="form-group">
        <label for="dni">DNI</label>
        <input name="dni" type="number" class="form-control" id="dni" value="<?php echo $clase->getDni() ?>" aria-describedby="dniHelp" placeholder="D.N.I." min="2000000" max="50000000" readonly>
        <small id="emailHelp" class="form-text text-muted">Documento Nacional de Identidad (sin puntos).</small>
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

    
<?php 
include DIR_TEMPLATE . '/_form_foto.php';
?>
    
    
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
    
    <div class="form-group">
        <label for="email">provincia</label>
        <input name="provincia" type="text" class="form-control<?php echo $clase->getError('provincia') ? ' is-invalid' : '' ?>" id="provincia" value="<?php echo $clase->getProvincia() ?>" aria-describedby="emailHelp" placeholder="Provincia">
        <small id="provinciaHelp" class="form-text text-muted">Ingrese el provincia.</small>
        <div class="invalid-feedback">Debe ingresar una provincia válida</div>
    </div>
    
    <div class="form-group">
        <label for="fechaNacimiento">fechaNacimiento</label>
        <input name="fecha_nac" type="date" min="1900-01-01" max="2019-12-31" class="form-control<?php echo $clase->getError('fechaNacimiento') ? ' is-invalid' : '' ?>" id="fechaNacimiento" value="<?php echo $clase->getFecha_nac() ?>" aria-describedby="fechaNacimientoHelp" placeholder="fechaNacimiento">
        <small id="fechaNacimientoHelp" class="form-text text-muted">Ingrese el fecha de nacimiento.</small>
        <div class="invalid-feedback">Debe ingresar una fecha de nacimiento válido</div>
    </div>
    
    <div class="form-group">
        <label for="email">email</label>
        <input name="email" type="email" class="form-control<?php echo $clase->getError('email') ? ' is-invalid' : '' ?>" id="email" value="<?php echo $clase->getEmail() ?>" aria-describedby="emailHelp" placeholder="email">
        <small id="emailHelp" class="form-text text-muted">Ingrese el email.</small>
        <div class="invalid-feedback">Debe ingresar un correo válido</div>
    </div>
     
    
	
	 <div class="form-group">
        <label for="rol">rol</label>
        <select name="id_rol">	
		<?php
	
		try {
        $statement = $c->prepare('SELECT * FROM rol');
        $statement->execute();
        $clase = $statement->fetchAll();
		//var_dump($afiliado);
		foreach ($clase as $rol)
		{ echo '<option value="' . $rol["id"] .'">'.$rol["rol"].' </option>';
			//var_dump($rol);
		}
	   
		}
		catch (\PDOException $e)
		{
        $e->getMessage();
		}
		?>	
			
      
		</select>
		<small id="rolHelp" class="form-text text-muted">Ingrese el rol.</small>
        <div class="invalid-feedback">Debe elegir un rol</div>
    </div>
	
	
	
    <div class="form-group">
        <button type="submit" class="btn btn-rect btn-grad btn-primary">Actualizar</button>
    </div>
</form>
<form enctype="multipart/form-data"  method="post" onsubmit="return confirm('¿Esta seguro que quiere borrar este item?');">
    <input type="hidden" name="dni" value="<?php echo $clase->getDni() ?>">
    <input type="hidden" name="method" value="DELETE">
    <button class="btn btn-rect btn-grad btn-danger">Borrar</button>
</form>
<div class="form-group">
	<a class="btn btn-rect btn-grad btn-info" href="rol.php" role="button">Volver</a>
</div>

</div>

<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
