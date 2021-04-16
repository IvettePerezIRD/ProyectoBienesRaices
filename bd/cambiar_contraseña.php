<?php
//Inicio onfiguracion de sesión
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
	header('Location:../login.php');//redirige a la página de login si el usuario quiere ingresar sin iniciar sesion
	exit;
}

$now = time();

if($now > $_SESSION['expire']) {
	session_destroy();
	header('Location:../login.php'); //redirige a la página de login cuando la sesion expira
	exit;
}
//Final onfiguracion de sesión
?>

<?php
require('config.php');

$pass = $pass_con = "";
$pass_err = $pass_con_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id = $_POST["ID_Usu"];
	
	//validar password
    $input_pass = trim($_POST["password"]);
    if(empty($input_pass)){
        $pass_err = "Por favor ingrese una contraseña.";     
    } else{
		$pass_cifrado = password_hash($input_pass, PASSWORD_DEFAULT);
        $pass = $pass_cifrado;
    }
	
    //validar nombre
    $input_pass_con = trim($_POST["password_confirm"]);
    if(empty($input_pass_con)){
        $pass_con_err = "Por favor ingrese bien la contraseña.";
    } else{
        $pass_con = $input_pass_con;
    }
	
    if(empty($email_err) && empty($pass_err) && ($_POST["password"] = $_POST["password_confirm"])){
        $sql = "UPDATE usuario SET Pass_Usu = ? WHERE ID_Usu = ?";
		
        if($stmt = mysqli_prepare($mysqli, $sql)){
			mysqli_stmt_bind_param($stmt, "si", $param_pass, $param_id);
			
			$param_pass = $pass;
			$param_id = $id;

            if(mysqli_stmt_execute($stmt)){
                header("location: editar_perfil.php");
                exit();
            } else{
                echo "Algo ha salido mal. Por favor, intentelo de nuevo más tarde.";
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
    <title>LEGACY 9 | EDITAR PERFIL</title>
    <!-- InstanceEndEditable -->
    <link href="../css/application-a07755f5.css" rel="stylesheet" type="text/css" />
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../img/Casita.png" rel="icon" type="image/ico" />
    <!-- InstanceBeginEditable name="head" -->

    <!-- InstanceEndEditable -->
	
</head>
	
<body class='main page'>
	<!--Inicio Navbar Horizontal-->
	<div class='navbar navbar-default' id='navbar'>
		<img src="../img/Logo%20Legacy%20Arial.png" width="10%"alt="" style="margin-top: 14px"/>
		</a>
		<ul class='nav navbar-nav pull-right'>
			<li>
				<a href='editar_perfil.php'>
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
					<a href="../indexpa.php">Inicio</a>
				</li>
				<li class='launcher'>
					<i class="fas fa-sign"></i>
					<a href="bienes/ver_bienes.php">Inmuebles</a>
				</li>
				<?php
				if($_SESSION['tipousuario'] == "Administrador"){
					echo
				"<li class='launcher'>
					<i class='fas fa-bed'></i>
					<a href='amenidades/ver_amenidades.php'>Amenidades</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-building'></i>
					<a href='tipos/ver_tipos.php'>Tipos</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-users'></i>
					<a href='usuarios/ver_usuarios.php'>Vendedores</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-map-marked-alt'></i>
					<a href='../location.php'>Ubicación</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-file-pdf'></i>
					<a href='bienes/pdf.php'>Reporte Bienes</a>
				</li>
				<li class='launcher'>
					<i class='fas fa-file-alt'></i>
					<a href='../service.php'>Servicios</a>
				</li>";
				}
				?>
			<!-- InstanceEndEditable -->
				<li class="launcher">
					<i class='fas fa-door-open'></i>
					<a href='veriflogout.php'>Salir</a>
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
							<h2 class="pull-left"><b>Editar Datos Personales | Contraseña</b></h2>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
								<label>Contraseña nueva</label>
								<input class="form-control" placeholder='CiscoClass' type='text' name="password" id="password" required>
							</div>
							<div class="form-group col-md-4 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
								<label>Confirmar contraseña</label>
								<input class="form-control" placeholder='CiscoClass' type='text' name="password_confirm" id="password_confirm" required>
							</div>
							<div class="form-group col-md-4">
								<br>
								<input type="hidden" name="ID_Usu" id="ID_Usu" value="<?php echo $_SESSION['idusuario'] ?>"/>
								<input type="submit" class="btn btn-success" value="Guardar">
								<a class="btn btn-danger" href="editar_perfil.php">Cancelar</a>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- InstanceEndEditable -->
		</div>
	</div>
    <!-- Javascripts -->
	<script src="../js/jquery-3.3.1.min.js" type="text/javascript" language="javascript"></script>
    <script src="../js/jquery.min.jw" type="text/javascript" language="javascript"></script>
    <script src="../js/jquery-ui.min.js" type="text/javascript" language="javascript"></script>
    <script src="../js/modernizr.min.js" type="text/javascript" language="javascript"></script>
    <script src="../js/application-985b892b.js" type="text/javascript" language="javascript"></script>
	<script src="../js/7d3eb0a8cb.js" type="text/javascript" language="javascript"></script>
    <!-- Google Analytics -->
    <script>
		var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
		g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
	
</body>
	
<!-- InstanceEnd --></html>
