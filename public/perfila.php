<?php

require __DIR__ . '/../src/autoload.php';

use UPCN\Conexion;
use UPCN\Perfil;

$c = new Conexion();

$Perfil = new Perfil();

if(!empty($_POST))
{
    $Perfil->validar($_POST);
    if(!$Perfil->hasError())
    {
        $c->beginTransaction();
        
        $statement = $c->prepare('INSERT INTO perfil (dni, nombre, apellido, telefono, direccion, fecha_nac, email, id_rol, provincia, pass) VALUES (:dni, :nombre, :apellido, :telefono, :direccion, :fecha_nac, :email, :id_rol, :provincia, :pass)');
        $statement->bindValue(':dni', $Perfil->getDni(), \PDO::PARAM_INT);
        $statement->bindValue(':nombre', $Perfil->getNombre(), \PDO::PARAM_STR);
        $statement->bindValue(':apellido', $Perfil->getApellido(), \PDO::PARAM_STR);
        $statement->bindValue(':telefono', $Perfil->getTelefono(), \PDO::PARAM_STR);
        $statement->bindValue(':direccion', $Perfil->getDireccion(), \PDO::PARAM_STR);
        $statement->bindValue(':fecha_nac', $Perfil->getFecha_nac(), \PDO::PARAM_STR);
        $statement->bindValue(':email', $Perfil->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue(':id_rol', $Perfil->getId_rol(), \PDO::PARAM_INT);
        $statement->bindValue(':provincia', $Perfil->getId_provincia(), \PDO::PARAM_STR);
        $statement->bindValue(':pass', password_hash($Perfil->getPass(), PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]), \PDO::PARAM_STR);
        
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

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';


include DIR_TEMPLATE . '/_msg.html.php';
?>

<div class="container">
<form name="Perfil" method="post" class="">
    <div class="form-group">
        <label for="dni">DNI</label>
        <input name="dni" type="number" class="form-control<?php echo $Perfil->getError('dni') ? ' is-invalid' : '' ?>" id="dni" value="<?php echo $Perfil->getDni() ?>" aria-describedby="dniHelp" placeholder="D.N.I." min="2000000" max="50000000">
        <small id="emailHelp" class="form-text text-muted">Documento Nacional de Identidad (sin puntos).</small>
        <div class="invalid-feedback">Debe ser un número de documento válido</div>
    </div>
    
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input name="nombre" type="text" class="form-control<?php echo $Perfil->getError('nombre') ? ' is-invalid' : '' ?>" id="nombre" value="<?php echo $Perfil->getNombre() ?>" aria-describedby="nombreHelp" placeholder="Nombre">
        <small id="nombreHelp" class="form-text text-muted">Ingrese el nombre.</small>
        <div class="invalid-feedback">Debe ser un nombre válido</div>
    </div>
    
    <div class="form-group">
        <label for="apellido">Apellido</label>
        <input name="apellido" type="text" class="form-control<?php echo $Perfil->getError('apellido') ? ' is-invalid' : '' ?>" id="apellido" value="<?php echo $Perfil->getApellido() ?>" aria-describedby="apellidoHelp" placeholder="Apellido">
        <small id="apellidoHelp" class="form-text text-muted">Ingrese el apellido.</small>
        <div class="invalid-feedback">Debe ser un apellido válido</div>
    </div>
    
    <div class="form-group">
        <label for="telefono">Telefono</label>
        <input name="telefono" type="tel" class="form-control<?php echo $Perfil->getError('telefono') ? ' is-invalid' : '' ?>" id="telefono" value="<?php echo $Perfil->getTelefono() ?>" aria-describedby="telefonoHelp" placeholder="Telefono" size="18" minlength="8" maxlength="14">
        <small id="telefonoHelp" class="form-text text-muted">Ingrese el telefono.</small>
    </div>
    
    <div class="form-group">
        <label for="direccion">direccion</label>
        <input name="direccion" type="text" class="form-control<?php echo $Perfil->getError('direccion') ? ' is-invalid' : '' ?>" id="direccion" value="<?php echo $Perfil->getDireccion() ?>" aria-describedby="direccionHelp" placeholder="direccion">
        <small id="direccionHelp" class="form-text text-muted">Ingrese el direccion.</small>
        <div class="invalid-feedback">Debe ingresar una direccion válida</div>
    </div>
    
<?php 
$selected = $Perfil->getId_provincia();
include DIR_TEMPLATE . '/_form_provincia.php';
?>
    
    <div class="form-group">
        <label for="fechaNacimiento">fechaNacimiento</label>
        <input name="fecha_nac" type="date" min="1900-01-01" max="2019-12-31" class="form-control<?php echo $Perfil->getError('fecha_nac') ? ' is-invalid' : '' ?>" id="fechaNacimiento" value="<?php echo $Perfil->getFecha_nac() ?>" aria-describedby="fechaNacimientoHelp" placeholder="fechaNacimiento">
        <small id="fechaNacimientoHelp" class="form-text text-muted">Ingrese el fecha de nacimiento.</small>
        <div class="invalid-feedback">Debe ingresar una fecha de nacimiento válido</div>
    </div>
    
    <div class="form-group">
        <label for="email">email</label>
        <input name="email" type="email" class="form-control<?php echo $Perfil->getError('email') ? ' is-invalid' : '' ?>" id="email" value="<?php echo $Perfil->getEmail() ?>" aria-describedby="emailHelp" placeholder="email">
        <small id="emailHelp" class="form-text text-muted">Ingrese el email.</small>
        <div class="invalid-feedback">Debe ingresar un correo válido</div>
    </div>
    
    <div class="form-group">
        <label for="rol">rol</label>
        <select name="id_rol">	
		<?php
		try
		{
            $statement = $c->prepare('SELECT * FROM rol');
            $statement->execute();
            $roles = $statement->fetchAll();
		    echo '<option value="">Seleccione una opción</option>';
            foreach ($roles as $rol)
    		{
    		    echo '<option value="' . $rol["id"] .'" ' . ($rol["id"] == $Perfil->getId_rol() ? 'selected' : '') . '>'.$rol["rol"].' </option>';
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
        <label for="pass">Contraseña</label>
        <input name="pass" type="password" class="form-control<?php echo $Perfil->getError('pass') ? ' is-invalid' : '' ?>" id="pass" value="<?php echo $Perfil->getPass() ?>" aria-describedby="passHelp" placeholder="Contraseña">
        <small id="passHelp" class="form-text text-muted">Ingrese una contraseña.</small>
        <div class="invalid-feedback">Debe ser un nombre válido</div>
    </div>
    
    
    <div class="form-group">
        <label for="pass2">Reingresar la Contraseña</label>
        <input name="pass2" type="password" class="form-control<?php echo $Perfil->getError('pass') ? ' is-invalid' : '' ?>" id="pass2" value="<?php echo $Perfil->getPass() ?>" aria-describedby="pass2Help" placeholder="Contraseña">
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
