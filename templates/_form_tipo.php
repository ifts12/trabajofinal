<div class="form-group">
    <label for="tipo">Tipo Paquete</label>
    <select name="id_tipo">	
	<?php
	try
	{
	    $datos = $clase->getTipoPaquete();
	    echo '<option value="">Seleccione una opción</option>';
	    foreach ($datos as $dato)
	    {
	        printf('<option value="%d"', $dato["id"]);
	        if($dato["id"] == $clase->getId_tipo())
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
    