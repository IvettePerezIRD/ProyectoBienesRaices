<?php
					include '../plantilla.php';
					require '../config.php';

					$query = "SELECT inmueble.ID_Inm, inmueble.Catego_Inm, concat('$', inmueble.Precio_Inm) as Precio_Inm, tipo.Nom_Tipo, usuario.Email_Usu, Estatus_Inm FROM inmueble inner join tipo on inmueble.ID_Tipo_Inm = tipo.ID_Tipo inner join usuario on inmueble.ID_Usu_Inm = usuario.ID_Usu";

					$resultado = $mysqli->query($query);

					$pdf = new PDF();
					$pdf->AliasNbPages();
					$pdf->AddPage();

					$pdf->SetFillColor(232,232,232);
					$pdf->SetFont('Arial', 'B', 12);
					$pdf->Cell(10, 6, 'ID', 1, 0, 'C', 1);
					$pdf->Cell(30, 6, 'CATEGORIA', 1, 0, 'C', 1);
					$pdf->Cell(30, 6, 'PRECIO', 1, 0, 'C', 1);
					$pdf->Cell(30, 6, 'TIPO', 1, 0, 'C', 1);
 					$pdf->Cell(60, 6, 'CORREO VENDEDOR', 1, 0, 'C', 1);
 					$pdf->Cell(30, 6, 'ESTATUS', 1, 1, 'C', 1);

					$pdf->SetFont('Arial', '', 10);

					while($row = $resultado->fetch_assoc())
					{
						$pdf->Cell(10, 6, $row['ID_Inm'], 1, 0, 'C');
						$pdf->Cell(30, 6, $row['Catego_Inm'], 1, 0, 'C');
						$pdf->Cell(30, 6, $row['Precio_Inm'], 1, 0, 'C');
						$pdf->Cell(30, 6, $row['Nom_Tipo'], 1, 0, 'C');
						$pdf->Cell(60, 6, $row['Email_Usu'], 1, 0, 'C');
						$pdf->Cell(30, 6, $row['Estatus_Inm'], 1, 1, 'C');

					}

					$pdf->Output();

					?>