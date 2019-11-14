
<div class="container">
<h1 class="t1"><?php echo sprintf("%s de %s", (isset($accion) ? $accion : 'Listado'), ucfirst($clase->getTabla())); ?></h1>

<form enctype="multipart/form-data" name="forms" method="post" class="">

<?php 
if(array_key_exists('a', $_GET) && $_GET['a'] == 'edit')
{
    echo '<input type="hidden" name="method" value="PUT">';
}
?>
    
    <div class="form-group">
        <label for="dni">DNI</label>
        <input name="dni" type="number" class="form-control<?php echo $clase->getError('dni') ? ' is-invalid' : '' ?>" id="dni" value="<?php echo $clase->getDni() ?>" aria-describedby="dniHelp" placeholder="D.N.I." min="2000000" max="100000000" <?php echo $clase->getDni() ? 'readonly' : '' ?>>
        <small id="emailHelp" class="form-text text-muted">Documento Nacional de Identidad (sin puntos).</small>
        <div class="invalid-feedback">Debe ser un número de documento válido</div>
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
        <input name="telefono" type="tel" class="form-control<?php echo $clase->getError('telefono') ? ' is-invalid' : '' ?>" id="telefono" value="<?php echo $clase->getTelefono() ?>" aria-describedby="telefonoHelp" placeholder="(XXX) XXXX-XXXX" size="18" minlength="8" maxlength="14">
        <small id="telefonoHelp" class="form-text text-muted">Ingrese el telefono Ej.(11 4444 5555).</small>
    </div>
    
    <div class="form-group">
        <label for="direccion">Domicilio</label>
        <input name="direccion" type="text" class="form-control<?php echo $clase->getError('direccion') ? ' is-invalid' : '' ?>" id="direccion" value="<?php echo $clase->getDireccion() ?>" aria-describedby="direccionHelp" placeholder="Domicilio">
        <small id="direccionHelp" class="form-text text-muted">Ingrese el direccion.</small>
        <div class="invalid-feedback">Debe ingresar una direccion válida</div>
    </div>
    
<?php 
include DIR_TEMPLATE . '/_form_provincia.php';
?>
    
    <div class="form-group">
        <label for="fechaNacimiento">fecha de Nacimiento</label>
        <input name="fecha_nac" type="date" min="1900-01-01" max="2002-12-31" class="form-control<?php echo $clase->getError('fecha_nac') ? ' is-invalid' : '' ?>" id="fechaNacimiento" value="<?php echo $clase->getFecha_nac() ?>" aria-describedby="fechaNacimientoHelp" placeholder="fechaNacimiento">
        <small id="fechaNacimientoHelp" class="form-text text-muted">Ingrese el fecha de nacimiento.</small>
        <div class="invalid-feedback">Debe ingresar una fecha de nacimiento válido</div>
    </div>
    
    <div class="form-group">
        <label for="email">Correo electrónico</label>
        <input name="email" type="email" class="form-control<?php echo $clase->getError('email') ? ' is-invalid' : '' ?>" id="email" value="<?php echo $clase->getEmail() ?>" aria-describedby="emailHelp" placeholder="Correo electrónico">
        <small id="emailHelp" class="form-text text-muted">Ingrese el email.</small>
        <div class="invalid-feedback">Debe ingresar un correo válido</div>
    </div>
    
<?php 
include DIR_TEMPLATE . '/_form_rol.php';
?>

    <div class="form-group">
        <label for="pass">Contraseña</label>
        <input name="pass" type="password" class="form-control<?php echo $clase->getError('pass') ? ' is-invalid' : '' ?>" id="pass" value="" aria-describedby="passHelp" placeholder="Contraseña">
        <small id="passHelp" class="form-text text-muted">Ingrese una contraseña.</small>
        <div class="invalid-feedback">Debe ser un nombre válido</div>
    </div>
    
    
    <div class="form-group">
        <label for="pass2">Reingresar la Contraseña</label>
        <input name="pass2" type="password" class="form-control<?php echo $clase->getError('pass2') ? ' is-invalid' : '' ?>" id="pass2" value="" aria-describedby="pass2Help" placeholder="Contraseña">
        <small id="pass2Help" class="form-text text-muted">Reingresar la contraseña.</small>
        <div class="invalid-feedback">Debe ser un nombre válido</div>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-rect btn-grad btn-success float-left">Guardar</button>
    </div>
</form>

    <div class="form-group">
    	<a class="btn btn-rect btn-grad btn-info float-left ml-3" href="perfil.php" role="button">Volver</a>
    </div>
    

<?php 
if(array_key_exists('a', $_GET) && $_GET['a'] == 'edit')
{
    include DIR_TEMPLATE . '/_form_borrar.php';
}
?>
    
    
</div>
