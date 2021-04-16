<?php
	require ('../config.php');
	
	$ID_Ciu = $_POST['ID_Ciu'];
	
	$query = "SELECT ID_Loc, Nom_Loc FROM localidad WHERE ID_Ciu_Loc = '$ID_Ciu' ORDER BY Nom_Loc";
	$resultado=$mysqli->query($query);

	$html= "<option value='0'>Elegir</option>";
	
	while($row = $resultado->fetch_assoc())
	{
		$html.= "<option value='".$row['ID_Loc']."'>".$row['Nom_Loc']."</option>";
	}

	echo $html;
?>