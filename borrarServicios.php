<?php
session_start(); 
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
		 
	 </dl>
</div></td>
    <td>
<div id = "prof">';	
if($_POST == NULL)
{
	$conexion = mysql_connect("localhost", "u81329_bdt", "aB1234");
			if ($conexion)
			{		
				if(!mysql_select_db("u81329_bdt", $conexion))
					die(mysql_error());
			}
	$cadbusca="SELECT * FROM inversores WHERE Codigo_bdt = '". $_SESSION[user] ."'";
	$resEmp = mysql_query($cadbusca, $conexion) or die(mysql_error());
	$rowEmp = mysql_fetch_assoc($resEmp);
			
	$id = $rowEmp["id"];
	echo'<form method="post" action="borrarServicios.php">';
	echo 'Selecciona los servicios que desea borrar: <br/><br/><table border = "1"><tr><td><p>OFRECES</p></td></tr>';
	$queEmp = 'SELECT * FROM serv_usuario WHERE id_usuario ="'. $id .'" AND ofer_dem = 1';
	$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());	
	while($rowEmp = mysql_fetch_assoc($resEmp))
	{
		$queEmp = 'SELECT * FROM tipo_servicio WHERE id ='.$rowEmp["id_tipo_serv"];
		$resEmp1 = mysql_query($queEmp, $conexion) or die(mysql_error());
		$rowEmp1 = mysql_fetch_assoc($resEmp1);
		echo '<tr><td><input type="checkbox" name="a'.$rowEmp["id"].'" value="'.$rowEmp["id"].'"> '.$rowEmp1["tipo_serv"].'</td><td> '.$rowEmp["descrip"].'</td></tr>';
	}	
	echo'<tr><td><p>BUSCAS</p><td></tr>';
	$queEmp = 'SELECT * FROM serv_usuario WHERE id_usuario ="'. $id .'" AND ofer_dem = 0';
	$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());	
	while($rowEmp = mysql_fetch_assoc($resEmp))
	{
		$queEmp = 'SELECT * FROM tipo_servicio WHERE id ='.$rowEmp["id_tipo_serv"];
		$resEmp1 = mysql_query($queEmp, $conexion) or die(mysql_error());
		$rowEmp1 = mysql_fetch_assoc($resEmp1);
		echo '<tr><td><input type="checkbox" name="b'.$rowEmp["id"].'" value="'.$rowEmp["id"].'"> '.$rowEmp1["tipo_serv"].'</td><td> '.$rowEmp["descrip"].'</td></tr>';
	}	
	echo'</table><br/><br/><input type="submit" /></form>';
}
else
{
	$conexion = mysql_connect("localhost", "u81329_bdt", "aB1234");
			if ($conexion)
			{		
				if(!mysql_select_db("u81329_bdt", $conexion))
					die(mysql_error());
			}
	
	foreach($_POST as $iter)
	{
		$cadbusca="DELETE FROM serv_usuario WHERE id = '". $iter ."'";
		mysql_query($cadbusca, $conexion) or die(mysql_error());
		echo "Servicio borrado con éxito <br/> <br/> <a href='borrarServicios.php'>Volver</a>";
	}
}
echo"</html>";
?>	