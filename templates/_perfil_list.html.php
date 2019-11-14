<div class="container">
    <div class="form-group my-2">
    	<a class="btn btn-rect btn-grad btn-success" href="<?php echo $clase->getTabla() ?>.php?a=new" role="button">Nuevo</a>
    </div>
    <table id="table" class="table">
    	<tr>
    		<th>ID</th><th>Nombre</th><th>Apellido</th><th>Foto</th><th>Fecha Nac.</th><th>Email</th><th>Rol</th><th>Acción</th>
    	</tr>
    <?php 
    try {
        $datos = $clase->select();
        foreach ($datos as $dato)
        {
            echo '<tr>';
            echo sprintf("\t<td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a href='%s.php?a=edit&d=%d'><i class='fas fa-pen'></i></a></td>", $dato['dni'], $dato['nombre'], $dato['apellido'], $dato['foto'], $dato['fecha_nac'], $dato['email'], $clase->getRol($dato['id_rol']), $clase->getTabla(), $dato['dni']);
            echo '</tr>';
        }
    }
    catch (\PDOException $e)
    {
        echo '<tr>';
        echo '\t<td>' . $e->getMessage() . '</td>';
        echo '</tr>';
    }
    ?>
    </table>
</div>
