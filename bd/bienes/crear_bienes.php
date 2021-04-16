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
require('../config.php');

$ruta = $name = $catego = $precio = $tipo = $img = $address = $loc = $desc = $idu = "";
$name_err = $catego_err = $precio_err = $tipo_err = $img_err = $address_err = $loc_err = $desc_err = $error = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //validar nombre
    $input_name = trim($_POST["nombre"]);
    if(empty($input_name)){
        $name_err = "Por favor ingrese el nombre del vendedor.";
    } else{
        $name = $input_name;
    }
    
    //validar categoria
    $input_catego = trim($_POST["cbx_catego"]);
    if(empty($input_catego)){
        $catego_err = "Por favor ingrese una categoria.";
    } else{
        $catego = $input_catego;
    }
	
	//validar precio
	$input_precio = trim($_POST["precio"]);
    if(empty($input_precio)){
        $precio_err = "Por favor ingrese un precio.";
    } else{
        $precio = $input_precio;
    }
	
	//validar tipo
    $input_tipo = trim($_POST["cbx_tipo"]);
    if(empty($input_tipo)){
        $tipo_err = "Por favor ingrese un tipo.";
    } else{
        $tipo = $input_tipo;
    }
	
	//validar imagen
    if(isset($_FILES["img"])){
		$nombreImg = $_FILES['img']['name'];
		$ruta = $_FILES['img']['tmp_name'];
		$img = "imagenes/".$nombreImg;
	}
  
    //validar dirección
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
	
	//validar descripción
    $input_desc = trim($_POST["desc"]);
    if(empty($input_desc)){
        $desc_err = "Por favor ingrese una descripcion.";     
    } else{
        $desc = $input_desc;
    }
	
	$idu = $_POST["ID_oc"];
	
	$estat = "Pendiente";
	
    if(empty($name_err) && empty($catego_err) && empty($precio_err) && empty($tipo_err) && copy($ruta, $img) && empty($address_err) && empty($loc_err) && empty($desc_err)){
        $sql = "INSERT INTO inmueble (Nom_Inm, Catego_Inm, Precio_Inm, ID_Tipo_Inm, Galeria_Inm, Descripcion_Inm, ID_Usu_Inm, Direccion_Inm, ID_Loc_Inm, Estatus_Inm) VALUES (?,?,?,?,?,?,?,?,?,?)";
		
        if($stmt = mysqli_prepare($mysqli, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssssssss", $param_name, $param_catego, $param_precio,  $param_tipo, $param_img, $param_desc, $param_idu, $param_address, $param_loc, $param_estat);
            
            $param_name = $name;
			$param_catego = $catego;
            $param_precio = $precio;
            $param_tipo = $tipo;
            $param_img = $img;
			$param_desc = $desc;
			$param_idu = $idu;
            $param_address = $address;
            $param_loc = $loc;
			$param_estat = $estat;
			
            if(mysqli_stmt_execute($stmt)){
                header("location: ver_bienes.php");
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
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
						<div class="form-group col-md-12">
							<?php echo $error ?>
							<h2 class="pull-left"><b>Registro</b></h2>
						</div>
						<input type="hidden" id="ID_oc" name="ID_oc" value="<?php echo $_SESSION['idusuario']; ?>"></input>
						<div class="form-row">
							<div class="form-group col-md-8 <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
								<label>Nombre</label>
								<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Casa en la colonia Fatima de Guadalupe" required>
							</div>
							<div class="form-group col-md-4 <?php echo (!empty($catego_err)) ? 'has-error' : ''; ?>">
								<label>Categoria</label>
								<select name="cbx_catego" id="cbx_catego" class="form-control" required>
									<option selected>Elegir</option>
									<option>Renta</option>
									<option>Venta</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4 <?php echo (!empty($precio_err)) ? 'has-error' : ''; ?>">
								<label for="inputPassword4">Precio</label>
								<input type="text" name="precio" class="form-control" id="precio" placeholder="999999999.99" required>
							</div>
							<div class="form-group col-md-4 <?php echo (!empty($tipo_err)) ? 'has-error' : ''; ?>">
								<label>Tipo de bien</label>
								<select name="cbx_tipo" id="cbx_tipo" class="form-control" required>
									<option value="0">Elegir</option>
									<?php
									$query = "SELECT ID_Tipo, Nom_Tipo FROM tipo ORDER BY Nom_Tipo";
									$resultado=$mysqli->query($query);
									?>
									<?php while($row = $resultado->fetch_assoc()) { ?>
									<option value="<?php echo $row['ID_Tipo']; ?>"><?php echo $row['Nom_Tipo']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-md-4 <?php echo (!empty($img_err)) ? 'has-error' : ''; ?>">
								<label>Imagen del lugar</label>
								<input type="file" name="img" id="img" required>
							</div>
						</div>
						<div class="form-group">
							<div class="form-group col-md-12 <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
								<label>Dirección</label>
								<input type="text" name="direccion" class="form-control" id="direccion" placeholder="1907 Avenida Lic. Magaly Solis Canto, Fraccionamiento Ana Cecilia Etapa2" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4 <?php echo (!empty($est_err)) ? 'has-error' : ''; ?>">
								<label>Estado</label>
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
								<label>Ciudad/Municipio</label>
								<select name="cbx_ciudad" id="cbx_ciudad" class="form-control" required>
									
								</select>
							</div>
							<div class="form-group col-md-4 <?php echo (!empty($loc_err)) ? 'has-error' : ''; ?>">
								<label>Localidad</label>
								<select name="cbx_localidad" id="cbx_localidad" class="form-control" required>
									
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="form-group col-md-12 <?php echo (!empty($desc_err)) ? 'has-error' : ''; ?>">
								<label>Descripción</label>
								<textarea style="height: 159px;" class='form-control' placeholder='Casa de 270 m2 a espaldas de la Avenida Dra. Alda Heredia' name="desc" id="desc" required></textarea>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<br>
								<input type="submit" class="btn btn-success" value="Guardar">
								<a class="btn btn-danger" href="ver_bienes.php">Cancelar</a>
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
