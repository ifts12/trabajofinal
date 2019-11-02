<?php

require __DIR__ . '/../src/autoload.php';
require DIR_ROOT . '/src/session.php';


use UPCN\Conexion;

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';
?>

<div class="container">
<div class="form-group">
	<a class="btn btn-rect btn-grad btn-success" href="hotela.php" role="button">Nuevo</a>
</div>
<table id="table">
<?php 
try {
    $c = new Conexion();
    $statement = $c->prepare('SELECT h.*, p.nombre AS provincia FROM hotel h LEFT JOIN provincia p ON h.id_provincia=p.id');
    if($statement->execute())
    {
        echo '<tr>';
        echo "\t<th>ID</th><th>Nombre</th><th>Provincia</th><th>Estrellas</th><th>Precio</th><th>Cantidad</th><th>Acción</th>";
        echo '</tr>';
        while ($row = $statement->fetch(\PDO::FETCH_ASSOC))
        {
            echo '<tr>';
            echo sprintf("\t<td>%d</td><td>%s</td><td>%s</td><td>%d</td><td>%0.2f</td><td>%d</td><td><a href='hotelm.php?edit=%d'><i class='fas fa-pen'></i></a></td>", $row['id'], $row['nombre'], $row['provincia'], $row['estrellas'], $row['precio'], $row['cantidad'], $row['id']);
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
