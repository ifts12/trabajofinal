<div class="container">
    <div class="form-group my-2">
    	<a class="btn btn-rect btn-grad btn-success" href="<?php echo $clase->getTabla() ?>.php?a=new" role="button">Nuevo</a>
    </div>
    <table id="table">
    	<tr>
    		<th>ID</th><th>Provincia</th><th>Lugar</th><th>Precio</th><th>Detalle</th><th>Días</th><th>Cantidad</th><th>Tipo</th><th>Acción</th>
    	</tr>
    <?php 
    try {
        $datos = $clase->select();
        foreach ($datos as $dato)
        {
            echo '<tr>';
            echo sprintf("\t<td>%d</td><td>%s</td><td><a href='%s.php?a=edit&d=%d'><i class='fas fa-pen'></i></a></td>", $dato['id'], $dato['nombre'], $clase->getTabla(), $dato['id']);
            echo '</tr>';
            $statement->bindValue(':id_tipo_paquete', $this->getId_tipo(), \PDO::PARAM_INT);
            $statement->bindValue(':foto', $this->getLugar(), \PDO::PARAM_STR);
            $statement->bindValue(':id_provincia', $this->getId_provincia(), \PDO::PARAM_INT);
            $statement->bindValue(':lugar', $this->getLugar(), \PDO::PARAM_STR);
            $statement->bindValue(':precio', $this->getPrecio(), \PDO::PARAM_INT);
            $statement->bindValue(':detalle', $this->getDetalle(), \PDO::PARAM_STR);
            $statement->bindValue(':dias', $this->getDias(), \PDO::PARAM_INT);
            $statement->bindValue(':noches', $this->getNoches(), \PDO::PARAM_INT);
            $statement->bindValue(':fecha_desde', $this->getFecha_desde(), \PDO::PARAM_STR);
            $statement->bindValue(':fecha_hasta', $this->getFecha_hasta(), \PDO::PARAM_STR);
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
