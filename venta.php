<?php
//Inicio onfiguracion de sesión
session_start();

//Final onfiguracion de sesión
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/paginamaestra.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>LEGACY 9 | VENTA</title>
	<!-- InstanceEndEditable -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/mdb.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="img/Casita.png" rel="icon" type="image/ico" />
	<!-- InstanceBeginEditable name="head" -->

	<!-- InstanceEndEditable -->
</head>

<body style="padding-top: 70px; background-color:#061F20;" class="color-block mb-3 mx-auto rounded-circle z-depth-1">

<!--Inicio Navbar-->
<header>
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark rgba-black-strong">
		<a class="navbar-brand" href="index.php"><img src="img/Logo%20Legacy%20Arial.png" width="15%"alt=""></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<!-- InstanceBeginEditable name="Navbar" -->
				<li class="nav-item">
					<a class="nav-link" href="index.php">Inicio<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="service.php">Servicios</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="our.php">Nosostros</a>
				</li>
				<li class="active nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catalogo</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown1">
						<a class="active dropdown-item" href="venta.php">Venta</a>
						<a class="dropdown-item" href="renta.php">Renta</a>
					</div>
				</li>
				<!-- InstanceEndEditable -->
			</ul>
			<form class="form-inline my-2 my-lg-0">
			<?php
				error_reporting(0);
				if($_SESSION['tipousuario'] == "Administrador"){

					echo
					"
					<a href='indexpa.php' class='btn btn-outline-danger btn-sm'>Administración</a>
					";
				}else{
					echo
					"
					<a href='login.php' class='btn btn-outline-light btn-sm' style='border: none'>ACCEDER/REGISTRO</a>
					";
				}
				?>
			</form>
		</div>
	</nav>
</header>
<!--Final Navbar-->
	<!-- load CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="css/bootstrap.min.css">                                  <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/fontawesome-all.min.css">                <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>                       <!-- http://kenwheeler.github.io/slick/ -->
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css"/>
    <link rel="stylesheet" href="css/tooplate-style.css">                               <!-- Templatemo style -->

    <script>document.documentElement.className="js";var supportsCssVars=function(){var e,t=document.createElement("style");return t.innerHTML="root: { --tmp-var: bold; }",document.head.appendChild(t),e=!!(window.CSS&&window.CSS.supports&&window.CSS.supports("font-weight","var(--tmp-var)")),t.parentNode.removeChild(t),e};supportsCssVars()||alert("Please view this in a modern browser such as latest version of Chrome or Microsoft Edge.");</script>

	<!--Javascripts-->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap-4.3.1.js"></script>
<!--Javascripts-->
<!-- InstanceBeginEditable name="ContenidoEditable" -->
	<?php
	// Include config file
	require_once "bd/config.php";
	$sql = "SELECT inmueble.ID_Inm, inmueble.Nom_Inm, inmueble.Precio_Inm, tipo.Nom_Tipo, inmueble.Galeria_Inm, inmueble.Descripcion_Inm FROM inmueble inner join tipo on inmueble.ID_Tipo_Inm = tipo.ID_Tipo WHERE Catego_Inm = 'Venta' AND Estatus_Inm = 'Aceptado';";
	if($result = mysqli_query($mysqli, $sql)){
		if(mysqli_num_rows($result) > 0){
			echo "<table border=0 style='margin: 20px'>";
			while($row = mysqli_fetch_array($result)){
				echo "<tr>";
					echo "<td width='20%'><center><img src='bd/bienes/". $row['Galeria_Inm'] ."' class='card-img-top'></center><br></td>";
					echo "<td  width='40%'>
							<h3 class='card-title'>" . $row['Nom_Inm'] . "</h3>
							<p style='color: #fff'><font size=4>
								Precio: $". $row['Precio_Inm'] ."<br>Tipo: ". $row['Nom_Tipo'] ."<br>Descripción: ". $row['Descripcion_Inm'] ."<br><a class='btn btn-outline-light btn-sm' href='ver_propiedades.php?ID_Inm=". $row['ID_Inm'] ."' title='Ver más'>Ver más</a>
							</font></p>
						</td>";
				echo "</tr>";
			}
			echo "</table>";
			mysqli_free_result($result);
		} else{
			echo "<p class='lead'><em>No se han encontrado datos.</em></p>";
		}
	} else{
		echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($mysqli);
	}
	mysqli_close($mysqli);
	?>
	<!-- InstanceEndEditable -->
	
<!--Inicio de pie pagina-->
<!--<footer>
	<div class='row'>
		<div class='col-lg-12'>
			<div class="form-row">
				<div class="form-group col-md-4">
					<h5>
						<p>CONTACTO: 999 123 4567 <img src="../img/Logo%20whats.png" width="47" height="47" alt=""/></p>
					</h5>
				</div>
				<div class="form-group col-md-4">
					<h5>
						<p>LEGACY 9 Copyright &copy; 2020</p>
					</h5>
				</div>
				<div class="form-group col-md-4">
					<h5>
						<p>REDES: @LEGACY_9 <img src="img/Logo%20Facebook.png" width="47" height="47" alt=""/><img src="../img/Logo%20Twitter.png" width="47" height="47" alt=""/></p>
					</h5>
				</div>
			</div>
		</div>
	</div>
</footer>-->
	
<!--Final de pie pagina-->
</body>

<!-- InstanceEnd --></html>




