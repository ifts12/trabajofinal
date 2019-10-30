<?php

require __DIR__ . '/../src/autoload.php';

use UPCN\Conexion;
use UPCN\Perfil;

$c = new Conexion();

$Perfil = new Perfil();
    //var_dump($_POST);
	//exit;
if(!empty($_POST))
{
    $Perfil->validar($_POST);
    if(!$Perfil->hasError())
    {
        $c->beginTransaction();
        
        $statement = $c->prepare('SELECT * FROM perfil where dni=:dni)');
        $statement->bindValue(':dni', $Perfil->getDni(), \PDO::PARAM_INT);
        $statement->bindValue(':nombre', $Perfil->getNombre(), \PDO::PARAM_STR);
        $statement->bindValue(':apellido', $Perfil->getApellido(), \PDO::PARAM_STR);
        $statement->bindValue(':telefono', $Perfil->getTelefono(), \PDO::PARAM_STR);
        $statement->bindValue(':direccion', $Perfil->getDireccion(), \PDO::PARAM_STR);
        $statement->bindValue(':fecha_nac', $Perfil->getFecha_nac(), \PDO::PARAM_STR);
        $statement->bindValue(':email', $Perfil->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue(':id_rol', $Perfil->getId_rol(), \PDO::PARAM_INT);
        $statement->bindValue(':provincia', $Perfil->getProvincia(), \PDO::PARAM_STR);
        
        if($statement->execute())
        {
            $msg['success'] = "Se encontraron los datos del Perfil correctamente.";
            $c->commit();
        }
        else 
        {
            $msg['error'] = 'Codigo: ' . $statement->errorInfo()[0] . ', Error: ' . $statement->errorInfo()[2];
            $c->rollBack();
        }
    }
}

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';
//var_dump($msg);
?>
 

<div class="container">
<form name="Perfil" method="post" class="">
    <div class="form-group">
        <label for="dni">DNI</label>
        <input name="dni" type="number" class="form-control<?php echo $Perfil->getError('dni') ? ' is-invalid' : '' ?>" id="dni" value="<?php echo $Perfil->getDni() ?>" aria-describedby="dniHelp" placeholder="D.N.I." min="2000000" max="50000000">
        <?php
	
			try {
				$statement = $c->prepare('SELECT nombre FROM perfil where dni=:dni ');
				$statement->execute();
				$Perfil = $statement->fetchAll();
				//var_dump($Perfil);
				//foreach ($Perfil as $perfil)
				//{ 
					//echo '<option value="' . $perfil["dni"] .'">'.$perfil["nombre"].' </option>';
				//var_dump($perfil);
				//}
	   
			}
			catch (\PDOException $e)
			{
				$e->getMessage();
			}
		?>	
		
		<small id="emailHelp" class="form-text text-muted">Documento Nacional de Identidad (sin puntos).</small>
        <div class="invalid-feedback">Debe ser un número de documento válido</div>
    </div>
	
	<div class="form-group">
		<button type="submit" class="btn btn-primary" onclick = "funcion();">BUSCAR </button>
		
    </div> 
	<script>
		function funcion()
		{
		alert('<?php echo accion(); ?>');
		alert(<?php echo nombre; ?>);
		/* Escribir en el Documento*/
		document.write('<?php echo accion(); ?>');
		document.write(<?php echo nombre; ?>);
		}
	script>
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
    
    <div class="form-group">
        <label for="email">provincia</label>
        <input name="provincia" type="text" class="form-control<?php echo $Perfil->getError('provincia') ? ' is-invalid' : '' ?>" id="provincia" value="<?php echo $Perfil->getProvincia() ?>" aria-describedby="emailHelp" placeholder="Provincia">
        <small id="provinciaHelp" class="form-text text-muted">Ingrese el provincia.</small>
        <div class="invalid-feedback">Debe ingresar una provincia válida</div>
    </div>
    
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
</form>
</div>

<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
