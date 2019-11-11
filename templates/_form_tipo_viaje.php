<div class="form-group">
    <label for="tipo_viaje">Tipo Viaje</label>
    <select name="id_tipo_viaje">	
	<?php
	try
	{
	    $datos = $clase->getTipoViaje();
	    echo '<option value="">Seleccione una opción</option>';
	    foreach ($datos as $dato)
	    {
	        printf('<option value="%d"', $dato["id"]);
	        if($dato["id"] == $clase->getId_tipo_viaje())
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
	<small id="tipo_viajeHelp" class="form-text text-muted">Seleccione un tipo de viaje.</small>
    <div class="invalid-feedback">Debe elegir un tipo de viaje</div>
</div>
    