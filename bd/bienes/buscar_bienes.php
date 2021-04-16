<?php
	session_start();

	require "../config.php";

    $salida = "";
	$idus = $_SESSION['idusuario'];

	if ($_SESSION['tipousuario'] == "Administrador"){
		$query = "SELECT inmueble.ID_Inm, inmueble.Nom_Inm, inmueble.Precio_Inm, tipo.Nom_Tipo, inmueble.Galeria_Inm, inmueble.Descripcion_Inm, concat(inmueble.Direccion_Inm, '. ', localidad.Nom_Loc, ', ', ciudad.Nom_Ciu, ', ', estado.Nom_Est) as 'Ubicacion_Inm', inmueble.Catego_Inm, inmueble.Estatus_Inm FROM inmueble inner join tipo on inmueble.ID_Tipo_Inm = tipo.ID_Tipo inner join localidad on inmueble.ID_Loc_Inm = localidad.ID_Loc inner join ciudad on localidad.ID_Ciu_Loc = ciudad.ID_Ciu inner join estado on ciudad.ID_Est_Ciu = estado.ID_Est group by (ID_Inm);";
	}elseif($_SESSION['tipousuario'] == "Vendedor"){
		$query = "SELECT inmueble.ID_Inm, inmueble.Nom_Inm, inmueble.Precio_Inm, tipo.Nom_Tipo, inmueble.Galeria_Inm, inmueble.Descripcion_Inm, concat(inmueble.Direccion_Inm, '. ', localidad.Nom_Loc, ', ', ciudad.Nom_Ciu, ', ', estado.Nom_Est) as 'Ubicacion_Inm', inmueble.Catego_Inm, inmueble.Estatus_Inm FROM inmueble inner join tipo on inmueble.ID_Tipo_Inm = tipo.ID_Tipo inner join localidad on inmueble.ID_Loc_Inm = localidad.ID_Loc inner join ciudad on localidad.ID_Ciu_Loc = ciudad.ID_Ciu inner join estado on ciudad.ID_Est_Ciu = estado.ID_Est WHERE ID_Usu_Inm = $idus group by (ID_Inm);";
	}

    if (isset($_POST['consulta'])) {
    	$q = $mysqli->real_escape_string($_POST['consulta']);
		if ($_SESSION['tipousuario'] == "Administrador"){
		
			$query = "SELECT inmueble.ID_Inm, inmueble.Nom_Inm, inmueble.Precio_Inm, tipo.Nom_Tipo, inmueble.Galeria_Inm, inmueble.Descripcion_Inm, concat(inmueble.Direccion_Inm, '. ', localidad.Nom_Loc, ', ', ciudad.Nom_Ciu, ', ', estado.Nom_Est) as 'Ubicacion_Inm', inmueble.Catego_Inm, inmueble.Estatus_Inm FROM inmueble inner join tipo on inmueble.ID_Tipo_Inm = tipo.ID_Tipo inner join localidad on inmueble.ID_Loc_Inm = localidad.ID_Loc inner join ciudad on localidad.ID_Ciu_Loc = ciudad.ID_Ciu inner join estado on ciudad.ID_Est_Ciu = estado.ID_Est WHERE ID_Inm LIKE '%$q%' OR Nom_Inm LIKE '%$q%' OR Nom_Tipo LIKE '%$q%' OR Catego_Inm LIKE '%$q%' OR Estatus_Inm LIKE '%$q%' group by (ID_Inm);";
			
		}elseif($_SESSION['tipousuario'] == "Vendedor"){
			$query = "SELECT inmueble.ID_Inm, inmueble.Nom_Inm, inmueble.Precio_Inm, tipo.Nom_Tipo, inmueble.Galeria_Inm, inmueble.Descripcion_Inm, concat(inmueble.Direccion_Inm, '. ', localidad.Nom_Loc, ', ', ciudad.Nom_Ciu, ', ', estado.Nom_Est) as 'Ubicacion_Inm', inmueble.Catego_Inm, inmueble.Estatus_Inm FROM inmueble inner join tipo on inmueble.ID_Tipo_Inm = tipo.ID_Tipo inner join localidad on inmueble.ID_Loc_Inm = localidad.ID_Loc inner join ciudad on localidad.ID_Ciu_Loc = ciudad.ID_Ciu inner join estado on ciudad.ID_Est_Ciu = estado.ID_Est WHERE Nom_Inm LIKE '%$q%' OR Nom_Tipo LIKE '%$q%' OR Catego_Inm LIKE '%$q%' OR Estatus_Inm LIKE '%$q%' AND ID_Usu_Inm = $idus group by (ID_Inm);";
		}
    }

    $resultado = $mysqli->query($query);
    if ($resultado->num_rows>0){
		if ($_SESSION['tipousuario'] == "Administrador"){
			$salida.= "<table class='table table-bordered table-striped'>
						<thead>
							<tr>
								<th>#</th>
								<th>Imagen</th>
								<th>Datos</th>
								<th>Categoria</th>
								<th>Estatus</th>
								<th>Acción</th>
							</tr>
						</thead>
					<tbody>";
			while ($row = $resultado->fetch_assoc()){
				$salida.="<tr>
							<td>" . $row['ID_Inm'] . "</td>
							<td width='40%'><center><img width='70%' src='". $row['Galeria_Inm'] ."'></center></td>
							<td width='40%'><b>Precio: </b>$". $row['Precio_Inm'] ."<br><b>Descripción: </b>". $row['Descripcion_Inm'] ."<br><b>Tipo: </b>". $row['Nom_Tipo'] ."<br><b>Ubicación: </b>". $row['Ubicacion_Inm'] ."</td>
							<td>" . $row['Catego_Inm'] . "</td>
							<td>" . $row['Estatus_Inm'] . "</td>
							<td width='5%'>
								<a href='leer_bienes.php?ID_Inm=". $row['ID_Inm'] ."' title='Ver' data-toggle='tooltip'><i class='fas fa-pager' style='margin-left: 10px; margin-right: 10px'></i></a>
								<br><br><a href='cambiar_bienes.php?ID_Inm=". $row['ID_Inm'] ."' title='Actualizar' data-toggle='tooltip'><i class='fas fa-pencil-alt' style='margin-left: 10px; margin-right: 10px'></i></a>
								<br><br><a href='eliminar_bienes.php?ID_Inm=". $row['ID_Inm'] ."' title='Eliminar' data-toggle='tooltip'><i class='fas fa-trash-alt' style='margin-left: 10px; margin-right: 10px'></i></a>
								<br><br><a href='insertar_amenidades.php?ID_Inm=". $row['ID_Inm'] ."' title='Amenidad' data-toggle='tooltip'><i class='fas fa-toilet' style='margin-left: 10px; margin-right: 10px'></i></a>
								<br><br><a href='aceptar.php?ID_Inm=". $row['ID_Inm'] ."' title='Aceptar' data-toggle='tooltip'><i class='fas fa-check' style='margin-left: 10px; margin-right: 10px'></i></a>
								<br><br><a href='rechazar.php?ID_Inm=". $row['ID_Inm'] ."' title='Rechazar' data-toggle='tooltip'><i class='fas fa-times' style='margin-left: 10px; margin-right: 10px'></i></a>
							</td>
						</tr>";
			}
			$salida.="</tbody></table>";
		}elseif($_SESSION['tipousuario'] == "Vendedor"){
			$salida.= "<table class='table table-bordered table-striped'>
						<thead>
							<tr>
								<th>Imagen</th>
								<th>Datos</th>
								<th>Categoria</th>
								<th>Estatus</th>
								<th>Acción</th>
							</tr>
						</thead>
					<tbody>";
			while ($row = $resultado->fetch_assoc()){
				$salida.="<tr>
							<td width='40%'><center><img width='70%' src='". $row['Galeria_Inm'] ."'></center></td>
							<td width='40%'><b>Precio: </b>$". $row['Precio_Inm'] ."<br><b>Descripción: </b>". $row['Descripcion_Inm'] ."<br><b>Tipo: </b>". $row['Nom_Tipo'] ."<br><b>Ubicación: </b>". $row['Ubicacion_Inm'] ."</td>
							<td>" . $row['Catego_Inm'] . "</td>
							<td>" . $row['Estatus_Inm'] . "</td>
							<td width='5%'>
								<a href='leer_bienes.php?ID_Inm=". $row['ID_Inm'] ."' title='Ver' data-toggle='tooltip'><i class='fas fa-pager' style='margin-left: 10px; margin-right: 10px'></i></a>
								<br><br><a href='cambiar_bienes.php?ID_Inm=". $row['ID_Inm'] ."' title='Actualizar' data-toggle='tooltip'><i class='fas fa-pencil-alt' style='margin-left: 10px; margin-right: 10px'></i></a>
								<br><br><a href='eliminar_bienes.php?ID_Inm=". $row['ID_Inm'] ."' title='Eliminar' data-toggle='tooltip'><i class='fas fa-trash-alt' style='margin-left: 10px; margin-right: 10px'></i></a>
								<br><br><a href='insertar_amenidades.php?ID_Inm=". $row['ID_Inm'] ."' title='Amenidad' data-toggle='tooltip'><i class='fas fa-toilet' style='margin-left: 10px; margin-right: 10px'></i></a>
							</td>
						</tr>";
			}
			$salida.="</tbody></table>";
		}
    }else{
    	$salida.="NO HAY DATOS :(";
    }

    echo $salida;

    $mysqli->close();

?>