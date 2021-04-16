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

$email = $pass = $name = $priape = $segape = $num = $address = $loc = $tipo  = "";
$email_err = $pass_err = $name_err = $pirape_err = $segape_err = $num_err = $address_err = $loc_err = $tipo_err = $error = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
	//validar email1
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Por favor ingrese un email.";     
    } else{
        $email = $input_email;
    }
	
	//validar password
    $input_pass = trim($_POST["password"]);
    if(empty($input_pass)){
        $pass_err = "Por favor ingrese una contraseña.";     
    } else{
		$pass_cifrado = password_hash($input_pass, PASSWORD_DEFAULT);
        $pass = $pass_cifrado;
    }
	
    //validar nombre
    $input_name = trim($_POST["nombre"]);
    if(empty($input_name)){
        $name_err = "Por favor ingrese el nombre del vendedor.";
    } else{
        $name = $input_name;
    }
    
    //validar apellido1
    $input_priape = trim($_POST["priape"]);
    if(empty($input_priape)){
        $priape_err = "Por favor ingrese el primer apellido del empleado.";
    } else{
        $priape = $input_priape;
    }

    //validar apellido2
	$segape = ($_POST["segape"]);

    //validar num1
    $input_num = trim($_POST["num"]);
    if(empty($input_num)){
        $num_err = "Por favor ingrese un numero.";     
    } else{
        $num = $input_num;
    }
        
    //validar direacción
    $input_address = trim($_POST["direccion"]);
    if(empty($input_address)){
        $address_err = "Por favor ingrese una dirección.";     
    } else{
        $address = $input_address;
    }

    //validar localidad
    $input_loc = trim($_POST["cbx_localidad"]);
    if(empty($input_loc)){
        $loc_err = "Por favor ingrese una localidad.";     
    } else{
        $loc = $input_loc;
    }
	
	//validar tipo
	$input_tipo = trim($_POST["cbx_tipo"]);
    if(empty($input_tipo)){
        $tipo_err = "Por favor ingrese un tipo.";     
    } else{
        $tipo = $input_tipo;
    }
	
    if(empty($email_err) && empty($pass_err) && empty($name_err) && empty($priape_err) && empty($num_err) && empty($address_err) && empty($loc_err) && empty($tipo_err)){
        $sql = "INSERT INTO usuario (Email_Usu, Pass_Usu, Nom_Usu, PriApe_Usu, SegApe_Usu, Cel_Tel_Usu, Direccion_Usu, ID_Loc_Usu, Tipo_Usu) VALUES (?,?,?,?,?,?,?,?,?)";
		
        if($stmt = mysqli_prepare($mysqli, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_email, $param_pass, $param_name, $param_priape, $param_segape, $param_num, $param_address, $param_loc, $param_tipo);
            
			$param_email = $email;
            $param_pass = $pass;
            $param_name = $name;
            $param_priape = $priape;
            $param_segape = $segape;
			$param_num = $num;
            $param_address = $address;
            $param_loc = $loc;
			$param_tipo = $tipo;
			
            if(mysqli_stmt_execute($stmt)){
                header("location: ver_usuarios.php");
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
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
						<div class="form-group col-md-12">
							<?php echo $error; ?>
							<h2 class="pull-left"><b>Registro</b></h2>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4 <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
								<label>Nombre (s)</label>
								<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Lourdes Paulina" required>
							</div>
							<div class="form-group col-md-4 <?php echo (!empty($priape_err)) ? 'has-error' : ''; ?>">
								<label>Primer Apellido</label>
								<input type="text" name="priape" class="form-control" id="priape" placeholder="Pech" required>
							</div>
							<div class="form-group col-md-4">
								<label>Segundo Apellido</label>
								<input type="text" name="segape" class="form-control" id="segape" placeholder="Moo">
							</div>
						</div>
						<div class="form-group">
							<div class="form-group col-md-12 <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
								<label>Direccion</label>
								<input type="text" name="direccion" class="form-control" id="direccion" placeholder="1907 Avenida Lic. Magaly Solis Canto, Fraccionamiento Ana Cecilia Etapa2" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4 <?php echo (!empty($est_err)) ? 'has-error' : ''; ?>">
								<label for="inputState">Estado</label>
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
							<div class="form-group col-md-4 <?php echo (!empty($ciu_err)) ? 'has-error' : ''; ?>">
								<label for="inputState">Ciudad/Municipio</label>
								<select name="cbx_ciudad" id="cbx_ciudad" class="form-control" required>
									
								</select>
							</div>
							<div class="form-group col-md-4 <?php echo (!empty($loc_err)) ? 'has-error' : ''; ?>">
								<label for="inputState">Localidad</label>
								<select name="cbx_localidad" id="cbx_localidad" class="form-control" required>
									
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="form-group col-md-4 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
								<label>Email</label>
								<input class='form-control' placeholder='user01@correo.com' type='email' name="email" id="email" required>
							</div>
							<div class="form-group col-md-4 <?php echo (!empty($pass_err)) ? 'has-error' : ''; ?>">
								<label>Contraseña</label>
								<input class='form-control' placeholder='CiscoClass' type='text' name="password" id="password" required>
							</div>
							<div class="form-group col-md-4 <?php echo (!empty($num_err)) ? 'has-error' : ''; ?>">
								<label>Telefono/Celular</label>
								<input class='form-control' placeholder='9992402137' type='text' name="num" id="num" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
								<label>Tipo de usuario</label>
								<select name="cbx_tipo" id="cbx_tipo" class="form-control" required>
									<option>Vendedor</option>
									<option>Administrador</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<br>
								<input type="submit" class="btn btn-success" value="Guardar">
								<a class="btn btn-danger" href="ver_usuarios.php">Cancelar</a>
							</div>
						</div>
					</form>
				</div>
			</div>
			<script language="javascript" src="../../js/jquery-3.3.1.min.js"></script>
			<script language="javascript">
				$(document).ready(function(){
					$("#cbx_estado").change(function () {
						
						$('#cbx_localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

						$("#cbx_estado option:selected").each(function () {
							ID_Est = $(this).val();
							$.post("../includes/getCiudad.php", { ID_Est: ID_Est }, function(data){
								$("#cbx_ciudad").html(data);
							});            
						});
					})
				});
				

				$(document).ready(function(){
					$("#cbx_ciudad").change(function () {
						$("#cbx_ciudad option:selected").each(function () {
							ID_Ciu = $(this).val();
							$.post("../includes/getLocalidad.php", { ID_Ciu: ID_Ciu }, function(data){
								$("#cbx_localidad").html(data);
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
