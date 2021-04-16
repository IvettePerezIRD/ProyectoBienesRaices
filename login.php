<!DOCTYPE html>
<html class='no-js' lang='en'>
 <head>
    <meta charset='utf-8'>
    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>
    <title>LEGACY 9 | LOGIN</title>
    <link href="css/application-a07755f5.css" rel="stylesheet" type="text/css" />
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="img/Casita.png" rel="icon" type="image/ico" />
 </head>
 <body class='login' style="background-color:#869ea3;" class="color-block mb-3 mx-auto rounded-circle z-depth-1">
	 <div class='wrapper'>
		 <div class='row'>
			 <div class='col-lg-12'>
				 <center><img src="img/Logo Legacy.png" width="60%"></center>
				 <form action="bd/veriflogin.php" method="post">
					 <fieldset class='text-center'>
						 <legend>Inicio de sesión</legend>
						 <div class='form-group'>
							 <input class='form-control' placeholder='Correo' type='email' name="email" required>
						 </div>
						 <div class='form-group'>
							 <input class='form-control' placeholder='Contraseña' type='password' name="password" required>
							 <!--<a href="#">Recuperar contraseña</a>-->
						 </div>
						 <div class='text-center'>
							 <button class="btn btn-success" type="submit">Entrar</button>
							 <a class="btn btn-default" href="index.php">Regresar</a>
							 <br>
							 <br>
							 <a href="registro.php">¿Aun no tienes una cuenta? Da clic aquí</a>
						 </div>
					 </fieldset>
				 </form>
			 </div>
		 </div>
	 </div>
	 <!-- Javascripts -->
	 <script src="js/jquery.min.js" type="text/javascript"></script>
	 <script src="js/jquery-ui.min.js" type="text/javascript"></script>
	 <script src="js/modernizr.min.js" type="text/javascript"></script>
	 <script src="js/application-985b892b.js" type="text/javascript"></script>
	 <!-- Google Analytics -->
	 <script>
		 var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
		 (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
						g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
						s.parentNode.insertBefore(g,s)}(document,'script'));
	 </script>
</body>
	
</html>
