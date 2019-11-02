<?php

require __DIR__ . '/../src/autoload.php';
require DIR_ROOT . '/src/session.php';


use UPCN\Conexion;

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';
?>

<div class="container">
<div class="form-group">
	<a class="btn btn-rect btn-grad btn-success" href="viajea.php" role="button">Nuevo</a>
</div>
<table id="table">
<?php 
try {
    $c = new Conexion();
    $statement = $c->prepare('SELECT v.*, p.nombre AS provincia, t.nombre AS tipo FROM viaje v LEFT JOIN provincia p ON v.id_provincia=p.id LEFT JOIN tipo t ON v.id_tipo=t.id');
    if($statement->execute())
    {
        echo '<tr>';
        echo "\t<th>ID</th><th>Provincia</th><th>Lugar</th><th>Precio</th><th>Detalle</th><th>Días</th><th>Cantidad</th><th>Tipo</th><th>Acción</th>";
        echo '</tr>';
        while ($row = $statement->fetch(\PDO::FETCH_ASSOC))
        {
            echo '<tr>';
            echo sprintf("\t<td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a href='viajem.php?edit=%d'><i class='fas fa-pen'></i></a></td>", $row['id'], $row['provincia'], $row['lugar'], $row['precio'], $row['detalle'], $row['dias'], $row['cantidad'], $row['tipo'], $row['id']);
            echo '</tr>';
        }
    }
    else
    {
        echo "VACIO";
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

<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
