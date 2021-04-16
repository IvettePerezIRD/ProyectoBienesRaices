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
require("../config.php");

$loc = $loc_err = $ciu = $ciu_err = $error = "";
 
if(isset($_POST["ID_Loc"]) && !empty($_POST["ID_Loc"])){
	//validar id
	$id = $_POST["ID_Loc"];
	
	//validar localidad
    $input_loc = trim($_POST["localidad"]);
    if(empty($input_loc)){
        $loc_err = "Por favor ingrese una localidad.";     
    } else{
        $loc = $input_loc;
    }
	
	$input_ciu = trim($_POST["cbx_ciudad"]);
    if(empty($input_ciu)){
        $ciu_err = "Por favor ingrese una ciudad.";     
    } else{
        $ciu = $input_ciu;
    }
	
    if(empty($loc_err) && empty($ciu_err)){
        $sql = "UPDATE localidad SET Nom_Loc = ?, ID_Ciu_Loc = ? WHERE ID_Loc = ?";
		
        if($stmt = mysqli_prepare($mysqli, $sql)){
			mysqli_stmt_bind_param($stmt, "ssi", $param_loc, $param_ciu, $param_id);
			
			$param_ciu = $ciu;
            $param_loc = $loc;
			$param_id = $id;

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
	
}else{
    if(isset($_GET["ID_Loc"]) && !empty(trim($_GET["ID_Loc"]))){
        $id =  trim($_GET["ID_Loc"]);
        
        $sql = "SELECT * FROM localidad WHERE ID_Loc = ?";
        if($stmt = mysqli_prepare($mysqli, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
					
					$loc = $row["Nom_Loc"];
					$ciu = $row["ID_Ciu_Loc"];
					
                } else{
                    header("location: ../error.php");
                    exit();
                }
            } else{
                $error = "Oops! Algo salió mal. Por favor, intentelo de nuevo más tarde.";
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
	$idc =  trim($ciu);
	
	$query = "SELECT ciudad.ID_Est_Ciu FROM ciudad WHERE ID_Ciu = '$ciu'";
	
	if($stmt = mysqli_prepare($mysqli, $query)){
		if(mysqli_stmt_execute($stmt)){
			$resulta = mysqli_stmt_get_result($stmt);
			
			if(mysqli_num_rows($resulta) == 1){
				$row = mysqli_fetch_array($resulta, MYSQLI_ASSOC);
				
				$estado = $row['ID_Est_Ciu'];
			
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
    <title>LEGACY 9 | COLONIAS</title>
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
							<h2 class="pull-left"><b>Cambio</b></h2>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4 <?php echo (!empty($est_err)) ? 'has-error' : ''; ?>">
								<label for="inputState">Estado</label>
								<select name="cbx_estado" id="cbx_estado" class="form-control" required>
									<option value="0">Elegir</option>
									<?php
									//abrir bd para rellenar combo box
									require('../config.php');
									$queryE = "SELECT ID_Est, Nom_Est FROM estado ORDER BY Nom_Est";
									$resultadoE = $mysqli->query($queryE);
									?>
									<?php while($rowE = $resultadoE->fetch_assoc()) { ?>
										<option value="<?php echo $rowE['ID_Est']; ?>" <?php if($rowE['ID_Est']==$estado) { echo 'selected'; } ?>><?php echo $rowE['Nom_Est']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-md-4 <?php echo (!empty($ciu_err)) ? 'has-error' : ''; ?>">
								<label for="inputState">Ciudad</label>
								<select name="cbx_ciudad" id="cbx_ciudad" class="form-control" required>
									<?php
									$queryM = "SELECT ID_Ciu, Nom_Ciu FROM ciudad WHERE ID_Est_Ciu = '$estado' ORDER BY Nom_Ciu";
									$resultadoM = $mysqli->query($queryM);
									?>
									<?php while($rowM = $resultadoM->fetch_assoc()) { ?>
										<option value="<?php echo $rowM['ID_Ciu']; ?>" <?php if($rowM['ID_Ciu']==$ciu) { echo 'selected'; } ?>><?php echo $rowM['Nom_Ciu']; ?></option>
									<?php } mysqli_close($mysqli); //cerrar bd para rellenar combo box ?> 
								</select>
							</div>
							<div class="form-group col-md-3">
								<label>Nombre de la localidad</label>
								<input class='form-control' type="text" name="localidad" value="<?php echo $loc; ?>" placeholder="´Mérida" required>
								<input type="hidden" name="ID_Loc" value="<?php echo $id; ?>"/>
							</div>
							<div class="form-group col-md-3">
								<input type="submit" class="btn btn-success" value="Guardar">
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
