<?php
	require "../config.php";

    $salida = "";

    $query = "SELECT ID_Usu, Email_Usu, Tipo_Usu, concat(Nom_Usu, ' ', PriApe_Usu, ' ', SegApe_Usu) as Nom_Com FROM usuario";

    if (isset($_POST['consulta'])) {
    	$q = $mysqli->real_escape_string($_POST['consulta']);
    	$query = "SELECT ID_Usu, Email_Usu, Tipo_Usu, concat(Nom_Usu, ' ', PriApe_Usu, ' ', SegApe_Usu) as Nom_Com FROM usuario WHERE ID_Usu LIKE '%$q%' OR Email_Usu LIKE '%$q%' OR Tipo_Usu LIKE '%$q%' OR Nom_Usu LIKE '%$q%' OR PriApe_Usu LIKE '%$q%' OR SegApe_Usu LIKE '%$q%';";
    }

    $resultado = $mysqli->query($query);

    if ($resultado->num_rows>0){
    	$salida.= "<table class='table table-bordered table-striped'>
						<thead>
							<tr>
								<th>#</th>
								<th>Correo</th>
								<th>Tipo de usuario</th>
								<th>Nombre Completo</th>
								<th>Acción</th>
							</tr>
						</thead>
					<tbody>";

    	while ($row = $resultado->fetch_assoc()) {
    		$salida.=	"<tr>
							<td>" . $row['ID_Usu'] . "</td>
							<td>" . $row['Email_Usu'] . "</td>
							<td>" . $row['Tipo_Usu'] . "</td>
							<td>" . $row['Nom_Com'] . "</td>
							<td width=11%>
								<a href='leer_usuarios.php?ID_Usu=". $row['ID_Usu'] ."' title='Ver' data-toggle='tooltip'><i class='fas fa-pager' style='margin-left: 10px; margin-right: 10px'></i></a>
								<a href='cambiar_usuarios.php?ID_Usu=". $row['ID_Usu'] ."' title='Actualizar' data-toggle='tooltip'><i class='fas fa-pencil-alt' style='margin-left: 10px; margin-right: 10px'></i></a>
								<a href='eliminar_usuarios.php?ID_Usu=". $row['ID_Usu'] ."' title='Eliminar' data-toggle='tooltip'><i class='fas fa-trash-alt' style='margin-left: 10px; margin-right: 10px'></i></a>
							</td>
						</tr>";
    	}
    	$salida.="</tbody></table>";
    }else{
    	$salida.="NO HAY DATOS :(";
    }


    echo $salida;

    $mysqli->close();



?>