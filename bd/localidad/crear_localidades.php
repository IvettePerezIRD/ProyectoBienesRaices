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
require('../config.php');

$loc = $loc_err = $ciu = $ciu_err = $error = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	//validar localidad
	$input_loc = trim($_POST["localidad"]);
    if(empty($input_loc)){
        $loc_err = "Por favor ingrese una localidad.";     
    } else{
        $loc = $input_loc;
    }
	
	//validar ciudad
	$input_ciu = trim($_POST["cbx_ciudad"]);
    if(empty($input_ciu)){
        $ciu_err = "Por favor ingrese una ciudad.";     
    } else{
        $ciu = $input_ciu;
    }
	
    if(empty($loc_err) && empty($ciu_err)){
        $sql = "INSERT INTO localidad (Nom_Loc, ID_Ciu_Loc) VALUES (?,?)";
		
        if($stmt = mysqli_prepare($mysqli, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_loc, $param_ciu);
            
			$param_loc = $loc;
			$param_ciu = $ciu;
			
            if(mysqli_stmt_execute($stmt)){
                header("location: ver_localidades.php");
                exit();
            } else{
                $error = "Algo ha salido mal. Por favor, intentelo de nuevo más tarde.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($mysqli);
}
?>

<!DOCTYPE html>
<html class='no-js' lang='en'><!-- InstanceBegin template="/Templates/paginaadministrativa.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
	
    <meta charset='utf-8'>
    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>LEGACY 9 | LOCALIDADES</title>
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
			<div class='row'>
				<div class='col-lg-12'>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
						<div class="form-group col-md-12">
							<?php echo $error ?>
							<h2 class="pull-left"><b>Registro</b></h2>
						</div>
						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Nombre del estado</label>
								<select name="cbx_estado" id="cbx_estado" class="form-control" required>
									<option value="0">Elegir</option>
									<?php
									$query = "SELECT ID_Est, Nom_Est FROM estado ORDER BY Nom_Est";
									$resultado=$mysqli->query($query);
									?>
									<?php while($row = $resultado->fetch_assoc()) { ?>
									<option value="<?php echo $row['ID_Est']; ?>"><?php echo $row['Nom_Est']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-md-3 <?php echo (!empty($loc_err)) ? 'has-error' : ''; ?>">
								<label>Nombre de la ciudad/municipio</label>
								<select name="cbx_ciudad" id="cbx_ciudad" class="form-control" required>
									
								</select>
							</div>
							<div class="form-group col-md-3">
								<label>Nombre de la localidad</label>
								<input type="text" name="localidad" class="form-control" placeholder="Mérida" required>
							</div>
							<div class="form-group col-md-3">
								<br>
								<input type="submit" id="enviar"class="btn btn-success" value="Guardar">
								<a class="btn btn-danger" href="ver_localidades.php">Cancelar</a>
							</div>
						</div>
					</form>
				</div>
			</div>
			<script language="javascript" src="../../js/jquery-3.3.1.min.js"></script>
			<script language="javascript">
			$(document).ready(function(){
				$("#cbx_estado").change(function () {
					
					$("#cbx_estado option:selected").each(function () {
						ID_Est = $(this).val();
						$.post("../includes/getCiudad.php", { ID_Est: ID_Est }, function(data){
							$("#cbx_ciudad").html(data);
						});            
					});
				})
			});
			</script>
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
