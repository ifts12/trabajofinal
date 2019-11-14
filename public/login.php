<?php

require __DIR__ . '/../src/autoload.php';

@session_start();
unset($_SESSION['u']);

use UPCN\Conexion;
use UPCN\Perfil;

if(!empty($_POST))
{
    $clase = new Perfil();
    $clase->setData($_POST);
    
    if($clase->login(filter_var($_POST['dni'], FILTER_SANITIZE_NUMBER_INT)))
    {
        $_SESSION['u'] = $clase->getDni();
        header('Location: paquete.php');
    }
    else
    {
        $_SESSION['msg'] = json_encode([
            'tipo' => 'danger',
            'msg'  => $clase->getError()
        ]);
    }
}

include DIR_TEMPLATE . '/_head.html.php';
include DIR_TEMPLATE . '/_menu.html.php';
?>

<div class="container">
<?php include DIR_TEMPLATE . '/_msg.html.php'; ?>
</div>

<main>
	<div id="caja" width="100%">
		<div class="caja" style="background-image: url(images/alex-perez-NLUkAA-nDdE-unsplash.jpg); background-size: cover; background-position-y: 55%">
			<div class="container">
				<div class="row align-items-center align-self-center justify-content-center text-center" style="min-height: 600px; height: calc(100vh - 60px)">
					<div class="shadow-lg p-3 mb-5 bg-white rounded col-lg-6 p-md-5 align-self-center">
						<form method="post">
							<div class="form-row py-3">
								<label for="inputUser">Usuario</label>
								<input type="text" class="form-control" id="inputUser" placeholder="Usuario (D.N.I.)" name="dni">
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

<?php 
include DIR_TEMPLATE . '/_javascripts.html.php';
include  DIR_TEMPLATE . '/_foot.html.php';
?>
