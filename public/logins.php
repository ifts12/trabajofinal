<?php

require __DIR__ . '/../src/autoload.php';

use UPCN\Conexion;
use UPCN\Login;

$c = new Conexion();

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';
?>

<div class="container">
<div class="form-group">
	<a class="btn btn-success" href="logina.php" role="button">Nuevo</a>
</div>
<table id="table">
<?php 
try {
    $statement = $c->prepare('SELECT * FROM login');
    $statement->execute();
    echo '<tr>';
    echo "\t<th>ID</th><th>Pass</th><th>Acción</th>";
    echo '</tr>';
    while ($row = $statement->fetch(\PDO::FETCH_ASSOC))
    {
        echo '<tr>';
        echo "\t<td>" . $row['dni'] . '</td><td>' . $row['pass'] . '</td><td><a href="loginm.php?edit=' . $row['dni'] . '"><i class="fas fa-pen"></i></a></td>';
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
