<?php

echo '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Busqueda de usuario</title>
</head>
<link href="menu.css" rel="stylesheet" type="text/css">	
<body>
<table width="729" border="0">
  <tr>
    <td width="200" valign="top">&nbsp;</td>
    <td width="482"><div align="center"><img src="header.png" width="318" height="154" /></div></td>
  </tr>
  <tr>
    <td valign="top">
    <div id="menu">
	 <dl>
	  <dt><a href="index.htm" title="Inicio">Home</a></dt>
		  <dt><a href="listaProfile.php" title="Ver lista de inversores">Inversores</a></dt>
		  <dt><a href="frmNuevo.php" title="Agrega un inversor">Nuevo Inversor</a></dt>
		  <dt><a href="usuario_perfil.php" title="Perfil">Perfil de usuario</a></dt>	  
		  <dt><a href="index.htm" title="Aplicación BdT 1.0 beta">Acerca de</a></dt>
	 </dl>
</div></td>
    <td>
    <div id = "prof">';
	
include 'conexion.php';
if($_SESSION[user] == "admin")
{
	if ($conexion) {
		
		$queEmp = "SELECT id,Nombre FROM inversores ORDER BY Nombre ASC";
		$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
		$totEmp = mysql_num_rows($resEmp);
		echo '<table border = "1"> ';
			
			while ($rowEmp = mysql_fetch_assoc($resEmp))
			{
				echo "<tr>";
					echo '<td><a href="frmNuevo.php?id='. $rowEmp["id"] .'">'.$rowEmp["Nombre"] .'</a><br/></td>';
					echo '<td><img src="'. $rowEmp["fotografia"].'" width="190" height="180" /></td>';
				echo "</tr>";
			}
			echo "</table>";
	} else {
	    echo $mensaje;
	}
}
else
	echo "Tu sesión no es de administrador";
echo '</div></td></tr>
	</table></body></html>';

	
?>