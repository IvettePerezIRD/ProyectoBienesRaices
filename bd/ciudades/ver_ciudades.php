<?php
//Inicio onfiguracion de sesión
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
	header('Location:../../login.php');//redirige a la página de login si el usuario quiere ingresar sin iniciar sesion
	exit;
}

$now = time();

if($_SESSION['tipousuario'] == "Vendedor") {
	header('Location:../veriflogout.php'); //redirige a la página de login cuando la sesion expira
}

if($now > $_SESSION['expire']) {
	session_destroy();
	header('Location:../../login.php'); //redirige a la página de login cuando la sesion expira
	exit;
}
//Final onfiguracion de sesión
?>

<!DOCTYPE html>
<html class='no-js' lang='en'><!-- InstanceBegin template="/Templates/paginaadministrativa.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
	
    <meta charset='utf-8'>
    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>LEGACY 9 | CIUDADES</title>
    <!-- InstanceEndEditable -->
    <link href="../../css/application-a07755f5.css" rel="stylesheet" type="text/css" />
    <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../../img/Casita.png" rel="icon" type="image/ico" />
    <!-- InstanceBeginEditable name="head" -->

    <!-- InstanceEndEditable -->
	
</head>
	
<body class='main page'>
	<!--Inicio Navbar Horizontal-->
	<div class='navbar navbar-default' id='navbar'>
		<img src="../../img/Logo%20Legacy%20Arial.png" width="10%"alt="" style="margin-top: 14px"/>
		</a>
		<ul class='nav navbar-nav pull-right'>
			<li>
				<a href='../editar_perfil.php'>
					<i class='icon-pencil'></i>
					Editar Perfil
				</a>
			</li>
			<li class='dropdown user'>
				<a>
					<i class='icon-user'></i>
					<strong><?php echo $_SESSION['username']; ?></strong>
				</a>
			</li>
		</ul>
    </div>
	<!--Fin Navbar Horizontal-->
    <div id='wrapper'>
		<section id='sidebar'>
			<!--Inicio Navbar Vertical-->
			<ul id='dock'>
			<!-- InstanceBeginEditable name="activo" -->
				<li class='launcher'>
					<i class="fas fa-house-user"></i>
					<a href="../../indexpa.php">Inicio</a>
				</li>
				<li class='launcher'>
					<i class="fas fa-sign"></i>
					<a href="../bienes/ver_bienes.php">Inmuebles</a>
				</li>
				<li class='launcher'>
					<i class="fas fa-bed"></i>
					<a href="../amenidades/ver_amenidades.php">Amenidades</a>
				</li>
				<li class='launcher'>
					<i class="fas fa-building"></i>
					<a href="../tipos/ver_tipos.php">Tipos</a>
				</li>
				<li class='launcher'>
					<i class="fas fa-users"></i>
					<a href="../usuarios/ver_usuarios.php">Usuarios</a>
				</li>
				<li class='active launcher'>
					<i class="fas fa-map-marked-alt"></i>
					<a href="../../location.php">Ubicación</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-file-pdf'></i>
					<a href='../bienes/pdf.php'>Reporte Bienes</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-file-alt'></i>
					<a href='../../service.php'>Servicios</a>
				</li>
			<!-- InstanceEndEditable -->
				<li class="launcher">
					<i class='fas fa-door-open'></i>
					<a href='../veriflogout.php'>Salir</a>
				</li>
			</ul>
			<!--Final Navbar Vertical-->
			<div data-toggle='tooltip' id='beaker' title='Made by lab2023'></div>
		</section>
		<section id='tools'>
			<ul class='breadcrumb' id='breadcrumb'>
				<li class='title'>ADMINISTRACIÓN</li>
			</ul>
		</section>
		<!--Inicio Contenido-->
		<div id='content'>
			<!-- InstanceBeginEditable name="CONTENIDO" -->
			<div class="wrapper2">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-8">
								<h2 class="pull-left"><b>Ciudades</b></h2>
							</div>
							<div class="col-md-4">
								<br>
								<a href="crear_ciudades.php" class="btn btn-success pull-right">Agregar nueva ciudad</a>
							</div>
							<?php
							// Include config file
							require_once "../config.php";

							// Attempt select query execution
							$sql = "SELECT ciudad.ID_Ciu, ciudad.Nom_Ciu, estado.Nom_Est FROM ciudad inner join estado on ciudad.ID_Est_Ciu = estado.ID_Est";
							if($result = mysqli_query($mysqli, $sql)){
								if(mysqli_num_rows($result) > 0){
									echo "<table class='table table-bordered table-striped'>";
										echo "<thead>";
											echo "<tr>";
												echo "<th>#</th>";
												echo "<th>Nombre de la ciudad</th>";
												echo "<th>Nombre del estado</th>";
												echo "<th>Acción</th>";
											echo "</tr>";
										echo "</thead>";
										echo "<tbody>";
										while($row = mysqli_fetch_array($result)){
											echo "<tr>";
												echo "<td>" . $row['ID_Ciu'] . "</td>";
												echo "<td>" . $row['Nom_Ciu'] . "</td>";
												echo "<td>" . $row['Nom_Est'] . "</td>";
												echo "<td width='8%'>";
													echo "<a href='cambiar_ciudades.php?ID_Ciu=". $row['ID_Ciu'] ."' title='Actualizar' data-toggle='tooltip'><i class='fas fa-pencil-alt' style='margin-left: 10px; margin-right: 10px'></i></a>";
													echo "<a href='eliminar_ciudades.php?ID_Ciu=". $row['ID_Ciu'] ."' title='Eliminar' data-toggle='tooltip'><i class='fas fa-trash-alt' style='margin-left: 10px; margin-right: 10px'></i></a>";
												echo "</td>";
											echo "</tr>";
										}
										echo "</tbody>";                            
									echo "</table>";
									// Free result set
									mysqli_free_result($result);
								} else{
									echo "<p class='lead'><em>No se han encontrado datos.</em></p>";
								}
							} else{
								echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($mysqli);
							}

							// Close connection
							mysqli_close($mysqli);
							?>
						</div>
					</div>
				</div>
			</div>
			<!-- InstanceEndEditable -->
		</div>
	</div>
    <!-- Javascripts -->
	<script src="../../js/jquery-3.3.1.min.js" type="text/javascript" language="javascript"></script>
    <script src="../../js/jquery.min.jw" type="text/javascript" language="javascript"></script>
    <script src="../../js/jquery-ui.min.js" type="text/javascript" language="javascript"></script>
    <script src="../../js/modernizr.min.js" type="text/javascript" language="javascript"></script>
    <script src="../../js/application-985b892b.js" type="text/javascript" language="javascript"></script>
	<script src="../../js/7d3eb0a8cb.js" type="text/javascript" language="javascript"></script>
    <!-- Google Analytics -->
    <script>
		var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
		g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
	
</body>
	
<!-- InstanceEnd --></html>
