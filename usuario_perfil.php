<?php
session_start();
echo'<html>

	<head><title>Perfil del Usuario</title></head>
	<link href="menu.css" rel="stylesheet" type="text/css">
	
	<body><table width="729" border="0">
  <tr>
    <td width="200" valign="top">&nbsp;</td>
    <td width="482"><div align="center"><img src="header.png" width="318" height="154" /></div></td>
  </tr>
  <tr>
    <td valign="top">
    <div id="menu">
	 <dl>
	  <dt><a href="index.htm" title="Inicio">Home</a></dt>';
	  if($_SESSION[access] == false) echo '<dt><a href="session.php" title="sesion">Inicia sesión</a></dt>';
	  echo'<dt><a href="catalogoServ.php" title="Perfil">Catalogo de servicios</a></dt>	
	  <dt><a href="listaProfile.php" title="Ver lista de inversores">Inversores</a></dt>
	  <dt><a href="usuario_perfil.php" title="Perfil">Perfil de usuario</a></dt> 
<dt><a href="calendario.php" title="Perfil">Calendario</a></dt>		  
      <dt><a href="index.htm" title="Aplicación BdT 1.0 beta">Acerca de</a></dt>
	 </dl>
 
</div></td><br/><td>';
	if($_SESSION[access] == true) 
	{
		echo "<div id= 'prof'> <p> Bienvenido ".$_SESSION[user].
			'<br/><a href = "cerrarSession.php">Cerrar sesión</a></p>';		
	
		$cadbusca="SELECT * FROM inversores WHERE Codigo_bdt = '". $_SESSION[user] ."'";
		$conexion = mysql_connect("localhost", "u81329_bdt", "aB1234");
		if ($conexion)
		{		
			if(mysql_select_db("u81329_bdt", $conexion))
			{
				$resEmp = mysql_query($cadbusca, $conexion) or die(mysql_error());
				$rowEmp = mysql_fetch_assoc($resEmp);
				echo '<br/><br/><span>Nombre:</span> <nom>'. $rowEmp["Nombre"];
				echo '</nom><span><br/> Correo: '. $rowEmp["Correo"];
				echo '<br/> Teléfono: '. $rowEmp["Telefono"];
				if($rowEmp["nombreFB"]) echo '<br/> Nombre en Facebook: <a href="http://www.facebook.com/search/results.php?q='. $rowEmp["nombreFB"] .'">'.$rowEmp["nombreFB"]. '</a>';
				echo '<br/> Ciudad y colonia: '. $rowEmp["Ciudad"] . ' - '. $rowEmp["Colonia"];
				echo '<br/><br/><span>Horas disponibles:</span> <nom>'. $rowEmp["nHoras"];
				
				$queEmp = 'SELECT id, Nombre FROM inversores WHERE id ="'. $rowEmp["asesor"] .'"';
				$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());	
				$rowEmp = mysql_fetch_assoc($resEmp);
				echo '</nom><br/><br/>Su asesor de la RES: <a href= "verProfile.php?id='.$rowEmp["id"].'">'.$rowEmp["Nombre"].'</a></br>';	
				// echo 'su asesor es: '. $rowEmp["asesor"];

				// $cadbusca="SELECT id, Nombre, Codigo_bdt FROM inversores WHERE Colonia = '". $rowEmp["Colonia"] ."'";
					// $resEmp = mysql_query($cadbusca, $conexion) or die(mysql_error());
					// if($resEmp)
					// {
						// echo "</td><td><span>Personas que viven en su colonia: <br/></span>";
						// while($rowEmp = mysql_fetch_assoc($resEmp))
							// if( $_SESSION[user] != $rowEmp["Codigo_bdt"])
								// echo '- <a href= verProfile.php?id='. $rowEmp["id"].'>'.$rowEmp["Nombre"]. "</a><br/><br/>";
					// }
				$queEmp = "SELECT * FROM inversores WHERE Codigo_bdt = '". $_SESSION[user] ."'";
				$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());	
				$rowEmp = mysql_fetch_assoc($resEmp);
				$id = $rowEmp["id"];
				echo '<br/><table border = "1"><tr><td><p>OFRECES</p></td></tr>';
				$queEmp = 'SELECT * FROM serv_usuario WHERE id_usuario ="'. $id .'" AND ofer_dem = 1';
				$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());	
				while($rowEmp = mysql_fetch_assoc($resEmp))
				{
					$queEmp = 'SELECT * FROM tipo_servicio WHERE id ='.$rowEmp["id_tipo_serv"];
					$resEmp1 = mysql_query($queEmp, $conexion) or die(mysql_error());
					$rowEmp1 = mysql_fetch_assoc($resEmp1);
					echo '<tr><td>'.$rowEmp1["tipo_serv"].'</td><td> '.$rowEmp["descrip"].'</td>';
					echo "<td><img src='images/_".$rowEmp['url_foto']."' height='100' width='130'></td></tr>";
				}	
				echo'<tr><td><p>BUSCAS</p><td></tr>';
				$queEmp = 'SELECT * FROM serv_usuario WHERE id_usuario ="'. $id .'" AND ofer_dem = 0';
				$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());	
				while($rowEmp = mysql_fetch_assoc($resEmp))
				{
					$queEmp = 'SELECT * FROM tipo_servicio WHERE id ='.$rowEmp["id_tipo_serv"];
					$resEmp1 = mysql_query($queEmp, $conexion) or die(mysql_error());
					$rowEmp1 = mysql_fetch_assoc($resEmp1);
					echo '<tr><td>'.$rowEmp1["tipo_serv"].'</td><td> '.$rowEmp["descrip"].' </td>
					      <td><img src="images/_'.$rowEmp["url_foto"].'" height="100" width="130"></td></tr>';
				}	
				echo'</table>';
				
				$cadbusca="SELECT * FROM inversores WHERE Codigo_bdt = '". $_SESSION[user] ."'";
				$resEmp = mysql_query($cadbusca, $conexion) or die(mysql_error());
				$rowEmp = mysql_fetch_assoc($resEmp);
				
				echo "</td><td>MENÚ <br/><br/><a href= 'guardarServicios.php'>Agregar servicios</a><br/><br/>
						<a href= 'borrarServicios.php'>Borrar servicios</a><br/><br/>
						<a href= 'frmEditar.php?id=".$rowEmp["id"]."'>Editar mis datos</a>";	
				
				echo '</div></td><tr><form id="form1" name="form1" method="post" action="guardar_pago.php">';
				echo '<td><br/><br/><p>Realizar pago de horas a: </td>';
				$cadbusca="SELECT Nombre FROM inversores ORDER BY Nombre ASC";
				$resEmp = mysql_query($cadbusca, $conexion) or die(mysql_error());
				
				echo '<td><hr align="center" width="85%"><p>FORMULARIO PARA REALIZAR PAGO DE HORA <br/><br/><select name="recibe">';
				while($rowEmp = mysql_fetch_assoc($resEmp))
					echo'<option>'. $rowEmp["Nombre"]. '</option>';
				echo'</select><br/></td></tr>';
				echo'<tr><td>Número de horas:</td><td> <select name="horas">';
				for($i=1;$i<11;$i++)
					echo'<option>'. $i. '</option>';
				echo'</select><br/></td><tr><td>Concepto: </td><td><textarea rows="5" cols="30" name = "concepto"></textarea></td></tr>';
				echo'<tr><td>Calificación del servicio: </td> <td><select name="cal"> ';
				for($i=1;$i<=5;$i++)
					echo'<option>'. $i. '</option>';
				echo'</select></td><td> 1 = No cumplió con el servicio - 5 = Excelente servicio</td></tr>';
				echo'<tr><td>Comentario del servicio: </td> <td><textarea rows="5" cols="30" name = "comentario"></textarea></td></tr> ';
				echo '<tr><td><input type="submit" name="cmdEnviar" id="cmdEnviar" value="Realizar pago" />  </p> </form></td></tr></table>';
				
				$cadbusca="SELECT id FROM inversores WHERE Codigo_bdt = '". $_SESSION[user] ."'";
				$resEmp = mysql_query($cadbusca, $conexion) or die(mysql_error());
				$rowEmp = mysql_fetch_assoc($resEmp);

				$cadbusca = "SELECT * FROM pagos WHERE id_emisor = '". $rowEmp["id"]."'";	
				echo '<div = "prof"><hr align="center" width="85%"><nom>Historial de pagos </nom><br/>';				
				if($resEmp = mysql_query($cadbusca, $conexion) or die(mysql_error()))
				{
					echo '<br/>Usted ha pagado: <br/><table border = "1"> ';
					echo "<tr>";
					echo "<td><amarillo>Num</amarillo></td>
					  <td><amarillo>Nombre del receptor</amarillo></td>
					  <td><amarillo>Concepto</amarillo></td>
					  <td><amarillo>Horas pagadas</amarillo></td>
					  <td><amarillo>Fecha</amarillo></td>";		
					echo "</tr>";
					$i=1;
					
					while( $rowEmp = mysql_fetch_assoc($resEmp) )
					{
						$cadbusca = "SELECT * FROM inversores WHERE id = '". $rowEmp["id_receptor"]."'";
						$resEmp1 = mysql_query($cadbusca, $conexion) or die(mysql_error());
						$rowEmp1 = mysql_fetch_assoc($resEmp1);
						echo "<tr>";
						echo "</tr>";
						echo "<tr>";
						echo '<td>'.$i.'<br/></td>';
						echo '<td>'. $rowEmp1["Nombre"] .'<br/></td>';
						echo '<td>'. $rowEmp["concepto"].'</td>';
						echo '<td>'. $rowEmp["num_horas"].'</td>';
						echo '<td>'. $rowEmp["fecha_pago"] .'</td>';
						echo "</tr>";
						$i++;
					}
					echo "</table>";

				}
				else
					echo "Usted no tiene historial de pagos de tiempo.";
				echo '</div>';
				$cadbusca="SELECT id FROM inversores WHERE Codigo_bdt = '". $_SESSION[user] ."'";
				$resEmp = mysql_query($cadbusca, $conexion) or die(mysql_error());
				$rowEmp = mysql_fetch_assoc($resEmp);
			
				$cadbusca = "SELECT * FROM pagos WHERE id_receptor = '". $rowEmp["id"]."'";
				if($resEmp = mysql_query($cadbusca, $conexion) or die(mysql_error()))
				{
					echo '<br/>Usted ha recibido pagos de: <br/><table border = "1"> ';
					echo "<tr>";
					echo "<td><amarillo>Num</amarillo></td>
					  <td><amarillo>Nombre</amarillo></td>
					  <td><amarillo>Concepto</amarillo></td>
					  <td><amarillo>Horas pagadas</amarillo></td>
					  <td><amarillo>Fecha</amarillo></td>
					  <td><amarillo>Calificacion</amarillo></td>
					  <td><amarillo>Comentario</amarillo></td>";		
					echo "</tr>";
					$i=1;
					while( $rowEmp = mysql_fetch_assoc($resEmp))
					{
						$cadbusca = "SELECT * FROM inversores WHERE id = '". $rowEmp["id_emisor"]."'";
						$resEmp1 = mysql_query($cadbusca, $conexion) or die(mysql_error());
						$rowEmp1 = mysql_fetch_assoc($resEmp1);
						echo "<tr>";
						echo '<td>'.$i.'<br/></td>';
						echo '<td>'. $rowEmp1["Nombre"] .'<br/></td>';
						echo '<td>'. $rowEmp["concepto"].'</td>';
						echo '<td>'. $rowEmp["num_horas"].'</td>';
						echo '<td>'. $rowEmp["fecha_pago"] .'</td>';
						echo '<td>'. $rowEmp["calif"] .'</td>';
						echo '<td>'. $rowEmp["comentario"] .'</td>';
						echo "</tr>";
						$i++;
					}
					echo "</table>";

				}				
				echo'</td></tr></table></p></body></html>';
					
			}
		}
	}
	else
		echo "No has iniciado sesion";

?>