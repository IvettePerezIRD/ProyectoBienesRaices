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

<?php

$error = "";

if(isset($_GET["ID_Usu"]) && !empty(trim($_GET["ID_Usu"]))){
    require_once "../config.php";
    
    $sql = "SELECT usuario.ID_Usu, usuario.Email_Usu, usuario.Nom_Usu, usuario.PriApe_Usu, usuario.SegApe_Usu, usuario.Cel_Tel_Usu, usuario.Direccion_Usu, localidad.Nom_Loc, ciudad.Nom_Ciu, estado.Nom_Est, usuario.Tipo_Usu FROM usuario inner join localidad on usuario.ID_Loc_Usu = localidad.ID_Loc inner join ciudad on localidad.ID_Ciu_Loc = ciudad.ID_Ciu inner join estado on ciudad.ID_Est_Ciu = estado.ID_Est WHERE ID_Usu = ?  group by (ID_Usu);";
    
    if($stmt = mysqli_prepare($mysqli, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_GET["ID_Usu"]);
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                $email = $row["Email_Usu"];
				$name = $row["Nom_Usu"];
				$priape = $row["PriApe_Usu"];
				$segape = $row["SegApe_Usu"];
				$num = $row["Cel_Tel_Usu"];
				$address = $row["Direccion_Usu"];
				$est = $row["Nom_Est"];
				$ciu = $row["Nom_Ciu"];
				$loc = $row["Nom_Loc"];
				$tipo = $row["Tipo_Usu"];

				
            } else{
                header("location: ../error.php");
                exit();
            }
            
        } else{
            $error =  "Oops! Algo ha salido mal. Por favor, intentelo de nuevo más tarde.";
        }
    }
     
    mysqli_stmt_close($stmt);
    
    mysqli_close($mysqli);
} else{
    header("location: ../error.php");
    exit();
}
?>

<!DOCTYPE html>
<html class='no-js' lang='en'><!-- InstanceBegin template="/Templates/paginaadministrativa.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
	
    <meta charset='utf-8'>
    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>LEGACY 9 | USUARIOS</title>
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
				<li class='active launcher'>
					<i class="fas fa-users"></i>
					<a href="ver_usuarios.php">Usuarios</a>
				</li>
				<li class='launcher'>
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
			<div class='row'>
				<div class='col-lg-12'>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group col-md-12">
							<?php echo $error; ?>
							<h2 class="pull-left"><b>Solo Lectura</b></h2>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>Nombre (s)</label>
								<p class="form-control-static"><?php echo $name ?></p>
							</div>
							<div class="form-group col-md-4">
								<label>Primer Apellido</label>
								<p class="form-control-static"><?php echo $priape ?></p>
							</div>
							<div class="form-group col-md-4">
								<label>Segundo Apellido</label>
								<p class="form-control-static"><?php echo $segape ?></p>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label>Direccion</label>
								<p class="form-control-static"><?php echo $address ?></p>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>Estado</label>
								<p class="form-control-static"><?php echo $est ?></p>
							</div>
							<div class="form-group col-md-4">
								<label>Ciudad/Municipio</label>
								<p class="form-control-static"><?php echo $ciu ?></p>
							</div>
							<div class="form-group col-md-4">
								<label>Localidad</label>
								<p class="form-control-static"><?php echo $loc ?></p>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>Email</label>
								<p class="form-control-static"><?php echo $email ?></p>
							</div>
							<div class="form-group col-md-4">
								<label>Tipo de usuario</label>
								<p class="form-control-static"><?php echo $tipo ?></p>
							</div>
							<div class="form-group col-md-4">
								<label>Telefono/Celular</label>
								<p class="form-control-static"><?php echo $num ?></p>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<a class="btn btn-success" href="ver_usuarios.php">Volver</a>
							</div>
						</div>
					</form>
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
