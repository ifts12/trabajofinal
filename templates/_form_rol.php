<div class="form-group">
    <label for="rol">Rol</label>
    <select name="id_rol">	
	<?php
	try
	{
	    $datos = $clase->getRoles();
	    echo '<option value="">Seleccione una opción</option>';
	    foreach ($datos as $dato)
	    {
	        printf('<option value="%d"', $dato["id"]);
	        if($dato["id"] == $clase->getId_rol())
	        {
	            echo ' selected';
	        }
	        printf('>%s</option>', $dato["rol"]);
	    }
	}
	catch (\PDOException $e)
	{
        $e->getMessage();
	}
	?>	
	</select>
	<small id="rolHelp" class="form-text text-muted">Seleccione un Rol.</small>
    <div class="invalid-feedback">Debe elegir una rol</div>
</div>
