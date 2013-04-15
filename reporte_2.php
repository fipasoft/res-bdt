<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php 

	$conexion = mysql_connect("localhost", "u81329_bdt", "aB1234");
	if(mysql_select_db("u81329_bdt", $conexion))
	{	
		$queEmp = "SELECT Nombre, ServBusca, ServOfrece FROM inversores ORDER BY Nombre ASC";
		$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		echo '<table border = "1"> ';
			echo'<tr>
					<td>Num</td>
					<td>Nombre</td>
					<td>Busca</td>
					<td>Ofrece</td>
				</tr>';
			$i = 1;
			str_replace("Ã±", "ñ", $rowEmp["ServOfrece"]); 
			str_replace("Ã", "í", $rowEmp["ServOfrece"]); 
			while ($rowEmp = mysql_fetch_assoc($resEmp))
			{
				
				echo'<tr>
						<td>'. $i . '</td>
						<td>' .$rowEmp["Nombre"] .'</td>
						<td>' .$rowEmp["ServBusca"] .'</td>
						<td>' .$rowEmp["ServOfrece"] .'</td>
					</tr>';
					$i++;
			}
			echo "</table>";
	}

?>