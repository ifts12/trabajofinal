<div class="container">
    <div class="form-group my-2">
    	<a class="btn btn-rect btn-grad btn-success" href="<?php echo $clase->getTabla() ?>.php?a=new" role="button">Nuevo</a>
    </div>
    <table id="table" class="table">
    	<tr>
    		<th>ID</th><th>Nombre</th><th>Foto</th><th>Provincia</th><th>Estrellas</th><th>Precio</th><th>Cantidad</th><th>Acción</th>
    	</tr>
    <?php 
    try {
        $datos = $clase->select();
        foreach ($datos as $dato)
        {
            echo '<tr>';
            echo sprintf("\t<td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%d</td><td>%0.2f</td><td>%d</td><td><a href='%s.php?a=edit&d=%d'><i class='fas fa-pen'></i></a></td>", $dato['id'], $dato['nombre'], $dato['foto'], $dato['provincia'], $dato['estrellas'], $dato['precio'], $dato['cantidad'], $clase->getTabla(), $dato['id']);
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
