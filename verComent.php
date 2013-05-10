<?php
include 'conexion.php'; 
echo'<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="menu.css" rel="stylesheet" type="text/css">
<body><table width="729" border="0">
  <tr>
    <td width="200">&nbsp;</td>
    <td width="482"><div align="center"><img src="header.png" width="318" height="154" /></div></td>
  </tr>
  <tr>
    <td valign="top">
    <div id="menu">
	 <dl>
	  <dt><a href="index.htm" title="Inicio">Home</a></dt>
	  <dt><a href="catalogoServ.php" title="Perfil">Catalogo de servicios</a></dt>	
	  <dt><a href="listaProfile.php" title="Ver lista de inversores">Inversores</a></dt>
	  <dt><a href="usuario_perfil.php" title="Perfil">Perfil de usuario</a></dt>	  
	  <dt><a href="calendario.php" title="Perfil">Calendario</a></dt>	
	 </dl>
</div></td>
    <td>
<table width="729" border="0">
  
  <tr>
   
    <td> <div id = "prof">';
    if ($conexion) {
			$queEmp = "SELECT inversores.id, inversores.Nombre, pagos.calif, pagos.comentario, pagos.id_pago FROM inversores, pagos WHERE inversores.id = id_receptor ORDER BY pagos.id_pago DESC";
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
			while($rowEmp = mysql_fetch_assoc($resEmp))
				if($rowEmp["comentario"] != "")
				{
					echo "* <a href = 'verProfile.php?id=".$rowEmp["id"]."'>". $rowEmp["Nombre"]." </a>le comentaron:<p> ". $rowEmp["comentario"]."</p><hr align='center' width='85%'>";
					$t++;
				}
	} else {
	   echo $mensaje;
	}
	
	echo'</div></td>
  </tr>
</table>
</td>
  </tr>
</table></html>';
?>