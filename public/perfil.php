<?php

require __DIR__ . '/../src/autoload.php';

use UPCN\Conexion;
use UPCN\Perfil;
$c = new Conexion();
include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';
?>



<div class="container">
<form name="Perfil" method="post" class="">

<div class="container">
<table id="table">
<input type="submit" name="editar" value ="Editar">



 <div class="form-group">
        <label for="dni">DNI</label>
        <select name="dni">	
		<?php 
		

		try {
		$statement = $c->prepare('SELECT * FROM perfil');
		$statement->execute();
	
		//echo '<tr>';
		//echo "\t<th>DNI</th><th>Nombre</th><th>Apellido</th><th>Telefono</th><th>Rol</th><th>Editar</th>";
		//echo '</tr>';
	
	 
	
 

		$Perfil = $statement->fetchAll();
		var_dump($Perfil);
		foreach ($Perfil as $dni)
		{ echo '<option value="' . $dni["dni"] .'">'.$rol["Apellido"].' </option>';
			//var_dump($dni);
		}

	
	
    //while ($row = $statement->fetch(\PDO::FETCH_ASSOC))
    //{
		//var_dump($row);
      //  echo '<tr>';
       // echo "\t<td>" . $row['dni'] . '</td><td>' . $row['nombre'] . '</td><td>' . $row['apellido'] . '</td><td>' . $row['telefono'] . '</td><td>' . $row['id_rol'] . '</td><td><a href="Perfilm.php?edit=' . $row['dni'] . '"><i class="fas fa-pen"></i></a></td>';
       // echo '</tr>';
    //}
		$statement = null;
		}
	catch (\PDOException $e)
	{
    echo '<tr>';
    echo '\t<td>' . $e->getMessage() . '</td>';
    echo '</tr>';
	}
	?>
	</select>
		<small id="dniHelp" class="form-text text-muted">Seleccione el DNI.</small>
        <div class="invalid-feedback">Debe elegir un DNI</div>
    </div>
</table>
</div>


</form>
</div>
<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
