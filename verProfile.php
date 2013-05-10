<?php
include 'conexion.php'; 
echo '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Datos del Usuario</title>
</head>
<link href="menu.css" rel="stylesheet" type="text/css">
<body>
<table width="729" border="0">
  <tr>
    <td width="200">&nbsp;</td>
    <td width="482"><div align="center"><img src="header.png" width="318" height="154" /></div></td>
  </tr>
  <tr>
    <td>
    <div id="menu">
	 <dl>
	 <dt><a href="index.htm" title="Inicio">Home</a></dt>
		<dt><a href="catalogoServ.php" title="Perfil">Catalogo de servicios</a></dt>	
		  <dt><a href="listaProfile.php" title="Ver lista de inversores">Inversores</a></dt>
		  <dt><a href="usuario_perfil.php" title="Perfil">Perfil de usuario</a></dt>	
		<dt><a href="calendario.php" title="Perfil">Calendario</a></dt>		
		  <dt><a href="index.htm" title="Aplicación BdT 1.0 beta">Acerca de</a></dt>
	 </dl>
</div></td>
    <td>
<div id = "prof">';	

if($conexion)
{ 
	
	if($_GET != NULL)
	{
		
				$queEmp = "SELECT * FROM inversores WHERE id = '". $_GET["id"]. "'";
				$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
				$rowEmp = mysql_fetch_assoc($resEmp);
				
				echo '<table width = "800"><tr><td><br/><span>Nombre:</span> <nom>'. $rowEmp["Nombre"];
				echo '</nom><span><br/> Correo: '. $rowEmp["Correo"];
				echo '<br/> Teléfono: '. $rowEmp["Telefono"];
				if($rowEmp["nombreFB"]) echo '<br/> Nombre en Facebook: <a href="http://www.facebook.com/search/results.php?q='. $rowEmp["nombreFB"] .'">'.$rowEmp["nombreFB"]. '</a>';
				echo '<br/> Ciudad y colonia: '. $rowEmp["Ciudad"] . ' - '. $rowEmp["Colonia"];
				
				$queEmp = 'SELECT ServOfrece, ServBusca FROM  inversores WHERE inversores.id ="'. $_GET["id"] .'"';
				$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
				
				 // echo '</span><br/> <br/><p> Servicios que ofrece: <br/>';			
				 // echo $rowEmp["ServOfrece"] . "<br/>";									
				 // echo '<br/> <br/> Servicios que demanda: <br/>';
				 // echo $rowEmp["ServBusca"] . "</p><br/>";
				// echo '<br/><br/></td>';
				
				$cadbusca = "SELECT * FROM pagos WHERE id_receptor = '". $rowEmp["id"]."'";
				if($resEmp = mysql_query($cadbusca, $conexion) or die(mysql_error()))
				{
					echo '<td><br/><table border = "1"> ';					  
					while( $rowEmp = mysql_fetch_assoc($resEmp))
					{
						$cadbusca = "SELECT * FROM inversores WHERE id = '". $rowEmp["id_emisor"]."'";
						$resEmp1 = mysql_query($cadbusca, $conexion) or die(mysql_error());
						$rowEmp1 = mysql_fetch_assoc($resEmp1);
						echo "<hr align='center' width='85%'><tr><span>";
						echo '<a href = verProfile.php?id='. $rowEmp1["id"].'>'.$rowEmp1["Nombre"] .' </a> ';
						if($rowEmp["comentario"]) echo 'ha comentado<br/>'.$rowEmp["comentario"] .'</span></br>';
						echo '<amarillo>Te ha calificado con '. $rowEmp["calif"] .'</a></br>';
						echo "</tr>";
						$i++;
					}
					echo "</table></td>";
				}
				
				echo '<tr><td><table border = "1"><tr><td><p>OFRECE</p></td></tr>';
				$queEmp = 'SELECT * FROM serv_usuario WHERE id_usuario ="'. $_GET["id"] .'" AND ofer_dem = 1';
				$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());	
				while($rowEmp = mysql_fetch_assoc($resEmp))
				{
					$queEmp = 'SELECT * FROM tipo_servicio WHERE id ='.$rowEmp["id_tipo_serv"];
					$resEmp1 = mysql_query($queEmp, $conexion) or die(mysql_error());
					$rowEmp1 = mysql_fetch_assoc($resEmp1);
					echo '<tr><td>'.$rowEmp1["tipo_serv"].'</td><td> '.$rowEmp["descrip"].'</td></tr>';
				}	
				echo'<tr><td><p>BUSCA</p><td></tr>';
				$queEmp = 'SELECT * FROM serv_usuario WHERE id_usuario ="'. $_GET["id"] .'" AND ofer_dem = 0';
				$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());	
				while($rowEmp = mysql_fetch_assoc($resEmp))
				{
					$queEmp = 'SELECT * FROM tipo_servicio WHERE id ='.$rowEmp["id_tipo_serv"];
					$resEmp1 = mysql_query($queEmp, $conexion) or die(mysql_error());
					$rowEmp1 = mysql_fetch_assoc($resEmp1);
					echo '<tr><td>'.$rowEmp1["tipo_serv"].'</td><td> '.$rowEmp["descrip"].'</td></tr>';
				}	
				echo'</table></td></tr></table>';
	}
}
else
	echo $mensaje;

echo '</p></div>
	</td></tr>
	</table></body></html>';
?>