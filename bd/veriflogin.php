<?php
session_start();

include 'config.php';

if ($mysqli->connect_error) {
 die("La conexion falló: " . $mysqli->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];
 
$sql = "SELECT ID_Usu, concat(usuario.Nom_Usu, ' ', usuario.PriApe_Usu, ' ', usuario.SegApe_Usu) as Nom_Com, Email_Usu, Pass_Usu, Tipo_Usu FROM usuario WHERE Email_Usu = '$email'";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) { }	
 
  $row = $result->fetch_array(MYSQLI_ASSOC);
if (password_verify($password, $row['Pass_Usu'])){
	
	$_SESSION['loggedin'] = true;
	$_SESSION['username'] = $row['Nom_Com'];
	$_SESSION['idusuario'] = $row['ID_Usu'];
	$_SESSION['tipousuario'] = $row['Tipo_Usu'];
	$_SESSION['start'] = time();
	$_SESSION['expire'] = $_SESSION['start'] + (15 * 60);
	
	echo "Bienvenid@! " . $_SESSION['username'];
	echo "<br><br><a href=../indexpa.php.>Panel de Control</a>"; 
	header('Location:../indexpa.php');
	
}else {
	echo "Username o Password estan incorrectos.";
	echo "<br><a href='../login.php'>Volver a Intentarlo</a>";
}
mysqli_close($mysqli);
?>



