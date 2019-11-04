<?php 

use UPCN\Conexion;
use UPCN\Hotel;

?>


<main>
	<div id="caja" width="100%">
		<div class="caja" style="background-image: url(images/khachik-simonian-nXOB-wh4Oyc-unsplash.jpg); background-size: cover;">
			<div class="container">
				<div class="row align-items-center align-self-center justify-content-center text-center" style="min-height: 600px; height: calc(100vh - 60px)">
					<div class="col-md-8">
						<h1 class="text-white font-weight-light">Turismo</h1>
						<p class="mb-5">Hotelería</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="my-5">
		<div class="container">
			<h1>Hotelería</h1>
	
			<div class="row justify-content-center">


<?php 

$c = new Conexion();
try {
    $statement = $c->prepare('SELECT * FROM hotel');
    $statement->execute();
    echo '<tr>';
    echo "\t<th>ID</th><th>Rol</th><th>Acción</th>";
    echo '</tr>';
//     $rows = $statement->fetchObject(Hotel::class);
//     $rows = $statement->fetch(\PDO::FETCH_ASSOC);
    $rows = $statement->fetchAll();
    
    echo '<pre>';
    echo var_dump($statement->rowCount());
    echo var_dump($rows);
    echo '</pre>';
//     while ($row = $statement->fetchObject(Hotel::class))
//     {
//         echo '<pre>';
//         echo var_dump($row);
//         echo '</pre>';
//     }
    $statement = null;
}
catch (\PDOException $e)
{
    echo '<tr>';
    echo '\t<td>' . $e->getMessage() . '</td>';
    echo '</tr>';
}

// 				<div class="col-lg-4 col-md-4 col-sm-6">
// 					<div class="caja-simple">
// 						<div class="caja-thumb">
// 							<img class="img-fluid rounded-circle" src="images/janko-ferlic-specialdaddy-MIUqc2mmdBA-unsplash-4x4.jpg" alt="">
// 						</div>
// 						<div class="p-4">
// 							<div class="pt-2">
// 								<span>Mendoza</span>
// 							</div>
// 							<h5><a href="#">Con termas de Cacheuta</a></h5>
// 							<p>4 días / 2 noches.</p>
// 							<p>Media pensión.</p>
// 							<ul>
// 								<li>Hotel Sol Andino: $5.677</li>
// 								<li>Hotel Cordón del Plata: $6.176</li>
// 							</ul>
// 						</div>
// 					</div>
// 				</div>
				
// 				<div class="col-lg-4 col-md-4 col-sm-6">
// 					<div class="caja-simple">
// 						<div class="caja-thumb">
// 							<img class="img-fluid rounded-circle" src="images/lucas-favre-WK4lhYGRIzw-unsplash-4x4.jpg" alt="">
// 						</div>
// 						<div class="p-4">
// 							<div class="pt-2">
// 								<span>San Luis</span>
// 							</div>
// 							<h5><a href="#">Parque Nacional Sierras de la Quijada</a></h5>
// 							<p>4 días / 2 noches.</p>
// 							<p>Media pensión.</p>
// 							<ul>
// 								<li>Gran Hotel San Luis: $6.778</li>
// 							</ul>
// 						</div>
// 					</div>
// 				</div>
				
// 				<div class="col-lg-4 col-md-4 col-sm-6">
// 					<div class="caja-simple">
// 						<div class="caja-thumb">
// 							<img class="img-fluid rounded-circle" src="images/marion-michele-WGGSNlYzhKM-unsplash-4x4.jpg" alt="">
// 						</div>
// 						<div class="p-4">
// 							<div class="pt-2">
// 								<span>Córdoba</span>
// 							</div>
// 							<h5><a href="#">Villa Carlos Paz</a></h5>
// 							<p>4 días / 2 noches.</p>
// 							<p>Pensión completa.</p>
// 							<ul>
// 								<li>Hotel El Mirador: $5.531</li>
// 								<li>Hotel Kalton: $6.262</li>
// 							</ul>
// 						</div>
// 					</div>
// 				</div>
				
?>
			</div>
		</div>
	</div>
</main>
