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

$name = $catego = $precio = $tipo = $address = $loc = $desc = "";
$name_err = $catego_err = $precio_err = $tipo_err = $address_err = $loc_err = $desc_err = $error = "";

if(isset($_POST["ID_Inm"]) && !empty($_POST["ID_Inm"])){
	//validar id
	$id = $_POST["ID_Inm"];
	
	//validar nombre
    $input_name = trim($_POST["nombre"]);
    if(empty($input_name)){
        $name_err = "Por favor ingrese el nombre del vendedor.";
    }else{
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
	$dir_subida = 'imagenes/';
    $fichero_subido = $dir_subida . basename($_FILES['img']['name']);
	$fotoElimiar = $_POST['fotoAnterior'];
	
    if(isset($_FILES['img']['name'])){
		if (basename($_FILES['img']['name']) != ""){
			$img = "imagenes/".basename($_FILES['img']['name']);
		}else{
			$img = "";
		}	
	}else{
		$img = "";
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
	
	$stat = "Pendiente";
	
	if(empty($name_err) && empty($catego_err) && empty($precio_err) && empty($tipo_err) && empty($address_err) && empty($loc_err) && empty($desc_err)){
		
		if($img != ""){	
			unlink($fotoElimiar);
			$fichero_subido = $dir_subida . basename($_FILES['img']['name']);
			move_uploaded_file($_FILES['img']['tmp_name'], $fichero_subido);
			
			$sql = "UPDATE inmueble SET Nom_Inm = ?, Catego_Inm = ?, Precio_Inm = ?, ID_Tipo_Inm = ?, Galeria_Inm = ?, Descripcion_Inm = ?, Direccion_Inm = ?, ID_Loc_Inm = ?, Estatus_Inm = ? WHERE ID_Inm = ?";
		
			if($stmt = mysqli_prepare($mysqli, $sql)){
				mysqli_stmt_bind_param($stmt, "sssssssssi", $param_name, $param_catego, $param_precio, $param_tipo, $param_img, $param_desc, $param_address, $param_loc, $param_stat, $param_id);

				$param_name = $name;
				$param_catego = $catego;
				$param_precio = $precio;
				$param_tipo = $tipo;
				$param_img = $img;
				$param_desc = $desc;
				$param_address = $address;
				$param_loc = $loc;
				$param_stat = $stat;
				$param_id = $id;

				if(mysqli_stmt_execute($stmt)){
					header("location: ver_bienes.php");
					exit();
				} else{
					$error = "Algo ha salido mal. Por favor, intentelo de nuevo más tarde.";
				}
			}
			
		}else{
			$sql = "UPDATE inmueble SET Nom_Inm = ?, Catego_Inm = ?, Precio_Inm = ?, ID_Tipo_Inm = ?, Descripcion_Inm = ?, Direccion_Inm = ?, ID_Loc_Inm = ?, Estatus_Inm = ? WHERE ID_Inm = ?";
		
			if($stmt = mysqli_prepare($mysqli, $sql)){
				mysqli_stmt_bind_param($stmt, "ssssssssi", $param_name, $param_catego, $param_precio, $param_tipo, $param_desc, $param_address, $param_loc, $param_stat, $param_id);

				$param_name = $name;
				$param_catego = $catego;
				$param_precio = $precio;
				$param_tipo = $tipo;
				$param_desc = $desc;
				$param_address = $address;
				$param_loc = $loc;
				$param_stat = $stat;
				$param_id = $id;

				if(mysqli_stmt_execute($stmt)){
					header("location: ver_bienes.php");
					exit();
				} else{
					$error = "Algo ha salido mal. Por favor, intentelo de nuevo más tarde.";
				}
			}
		}
		
        mysqli_stmt_close($stmt);
    }
	
	mysqli_close($mysqli);
	
}else{
    if(isset($_GET["ID_Inm"]) && !empty(trim($_GET["ID_Inm"]))){
        $id =  trim($_GET["ID_Inm"]);
        
        $sql = "SELECT Nom_Inm, Catego_Inm, Precio_Inm, ID_Tipo_Inm, Galeria_Inm, Descripcion_Inm, Direccion_Inm, ID_Loc_Inm FROM inmueble WHERE ID_Inm = ?";
        if($stmt = mysqli_prepare($mysqli, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
					
					$name = $row["Nom_Inm"];
					$catego = $row["Catego_Inm"];
					$precio = $row["Precio_Inm"];
					$tipo = $row["ID_Tipo_Inm"];
					$img = $row["Galeria_Inm"];
					$desc = $row["Descripcion_Inm"];
					$address = $row["Direccion_Inm"];
					$loc = $row["ID_Loc_Inm"];
					
                } else{
                    header("location: ../error.php");
                    exit();
                }
                
            } else{
                $error = "Algo ha salido mal. Por favor, intentelo de nuevo más tarde.";
            }
        }
        mysqli_stmt_close($stmt);
		mysqli_close($mysqli);
		
    }  else{
        header("location: ../error.php");
        exit();
    }
}
?>

<?php
require('../config.php');

if(isset($id) && !empty(trim($id))){
	$idl =  trim($loc);
	
	$query = "SELECT localidad.ID_Ciu_Loc, ciudad.ID_Est_Ciu FROM localidad INNER JOIN ciudad ON localidad.ID_Ciu_Loc = ciudad.ID_Ciu WHERE ID_Loc = '$loc'";
	
	if($stmt = mysqli_prepare($mysqli, $query)){
		if(mysqli_stmt_execute($stmt)){
			$resulta = mysqli_stmt_get_result($stmt);
			
			if(mysqli_num_rows($resulta) == 1){
				$row = mysqli_fetch_array($resulta, MYSQLI_ASSOC);
				
				$estado = $row['ID_Est_Ciu'];
				$municipio = $row['ID_Ciu_Loc'];
			
			} else{
				header("location: ../error.php");
				exit();
			}
		} else{
			echo "Oops! Algo salió mal. Por favor, intentelo de nuevo más tarde uwu.";
		}
	}
	mysqli_stmt_close($stmt);
}
mysqli_close($mysqli);			
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
							<h2 class="pull-left"><b>Cambio</b></h2>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8 <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
								<label>Nombre</label>
								<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Casa en la colonia Fatima de Guadalupe" value="<?php echo $name; ?>" required>
							</div>
							<div class="form-group col-md-4 <?php echo (!empty($catego_err)) ? 'has-error' : ''; ?>">
								<label>Categoria</label>
								<select name="cbx_catego" id="cbx_catego" class="form-control" required>
									<option>Elegir</option>
									<?php
									if ($catego == "Renta") {
										echo "<option Selected>Renta</option>
											<option>Venta</option>";
									}elseif ($catego == "Venta"){
										echo "<option>Renta</option>
											<option Selected>Venta</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4 <?php echo (!empty($precio_err)) ? 'has-error' : ''; ?>">
								<label>Precio</label>
								<input type="text" name="precio" class="form-control" id="precio" placeholder="999999999.99" value="<?php echo $precio; ?>" required>
							</div>
							<div class="form-group col-md-4 <?php echo (!empty($tipo_err)) ? 'has-error' : ''; ?>">
								<label>Tipo de bien</label>
								<select name="cbx_tipo" id="cbx_tipo" class="form-control" required>
									<option value="0">Elegir</option>
									<?php
									//abrir bd para rellenar combo box
									require('../config.php');
									$queryE = "SELECT ID_Tipo, Nom_Tipo FROM tipo ORDER BY Nom_Tipo";
									$resultadoE = $mysqli->query($queryE);
									?>
									<?php while($rowE = $resultadoE->fetch_assoc()) { ?>
										<option value="<?php echo $rowE['ID_Tipo']; ?>" <?php if($rowE['ID_Tipo'] == $tipo) { echo 'selected'; } ?>><?php echo $rowE['Nom_Tipo']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-md-4 <?php echo (!empty($img_err)) ? 'has-error' : ''; ?>">
								<label>Imagen del lugar</label>
								<input type="text" id="fotoAnterior" value="<?php echo $row['Galeria_Inm']; ?>" name="fotoAnterior" style="visibility:hidden">
								<input type="file" name="img" id="img">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12 <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
								<label>Direccion</label>
								<input type="text" name="direccion" class="form-control" id="direccion" placeholder="1907 Avenida Lic. Magaly Solis Canto, Fraccionamiento Ana Cecilia Etapa2" value="<?php echo $address; ?>" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4 <?php echo (!empty($est_err)) ? 'has-error' : ''; ?>">
								<label>Estado</label>
								<select name="cbx_estado" id="cbx_estado" class="form-control" required>
									<option value="0">Elegir</option>
									<?php
									$queryE = "SELECT ID_Est, Nom_Est FROM estado ORDER BY Nom_Est";
									$resultadoE = $mysqli->query($queryE);
									?>
									<?php while($rowE = $resultadoE->fetch_assoc()) { ?>
										<option value="<?php echo $rowE['ID_Est']; ?>" <?php if($rowE['ID_Est'] == $estado) { echo 'selected'; } ?>><?php echo $rowE['Nom_Est']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-md-4 <?php echo (!empty($ciu_err)) ? 'has-error' : ''; ?>">
								<label>Ciudad/Municipio</label>
								<select name="cbx_ciudad" id="cbx_ciudad" class="form-control" required>
									<?php
									$queryM = "SELECT ID_Ciu, Nom_Ciu FROM ciudad WHERE ID_Est_Ciu = $estado ORDER BY Nom_Ciu";
									$resultadoM = $mysqli->query($queryM);
									?>
									<?php while($rowM = $resultadoM->fetch_assoc()) { ?>
										<option value="<?php echo $rowM['ID_Ciu']; ?>" <?php if($rowM['ID_Ciu']== $municipio) { echo 'selected'; } ?>><?php echo $rowM['Nom_Ciu']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-md-4 <?php echo (!empty($loc_err)) ? 'has-error' : ''; ?>">
								<label>Localidad</label>
								<select name="cbx_localidad" id="cbx_localidad" class="form-control" required>
									<?php
									$queryL = "SELECT ID_Loc, Nom_Loc FROM localidad WHERE ID_Ciu_Loc = $municipio ORDER BY Nom_Loc";
									$resultadoL = $mysqli->query($queryL);
									?>
									<?php while($rowL = $resultadoL->fetch_assoc()) { ?>
										<option value="<?php echo $rowL['ID_Loc']; ?>" <?php if($rowL['ID_Loc']== $loc) { echo 'selected'; } ?>><?php echo $rowL['Nom_Loc']; ?></option>
									<?php } mysqli_close($mysqli); //cierre de bd para rellenar combo box?> 
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="form-group col-md-12 <?php echo (!empty($desc_err)) ? 'has-error' : ''; ?>">
								<label>Descripción</label>
								<textarea style="height: 159px;" class='form-control' placeholder='Casa de 270 m2 a espaldas de la Avenida Dra. Alda Heredia' name="desc" id="desc" required><?php echo $desc; ?></textarea>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<input type="hidden" name="ID_Inm" value="<?php echo $id; ?>"/>
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
