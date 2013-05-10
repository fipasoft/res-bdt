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
	
	$queEmp = "SELECT * FROM tipo_servicio";
	$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
	echo '<div id = "prof"><cab>SE OFRECE:</cab><table>';
	
	for($t=0;$t < mysql_num_rows($resEmp); $t++)
	{
		$rowEmp = mysql_fetch_assoc($resEmp);
		echo"<tr><td><br><amarillo>".$rowEmp["tipo_serv"]."</amarillo></td></tr>";
		$queEmp1 = "SELECT descrip, id_usuario, url_foto FROM serv_usuario WHERE id_tipo_serv ='". $rowEmp["id"] ."' AND ofer_dem = '1'";
		$resEmp1 = mysql_query($queEmp1, $conexion) or die(mysql_error());
		
		if(mysql_num_rows($resEmp1) > 0)		
			while($rowEmp1 = mysql_fetch_assoc($resEmp1))
			{
				echo"<tr><td><a href='verProfile.php?id=".$rowEmp1["id_usuario"]."'>".$rowEmp1["descrip"] . "</a>
				<br/><img src='images/_".$rowEmp1["url_foto"]."' height='100' width='130'>
				<hr align='center' width='85%'></td></tr>";
			}
		else
			echo"<tr><td>No hay servicios en esta categoria<td></tr>";
	}
	
	echo"</table>";
} else {
    echo $mensaje;
}
?>