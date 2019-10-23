<?php

require __DIR__ . '/../../src/autoload.php';

use UPCN\Conexion;
use UPCN\Afiliado;

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';
?>

<div class="container">
<table id="table">
<?php 
$c = new Conexion();
try {
    $statement = $c->prepare('SELECT * FROM perfil');
    $statement->execute();
    echo '<tr>';
    echo "\t<th>DNI</th><th>Nombre</th><th>Apellido</th><th>Telefono</th><th>Rol</th><th>Editar</th>";
    echo '</tr>';
    while ($row = $statement->fetch(\PDO::FETCH_ASSOC))
    {
        echo '<tr>';
        echo "\t<td>" . $row['DNI'] . '</td><td>' . $row['Nombre'] . '</td><td>' . $row['Apellido'] . '</td><td>' . $row['Telefono'] . '</td><td>' . $row['Rol'] . '</td><td><a href="afiliadom.php?edit=' . $row['DNI'] . '"><i class="fas fa-pen"></i></a></td>';
        echo '</tr>';
    }
    $statement = null;
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
