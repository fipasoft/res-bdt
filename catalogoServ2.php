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
	<td valign="top">
    <div id="menu">
	 <dl>
	 <dt><a href="index.htm" title="Inicio">Home</a></dt>
		  <dt><a href="listaProfile.php" title="Ver lista de inversores">Inversores</a></dt>
		  <dt><a href="usuario_perfil.php" title="Perfil">Perfil de usuario</a></dt>	  
		  <dt><a href="calendario.php" title="Perfil">Calendario</a></dt>	
		  <dt><a href="index.htm" title="Aplicación BdT 1.0 beta">Acerca de</a></dt>
	 </dl>
</div></td>
    <td>';
	
if ($conexion) 
{		
	
	echo"<div id = 'prof'><table><cab><br>SE BUSCA:</cab>";
	$queEmp1 = "SELECT DISTINCT id_usuario FROM serv_usuario WHERE ofer_dem = '0'";
	$resEmp1 = mysql_query($queEmp1, $conexion) or die(mysql_error());
	while($rowEmp1 = mysql_fetch_assoc($resEmp1))
	{
		$queEmp2 = "SELECT Nombre FROM inversores WHERE id ='".$rowEmp1["id_usuario"]."'";
		$resEmp2 = mysql_query($queEmp2, $conexion) or die(mysql_error());
		$rowEmp2 = mysql_fetch_assoc($resEmp2);
		$nom = substr($rowEmp2['Nombre'],0, strpos($rowEmp2['Nombre']," "));
		echo "<tr><td><span>".$nom." busca: </span>";
		$queEmp3 = "SELECT descrip FROM serv_usuario WHERE ofer_dem = '0' AND id_usuario = '". $rowEmp1["id_usuario"] ."'";
		$resEmp3 = mysql_query($queEmp3, $conexion) or die(mysql_error());
		while($rowEmp3 = mysql_fetch_assoc($resEmp3))
			echo"<br> -> <a href='verProfile.php?id=".$rowEmp1["id_usuario"]."'>".$rowEmp3["descrip"] . "</a>";			
		echo "<hr align='center' width='85%'></td></tr>";
	}	
	echo"</div></td></table>";		

	
	echo"</div></table>";
} else {
    echo $mensaje;
}
?>