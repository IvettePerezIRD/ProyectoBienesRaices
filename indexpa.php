<?php
//Inicio onfiguracion de sesión
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
	header('Location:login.php');//redirige a la página de login si el usuario quiere ingresar sin iniciar sesion
	exit;
}

$now = time();

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
    <title>LEGACY 9 | INICIO</title>
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
				<li class='active launcher'>
					<i class="fas fa-house-user"></i>
					<a href="indexpa.php">Inicio</a>
				</li>
				<li class='launcher'>
					<i class="fas fa-sign"></i>
					<a href="bd/bienes/ver_bienes.php">Inmuebles</a>
				</li>
				<?php
				if($_SESSION['tipousuario'] == "Administrador"){
					echo
				"<li class='launcher'>
					<i class='fas fa-bed'></i>
					<a href='bd/amenidades/ver_amenidades.php'>Amenidades</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-building'></i>
					<a href='bd/tipos/ver_tipos.php'>Tipos</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-users'></i>
					<a href='bd/usuarios/ver_usuarios.php'>Usuarios</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-map-marked-alt'></i>
					<a href='location.php'>Ubicación</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-file-pdf'></i>
					<a href='bd/bienes/pdf.php'>Reporte Bienes</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-file-alt'></i>
					<a href='service.php'>Servicios</a>
				</li";
				}
				?>				
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
			<center><img src="img/bienvenida.png"></center>
			<div class='row' style="margin: 20px">
				<div class='col-lg-12'>
					<div class="form-row">
						<center><div class="form-group col-md-4">
							<h4><b>¿En dónde estoy?</b></h4>
							<p>Esta es la sección administrativa de LEGACY 9, en ella podras gestionar tus datos personales y de los bienes que quieras publicar</p>
							<img src="img/check.png" width="50%">
						</div></center>
						<center><div class="form-group col-md-4">
							<h4><b>¿Cuál es el proceso?</b></h4>
							<p>Al registrar el bien que quieras publicar deberas esperar a que un administrador aprueba o rechaze la publicación</p>
							<img src="img/info.png" width="50%">
						</div></center>
						<center><div class="form-group col-md-4">
							<h4><b>¿Qué sucede si la rechazan?</b></h4>
							<p>No te preocupes, si tu publicación es rechazada podras actualizar de nuevo los datos y solo queda esperar la aprobación</p>
							<img src="img/cross.png" width="50%">
						</div></center>
					</div>
				</div>
			</div>
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
