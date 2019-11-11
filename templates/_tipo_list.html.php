<div class="container">
    <div class="form-group my-2">
    	<a class="btn btn-rect btn-grad btn-success" href="<?php echo $clase->getTabla() ?>.php?a=new" role="button">Nuevo</a>
    </div>
    <table id="table">
    	<tr>
    		<th>ID</th><th>Nombre</th><th>Acción</th>
    	</tr>
    <?php 
    try {
        $datos = $clase->select();
        foreach ($datos as $dato)
        {
            echo '<tr>';
            echo sprintf("\t<td>%d</td><td>%s</td><td><a href='%s.php?a=edit&d=%d'><i class='fas fa-pen'></i></a></td>", $dato['id'], $dato['nombre'], $clase->getTabla(), $dato['id']);
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
