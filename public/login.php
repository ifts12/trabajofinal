<?php
require __DIR__ . '/../src/autoload.php';

session_start();

use UPCN\Conexion;
use UPCN\Login;

$c = new Conexion();
$clase = new Login();

if(!empty($_POST))
{
    $clase->validar($_POST);
    $msg = [
        'tipo' => 'danger',
        'msg'  => 'Error de usuario o contraseña'
    ];
    
    $c->beginTransaction();
    
echo var_dump($_POST);
echo var_dump($clase);
    $statement = $c->prepare('SELECT * FROM login WHERE dni=:dni');
    $statement->bindValue(':dni', $clase->getDni(), \PDO::PARAM_INT);
//     $statement->bindValue(':pass', password_hash($clase->getPass(), PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]), \PDO::PARAM_STR);
    
    if($statement->execute())
    {
        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        $_SESSION['u'] = $row['dni'];
echo var_dump($row);
        unset($msg);
    }
}


include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';


include DIR_TEMPLATE . '/_msg.html.php';

?>


<div class="container">
<main>
	<div id="caja" width="100%">
		<div class="caja" style="background-image: url(images/alex-perez-NLUkAA-nDdE-unsplash.jpg); background-size: cover; background-position-y: 55%">
			<div class="container">
				<div class="row align-items-center align-self-center justify-content-center text-center" style="min-height: 600px; height: calc(100vh - 60px)">
					<div class="shadow-lg p-3 mb-5 bg-white rounded col-lg-6 p-md-5 align-self-center">
						<form method="post">
							<div class="form-row py-3">
								<label for="inputUser">Usuario</label>
								<input type="text" class="form-control" id="inputUser" placeholder="Usuario (D.N.I.)" name="user">
							</div>
							<div class="form-row py-3">
								<label for="inputPass">Contraseña</label>
								<input type="password" class="form-control" id="inputPass" placeholder="Contraseña" name="pass">
							</div>
							<button type="submit" class="btn btn-rect btn-grad btn-info">Iniciar Sesión</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
</div>

<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
