<div class="form-group">
    <label for="tipo">Tipo</label>
    <select name="id_tipo">	
	<?php
	try
	{
        $statement = $c->prepare('SELECT * FROM tipo');
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
	<small id="tipoHelp" class="form-text text-muted">Seleccione un tipo.</small>
    <div class="invalid-feedback">Debe elegir un tipo</div>
</div>
    