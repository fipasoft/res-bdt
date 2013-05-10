<?php 
include 'conexion.php'; 
	echo'<html><title>Busqueda de usuario</title>
	<link href="menu.css" rel="stylesheet" type="text/css">	
	<body>
	<table width="729" border="0">
	  <tr>
		<td width="200" valign="top">&nbsp;</td>
		<td width="482"><div align="center"><img src="header.png" width="318" height="154" /></div></td>
	  </tr>
	  <tr>
		<td valign="top">
		<div id="menu">Editar
		 <dl>
		  <dt><a href="index.htm" title="Inicio">Home</a></dt>
		  <dt><a href="catalogoServ.php" title="Perfil">Catalogo de servicios</a></dt>	
		  <dt><a href="listaProfile.php" title="Ver lista de inversores">Inversores</a></dt>
		  <dt><a href="usuario_perfil.php" title="Perfil">Perfil de usuario</a></dt>	  
		  <dt><a href="index.htm" title="Aplicación BdT 1.0 beta">Acerca de</a></dt>
		 </dl>
	</div></td>';

if ($conexion) {

if($_SESSION[access] == true) 
{		
		echo'<td>
		<div id = "prof">
		<form id="form0" name="form0" method="post" action="buscador.php">
		<span>Buscar palabra: </span> <INPUT TYPE="text" NAME="busqueda" id = "busqueda" >
		<select name="sel">
				<option value="Nombre" >Nombre</option>
				<option value="ServOfrece">Ofrece</option>
			<option value="ServBusca">Busca</option>	
			</select> 
		<input type="submit" name="e" value="Enviar"  />
		<br/>
		</form>';
		
		echo '<table border = "0" width = "850"> ';
		// echo "<tr>";
			// echo "<td><amarillo>Num</amarillo></td>
				  // <td><amarillo>Nombre del inversor</amarillo></td>
			      // <td><amarillo>Servicios que ofrece</amarillo></td>
			      // <td><amarillo>Servicios que busca</amarillo></td>
				  // <td><amarillo>Ciudad - Zona</amarillo></td>";
						
		// echo "</tr>";
			// $queEmp = "SELECT * FROM inversores ORDER BY Ciudad, Colonia ASC";
			// $resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			// $totEmp = mysql_num_rows($resEmp);
			// $i = 1;
			
		echo "<tr><td><amarillo>5 inversores calificados</amarillo></td></tr><tr><td>";
			 // <td><amarillo>5 inversores que tal vez te interesen</amarillo><br/></td>";
			$queEmp = "SELECT distinct inversores.id, inversores.Nombre, pagos.calif, pagos.comentario, pagos.id_pago FROM inversores, pagos WHERE inversores.id = id_receptor ORDER BY pagos.id_pago DESC";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			for($t=0;$t<5;)
			{
				$rowEmp = mysql_fetch_assoc($resEmp);
				if($rowEmp["comentario"] != "")
				{
					echo "* <a href = 'verProfile.php?id=".$rowEmp["id"]."'>". $rowEmp["Nombre"]." </a>le comentaron: ". $rowEmp["comentario"]."<hr align='center' width='85%'>";
					$t++;
				}
			}
		// echo "<br/></td><td>";
			// $queEmp = "SELECT inversores.id, inversores.Nombre, pagos.calif, pagos.comentario FROM inversores, pagos WHERE inversores.id = id_receptor";
			// $resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			// echo "No hay inversores en esta sección <br/><br/><br/><br/>";
			// for($t=0;$t<5;)
			// {
				// $rowEmp = mysql_fetch_assoc($resEmp);
				// if($rowEmp["comentario"] != "")
				// {
					// echo "* <a href = 'verProfile.php?id=".$rowEmp["id"]."'>". $rowEmp["Nombre"]." </a>le comentaron: <p>". $rowEmp["comentario"]."</p><br/>";
					// $t++;
				// }
			// }
		echo "<a href='verComent.php'>Ver todos...</a><br/></td></tr>";
			echo"<table border '1'>";
			if($_GET != NULL)
			{
				if($_GET["orden"] == 1)
					$queEmp = "SELECT * FROM inversores ORDER BY id ASC";
				if($_GET["orden"] == 2)
					$queEmp = "SELECT * FROM inversores ORDER BY Nombre ASC";
				if($_GET["orden"] == 3)
					$queEmp = "SELECT * FROM inversores ORDER BY Ciudad, Colonia ASC";
					
			}
			else
				$queEmp = "SELECT * FROM inversores ORDER BY Nombre ASC";
				
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
			echo "<tr><td align='center'><a href='listaProfile.php?orden=1'>ID</a></td>
				  <td align='center'><a href='listaProfile.php?orden=2'>NOMBRE</a></td>
				  <td align='center'><a href='listaProfile.php?orden=3'>COLONIA </a> </td></tr>";
				  
			while ($rowEmp = mysql_fetch_assoc($resEmp))
			{
				if($rowEmp["activo"] == 1)
				{
					echo "<tr>";
					echo '<td>'.$rowEmp["id"].' <br/></td>';
					echo '<td><a href="verProfile.php?id='. $rowEmp["id"] .'">'.$rowEmp["Nombre"] .'</a><br/></td>';
					//echo '<td><textarea rows="5" cols="30" readonly="readonly">'. $rowEmp["ServOfrece"].'</textarea></td>';
					//echo '<td><textarea rows="5" cols="30" readonly="readonly">'. $rowEmp["ServBusca"].'</textarea></td>';
					echo '<td><textarea rows="5" readonly="readonly">'. $rowEmp["Ciudad"]. ' - Colonia: '. $rowEmp["Colonia"].'</textarea></td>';
					echo "</tr>";	
				}
			}
		$i++;
			
			
			echo "</table></table>";
}
else
	echo "No has iniciado sesión";

} else {
    echo $mensaje;
}

	echo' </div>
	</td>
	  </tr>
	</table>
	</body>
	</html>';
