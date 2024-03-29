
<header class="py-3">
<div class="container">
	<div class="row align-items-center">
		<div class="col-2"><img src="images/logo.png" alt="UPCN" width="100%" /></div>
		<div class="col-8">
			<nav>
				<ul class="nav justify-content-center">
					<li class="nav-item">
						<a class="nav-link active" href="index.php">Inicio</a>
					</li>
					<li class="submenu nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="javascript:void;" data-toggle="dropdown">Turismo</a>
					    <div class="dropdown-menu" style="margin-top: -2px">
                            <a class="dropdown-item" href="paquete.php">Paquetes</a>
                            <a class="dropdown-item" href="escapada.php">Escapada</a>
                            <a class="dropdown-item" href="miniturismo.php">Miniturismo</a>
                            <a class="dropdown-item" href="hoteleria.php">Hotelería</a>
                        </div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="historia.php">Quienes somos</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="contacto.php">Contacto</a>
					</li>
					<?php if(isset($user) && @get_class($user) && $user->hasRol(["Administrador","Empleado"])) { ?>
					<li class="submenu nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="javascript:void;" data-toggle="dropdown">Administrar</a>
					    <div class="dropdown-menu" style="margin-top: -2px">
                            <a class="dropdown-item" href="viaje.php">Viaje</a>
							<?php if( $user->hasRol("Administrador")) { ?>
							<a class="dropdown-item" href="hotel.php">Hotel</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="perfil.php">Perfil</a>
                            <a class="dropdown-item" href="rol.php">Rol</a>
                            <a class="dropdown-item" href="tipo_viaje.php">Tipo Viaje</a>
                            <a class="dropdown-item" href="asistencia_medica.php">Asistencia</a>
							<?php } ?>
                        </div>
					</li>
					<?php } ?>
					<?php if(isset($_SESSION['u'])) { ?>
					<li class="submenu nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="javascript:void;" data-toggle="dropdown"><i class="fas fa-user-circle"></i></a>
					    <div class="dropdown-menu" style="margin-top: -2px">
                            <a class="dropdown-item" href="info_perfil.php">Mí Perfil (<?php echo $_SESSION['u'] ?>)</a>
                            <a class="dropdown-item" href="compras.php">Mis viajes</a>
    						<a class="dropdown-item" href="logout.php">Salir</a>
                        </div>
					</li>
					<?php } else { ?>
					<li class="nav-item">
						<a class="nav-link" href="login.php">Ingresar</a>
					<?php } ?>
					</li>
				</ul>
			</nav>
		</div>
		
		<div class="col-2">
			<nav>
				<ul class="nav ml-auto">
					<li class="nav-item"><a class="nav-link" href="https://www.facebook.com/UPCNseccionalCapital/" target="_blank"> <i class="fab fa-facebook-f"></i></a></li>
					<li class="nav-item"><a class="nav-link" href="https://www.twitter.com/UPCNTPNyGCBA" target="_blank"> <i class="fab fa-twitter"></i></a></li>
					<li class="nav-item"><a class="nav-link" href="https://www.instagram.com/upcn_secctpn_y_gcba" target="_blank"> <i class="fab fa-instagram"></i></a></li>
					<li class="nav-item"><a class="nav-link" href="https://www.youtube.com/upcncapital" target="_blank"> <i class="fab fa-youtube"></i></a></li>
				</ul>
			</nav>
		</div>
</header>
