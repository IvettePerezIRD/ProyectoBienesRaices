<?php
	require ('../config.php');
	
	$ID_Est = $_POST['ID_Est'];
	
	$queryM = "SELECT ID_Ciu, Nom_Ciu FROM ciudad WHERE ID_Est_Ciu = '$ID_Est' ORDER BY Nom_Ciu";
	$resultadoM = $mysqli->query($queryM);
	
	$html= "<option value='0'>Elegir</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['ID_Ciu']."'>".$rowM['Nom_Ciu']."</option>";
	}
	
	echo $html;
?>		