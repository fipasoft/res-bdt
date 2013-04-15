<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php 
	
	$conexion = mysql_connect("localhost", "u81329_bdt", "aB1234");
	if(mysql_select_db("u81329_bdt", $conexion))
	{	
		$queEmp = "SELECT Nombre,Domicilio, Colonia, CP, Ciudad, Correo, Telefono, nombreFB, Codigo_bdt, nHoras FROM inversores ORDER BY Nombre ASC";
		$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		echo '<table border = "1"> ';
			echo'<tr>
					<td>Num</td>
					<td>Nombre</td>
					<td>Domicilio</td>
					<td>Colonia</td>
					<td>CP</td>
					<td>Ciudad</td>
					<td>Correo</td>
					<td>Telefono</td>
					<td>FB</td>
					<td>Codigo ingreso</td>
					<td># Horas</td>
				</tr>';
			$i = 1;
			while ($rowEmp = mysql_fetch_assoc($resEmp))
			{
				echo'<tr>
						<td>'. $i . '</td>
						<td>' .$rowEmp["Nombre"] .'</td>
						<td>' .$rowEmp["Domicilio"] .'</td>
						<td>' .$rowEmp["Colonia"] .'</td>
						<td>' .$rowEmp["CP"] .'</td>
						<td>' .$rowEmp["Ciudad"] .'</td>
						<td>' .$rowEmp["Correo"] .'</td>
						<td>' .$rowEmp["Telefono"] .'</td>
						<td>' .$rowEmp["nombreFB"] .'</td>
						<td>' .$rowEmp["Codigo_bdt"] .'</td>
						<td>' .$rowEmp["nHoras"] .'</td>
					</tr>';
					$i++;
			}
			echo "</table>";
	}

?>