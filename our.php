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
	<title>LEGACY 9 | NOSOTROS</title>
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
				<li class="active nav-item">
					<a class="nav-link" href="our.php">Nosostros</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catalogo</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown1">
						<a class="dropdown-item" href="venta.php">Venta</a>
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
	<!--Grid column-->
	<div class="col-md-12 mb-4">
		<div class="card card-image" style="background-image: url(img/legacy.jpg);">
			<div class="text-white text-center d-flex align-items-center py-5 px-4">
				<div>
					<h6 class="purple-text"><i class="fas fa-plane"></i><strong> </strong></h6>
					<h3 class="card-title py-3 font-weight-bold"><strong>LEGACY 9</strong></h3>
					<p class="pb-3"><h2><strong>LEGACY 9 tiene 20 años trabajando en el mercado de bienes raíces, comprometiéndose a continuar ofreciendo sus servicios con una alta calidad, cuenta con personal capacitado para ofrecer servicio de ayuda y consultas personalizadas a sus clientes.</strong></h2></p>
				</div>
			</div>
		</div>
	</div>
	<!--Grid column-->
	<div class="card-group" style="margin: 20px;">
		<div class="card text-center border-light" style="background-color: #061F20">
			<img src="img/tarjeta1.png" class="card-img-top" alt="...">
			<div class="card-body">
				<p class="card-text" style="color: #fff">
					En febrero de 1999, en la ciudad de Mérida, Yucatán la Lic. Lula Alejandra Moguel Canto, decide incursionar en negocios de bienes raíces, para ello crea una empresa llamada LEGACY. 
				</p>
			</div>
		</div>
		<div class="card text-center border-light" style="background-color: #061F20">
			<img src="img/tarjeta2.png" class="card-img-top" alt="...">
			<div class="card-body">
				<p class="card-text" style="color: #fff">
					Actualmente la empresa ha sufrido algunos cambios positivos y ha cambiado su nombre a LEGACY 9, la cual gracias a su profesionalismo y experiencia se ha colocado como una de las empresas líderes del sector.
				</p>
			</div>
		</div>
		<div class="card text-center border-light" style="background-color: #061F20">
			<img src="img/tarjeta3.png" class="card-img-top" alt="...">
			<div class="card-body">
				<p class="card-text" style="color: #fff">
					En el mundo actual es necesario llevar a cabo acciones para poder continuar “vigentes” y así poder continuar ofreciendo los mejores servicios a nuestros clientes y de igual manera al precio justo. Actualmente la empresa se dedica a la compra y venta de inmuebles.
				</p>
			</div>
		</div>
	</div>
	<div class="card border-light" style="margin: 20px; background-color: #061F20;">
		<div class="card-body text-center">
			<p class="card-text" style="color: #fff">
				Esta inmobiliaria es orientada a inversores que buscan activos inmobiliarios en rentabilidad, así como a propietarios que precisan asesoramiento en la venta de sus inmuebles. Estamos especializados en locales comerciales y edificios, con o sin inquilinos, en la ciudad de Mérida, Yucatán, México. Ofrecemos una gestión profesional, integral, discreta y eficiente, lo cual nos permite satisfacer las necesidades, tanto de inversores como de propietarios, en breves espacios de tiempo, optimizando el valor del inmueble.
			</p>
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




