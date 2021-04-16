<?php
//Inicio onfiguracion de sesión
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
	header('Location:login.php');//redirige a la página de login si el usuario quiere ingresar sin iniciar sesion
	exit;
}

$now = time();

if($_SESSION['tipousuario'] == "Vendedor") {
	header('Location:bd/veriflogout.php'); //redirige a la página de login cuando la sesion expira
}

if($now > $_SESSION['expire']) {
	session_destroy();
	header('Location:login.php'); //redirige a la página de login cuando la sesion expira
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
    <title>LEGACY 9 | TABLAS</title>
    <!-- InstanceEndEditable -->
    <link href="css/application-a07755f5.css" rel="stylesheet" type="text/css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="img/Casita.png" rel="icon" type="image/ico" />
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
	
</head>
	
<body class='main page'>
	<!--Inicio Navbar Horizontal-->
	<div class='navbar navbar-default' id='navbar'>
		<img src="img/Logo%20Legacy%20Arial.png" width="10%"alt="" style="margin-top: 14px"/>
		</a>
		<ul class='nav navbar-nav pull-right'>
			<li>
				<a href='bd/editar_perfil.php'>
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
					<a href="indexpa.php">Inicio</a>
				</li>
				<li class='launcher'>
					<i class="fas fa-sign"></i>
					<a href="bd/bienes/ver_bienes.php">Inmuebles</a>
				</li>
				<li class='launcher'>
					<i class="fas fa-bed"></i>
					<a href="bd/amenidades/ver_amenidades.php">Amenidades</a>
				</li>
				<li class='launcher'>
					<i class="fas fa-building"></i>
					<a href="bd/tipos/ver_tipos.php">Tipos</a>
				</li>
				<li class='launcher'>
					<i class="fas fa-users"></i>
					<a href="bd/usuarios/ver_usuarios.php">Usuarios</a>
				</li>
				<li class='active launcher'>
					<i class="fas fa-map-marked-alt"></i>
					<a href="location.php">Ubicación</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-file-pdf'></i>
					<a href='bd/bienes/pdf.php'>Reporte Bienes</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-file-alt'></i>
					<a href='service.php'>Servicios</a>
				</li
			<!-- InstanceEndEditable -->
				<li class="launcher">
					<i class='fas fa-door-open'></i>
					<a href='bd/veriflogout.php'>Salir</a>
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
			<center><div class='row'>
				<div class='col-lg-12'>
					<div class="form-group col-md-12">
						<h2 class="pull-left"><b>Administración de Ubicaciones</b></h2>
					</div>
					<div class="form-row">
						<div class="form-group col-md-4">
							<img width="300px" height="224px"  src="img/estado.png">
							<h5>Estados</h5>
							<p>This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
							<a class="btn btn-success" href="bd/estados/ver_estados.php">Administrar Estados</a>
						</div>
						<div class="form-group col-md-4">
							<img width="300px" src="img/ciudad.jpg">
							<h5>Ciudades</h5>
							<p>This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
							<a class="btn btn-info" href="bd/ciudades/ver_ciudades.php">Administrar Ciudades</a>
						</div>
						<div class="form-group col-md-4">
							<img width="300px" src="img/localidad.jpg">
							<h5>Localidades</h5>
							<p>This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
							<a class="btn btn-success" href="bd/localidad/ver_localidades.php">Administrar Localidades</a>
						</div>
					</div>
				</div>
			</div></center>
		<!-- InstanceEndEditable -->
		</div>
	</div>
    <!-- Javascripts -->
	<script src="js/jquery-3.3.1.min.js" type="text/javascript" language="javascript"></script>
    <script src="js/jquery.min.jw" type="text/javascript" language="javascript"></script>
    <script src="js/jquery-ui.min.js" type="text/javascript" language="javascript"></script>
    <script src="js/modernizr.min.js" type="text/javascript" language="javascript"></script>
    <script src="js/application-985b892b.js" type="text/javascript" language="javascript"></script>
	<script src="js/7d3eb0a8cb.js" type="text/javascript" language="javascript"></script>
    <!-- Google Analytics -->
    <script>
		var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
		g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
	
</body>
	
<!-- InstanceEnd --></html>