<?php

	$mysqli = new mysqli("localhost","root","Manzana1","bienesraices"); 
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>