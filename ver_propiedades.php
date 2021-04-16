<?php
if(isset($_GET["ID_Inm"]) && !empty(trim($_GET["ID_Inm"]))){
    require_once "bd/config.php";
    
    $sql = "SELECT inmueble.Nom_Inm, inmueble.Catego_Inm, concat('$', inmueble.Precio_Inm) as Precio_Inm, tipo.Nom_Tipo, inmueble.Galeria_Inm, inmueble.Descripcion_Inm, concat(usuario.Nom_Usu, ' ', usuario.PriApe_Usu, ' ', usuario.SegApe_Usu) as 'Usuario_Inm', usuario.Email_Usu, concat(inmueble.Direccion_Inm, '. ', localidad.Nom_Loc, ', ', ciudad.Nom_Ciu, ', ', estado.Nom_Est) as 'Direccion_Inm' FROM inmueble inner join tipo on inmueble.ID_Tipo_Inm = tipo.ID_Tipo inner join usuario on inmueble.ID_Usu_Inm = usuario.ID_Usu inner join localidad on inmueble.ID_Loc_Inm = localidad.ID_Loc inner join ciudad on localidad.ID_Ciu_Loc = ciudad.ID_Ciu inner join estado on ciudad.ID_Est_Ciu = estado.ID_Est WHERE ID_Inm = ? group by (ID_Inm);";
    
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
				$email = $row["Email_Usu"];
				$address = $row["Direccion_Inm"];

				
            } else{
                header("location: ../error.php");
                exit();
            }
            
        } else{
            echo "Oops! Algo ha salido mal. Por favor, intentelo de nuevo más tarde uwu.";
        }
    }
     
    mysqli_stmt_close($stmt);
    
    mysqli_close($mysqli);
} else{
    header("location: ../error.php");
    exit();
}
?>

<!doctype html>
<html><!-- InstanceBegin template="/Templates/paginamaestra.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>LEGACY 9 | BIENES</title>
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
						<?php
					if($catego == "Venta"){
						echo 	"<a class='active dropdown-item' href='venta.php'>Venta</a>
								<a class='dropdown-item' href='renta.php'>Renta</a>";
					}elseif($catego == "Renta"){
						echo 	"<a class='dropdown-item' href='venta.php'>Venta</a>
								<a class='active dropdown-item' href='renta.php'>Renta</a>";
					}
					?>
						
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
	<div class='row' style="margin: 20px; color: #fff">
		<div class='col-lg-12'>
			<center><h3><b><?php echo $name ?></b></h3></center>
			<div class="form-row">	
				<div class="form-group col-md-6">
					<center><img src="bd/bienes/<?php echo $img ?>" width="90%">
				</div></center>
				<div class="form-group col-md-6">
					<b><p><font size="3"><b>Categoria:</b> <?php echo $catego ?></p>
					<p><b>Precio:</b> <?php echo $precio ?></p>
					<p><b>Tipo:</b> <?php echo $tipo ?></p>
					<p><b>Descripción:</b> <?php echo $desc ?></p>
					<p><b>Dirección:</b> <?php echo $address ?></p>
					<p><b>Vendedor/a:</b> <?php echo $usu ?></p>
					<p><b>Contacto:</b> <?php echo $email ?></font></p>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<?php
					// Include config file
					require ("bd/config.php");
					// Attempt select query execution
					$sql = "SELECT amenidad.Nom_Ame, cantidad.Valor_Can FROM cantidad inner join amenidad on cantidad.ID_Ame_Can = amenidad.ID_Ame WHERE ID_Inm_Can = $param_id";
					if($resultado = mysqli_query($mysqli, $sql)){
						if(mysqli_num_rows($resultado) > 0){
							echo "<table class='table table-bordered table-striped'>";
								echo "<thead>";
									echo "<tr>";
										echo "<th style='color: #fff;'><b>Amenidad</b></th>";
										echo "<th style='color: #fff;'><b>Cantidad</b></th>";
									echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
								while($row = mysqli_fetch_array($resultado)){
									echo "<tr>";
										echo "<td style='color: #fff;'>" . $row['Nom_Ame'] . "</td>";
										echo "<td style='color: #fff;'>" . $row['Valor_Can'] . "</td>";
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
				<center><div class="form-group col-md-6">
					<br>
					<?php
					if($catego == "Venta"){
						echo "<a class='btn btn-outline-light' href='venta.php'>Volver</a>";
					}elseif($catego == "Renta"){
						echo "<a class='btn btn-outline-light' href='renta.php'>Volver</a>";
					}
					?>
				</div></center>
			</div>
		</div>
	</div>
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




