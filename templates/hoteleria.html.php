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
						<p class="display-1 mb-5">Hotelería</p>
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
    $statement = $c->prepare('SELECT h.*, p.nombre AS provincia FROM hotel h LEFT JOIN provincia p ON h.id_provincia=p.id');
    $statement->execute();
    $i = 0;
    while($row = $statement->fetch(\PDO::FETCH_ASSOC))
    {
        $clase = new Hotel();
        if(empty($row['foto']))
        {
            $img = $clase->getDefaultImages();
        }
        else
        {
            $img = DIR_UPLOAD_IMG . DIRECTORY_SEPARATOR . $row['foto'];
            if(!file_exists($img))
            {
                $img = DIR_IMG . DIRECTORY_SEPARATOR . $row['foto'];
                if(!file_exists($img))
                {
                    $img = $clase->getDefaultImages();
                }
            }
        }
?>
<div class="col-lg-4 col-md-4 col-sm-6 my-3">
	<div class="caja-simple">
		<div class="caja-thumb" style="background-image: url(<?php echo $img ?>);"></div>
		<div class="p-4 border">
			<div class="pt-2">
				<span><?php echo $row['provincia'] ?></span>
			</div>
			<h5><?php echo $row['nombre'] ?></h5>
			<p><?php echo $row['estrellas'] ?></p>
			<p><?php echo $row['precio'] ?></p>
		</div>
	</div>
</div>
<?php 
    }
    $statement = null;
}
catch (\PDOException $e)
{
    echo '\t' . $e->getMessage();
}
?>
			</div>
		</div>
	</div>
</main>
