<?php
//Inicio onfiguracion de sesión
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
	header('Location:../../login.php');//redirige a la página de login si el usuario quiere ingresar sin iniciar sesion
	exit;
}

$now = time();

if($now > $_SESSION['expire']) {
	session_destroy();
	header('Location:../../login.php'); //redirige a la página de login cuando la sesion expira
	exit;
}
//Final onfiguracion de sesión
?>

<?php

$error = "";

if(isset($_GET["ID_Inm"]) && !empty(trim($_GET["ID_Inm"]))){
    require_once "../config.php";
    
    $sql = "SELECT inmueble.ID_Inm, inmueble.Nom_Inm, inmueble.Catego_Inm, concat('$', inmueble.Precio_Inm) as Precio_Inm, tipo.Nom_Tipo, inmueble.Galeria_Inm, inmueble.Descripcion_Inm, concat(usuario.Nom_Usu, ' ', usuario.PriApe_Usu, ' ', usuario.SegApe_Usu) as Usuario_Inm, inmueble.Direccion_Inm, localidad.Nom_Loc, ciudad.Nom_Ciu, estado.Nom_Est FROM inmueble inner join tipo on inmueble.ID_Tipo_Inm = tipo.ID_Tipo inner join usuario on inmueble.ID_Usu_Inm = usuario.ID_Usu inner join localidad on inmueble.ID_Loc_Inm = localidad.ID_Loc inner join ciudad on localidad.ID_Ciu_Loc = ciudad.ID_Ciu inner join estado on ciudad.ID_Est_Ciu = estado.ID_Est WHERE ID_Inm = ? group by (ID_Inm);";
    
    if($stmt = mysqli_prepare($mysqli, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_GET["ID_Inm"]);
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                $name = $row["Nom_Inm"];
				$catego = $row["Catego_Inm"];
				$precio = $row["Precio_Inm"];
				$tipo = $row["Nom_Tipo"];
				$img = $row["Galeria_Inm"];
				$desc = $row["Descripcion_Inm"];
				$usu = $row["Usuario_Inm"];
				$address = $row["Direccion_Inm"];
				$est = $row["Nom_Est"];
				$ciu = $row["Nom_Ciu"];
				$loc = $row["Nom_Loc"];

				
            } else{
                header("location: ../error.php");
                exit();
            }
            
        } else{
            $error = "Oops! Algo ha salido mal. Por favor, intentelo de nuevo más tarde.";
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
    <title>LEGACY 9 | BIENES</title>
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
				<li class='active launcher'>
					<i class="fas fa-sign"></i>
					<a href="ver_bienes.php">Inmuebles</a>
				</li>
				<?php
				if($_SESSION['tipousuario'] == "Administrador"){
					echo
				"<li class='launcher'>
					<i class='fas fa-bed'></i>
					<a href='../amenidades/ver_amenidades.php'>Amenidades</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-building'></i>
					<a href='../tipos/ver_tipos.php'>Tipos</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-users'></i>
					<a href='../usuarios/ver_usuarios.php'>Vendedores</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-map-marked-alt'></i>
					<a href='../../location.php'>Ubicación</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-file-pdf'></i>
					<a href='pdf.php'>Reporte Bienes</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-file-alt'></i>
					<a href='../../service.php'>Servicios</a>
				</li>";
				}
				?>
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
							<?php echo $error ?>
							<h2 class="pull-left"><b>Solo Lectura</b></h2>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label>Nombre</label>
								<p class="form-control-static"><?php echo $name ?></p>
							</div>
							<div class="form-group col-md-4">
								<label>Categoria</label>
								<p class="form-control-static"><?php echo $catego ?></p>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>Precio</label>
								<p class="form-control-static"><?php echo $precio ?></p>
							</div>
							<div class="form-group col-md-4">
								<label>Tipo de bien</label>
								<p class="form-control-static"><?php echo $tipo ?></p>
							</div>
							<div class="form-group col-md-4">
								<label>Vendedor</label>
								<p class="form-control-static"><?php echo $usu ?></p>
							</div>
						</div>
						<div class="form-group">
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
							<div class="form-group col-md-12">
								<label>Descripcion</label>
								<p class="form-control-static"><?php echo $desc ?></p>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<center><img width="700" src="<?php echo $img ?>"></center>
							</div>
							<div class="form-group col-md-4">
								<?php
								// Include config file
								require ("../config.php");
								// Attempt select query execution
								$sql = "SELECT amenidad.Nom_Ame, cantidad.Valor_Can FROM cantidad inner join amenidad on cantidad.ID_Ame_Can = amenidad.ID_Ame WHERE ID_Inm_Can = $param_id";
								if($resultado = mysqli_query($mysqli, $sql)){
									if(mysqli_num_rows($resultado) > 0){
										echo "<table class='table table-bordered table-striped'>";
											echo "<thead>";
												echo "<tr>";
													echo "<th>Amenidad</th>";
													echo "<th>Cantidad</th>";
												echo "</tr>";
											echo "</thead>";
											echo "<tbody>";
											while($row = mysqli_fetch_array($resultado)){
												echo "<tr>";
													echo "<td>" . $row['Nom_Ame'] . "</td>";
													echo "<td>" . $row['Valor_Can'] . "</td>";
												echo "</tr>";
											}
											echo "</tbody>";                            
										echo "</table>";
										// Free result set
										mysqli_free_result($resultado);
									} else{
										echo "<p class='lead'><em>No se han encontrado datos.</em></p><br>";
									}
								} else{
									echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($mysqli);
								}

								// Close connection
								mysqli_close($mysqli);
								?>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<a class="btn btn-success" href="ver_bienes.php">Volver</a>
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
