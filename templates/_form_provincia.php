<div class="form-group">
    <label for="provincia">Provincia</label>
    <select name="id_provincia">	
	<?php
	try
	{
        $statement = $c->prepare('SELECT * FROM provincia');
        $statement->execute();
        $datos = $statement->fetchAll();
	    echo '<option value="">Seleccione una opción</option>';
        foreach ($datos as $dato)
		{
		    printf('<option value="%d"', $dato["id"]);
		    if($dato["id"] == $selected)
		    {
		        echo ' selected';
		    }
		    printf('>%s</option>', $dato["nombre"]);
		}
	}
	catch (\PDOException $e)
	{
        $e->getMessage();
	}
	?>	
	</select>
	<small id="provinciaHelp" class="form-text text-muted">Seleccione una Provincia.</small>
    <div class="invalid-feedback">Debe elegir una provincia</div>
</div>
    