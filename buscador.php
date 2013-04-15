<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
	  <dt><a href="frmNuevo.htm" title="Agrega un inversor">Nuevo Inversor</a></dt>
	  <dt><a href="index.htm" title="Aplicación BdT 1.0 beta">Acerca de</a></dt>
	 </dl>
</div></td>
<td>
    <div id = "prof">
	<form id="form0" name="form0" method="post" action="buscador.php">
	Buscar palabra: <INPUT TYPE="text" NAME="busqueda" id = "busqueda" >
	<select name="sel">
            <option value="Nombre" >Nombre</option>
            <option value="ServOfrece">Ofrece</option>
	    <option value="ServBusca">Busca</option>	
        </select> 
	<input type="submit" name="e" value="Enviar"  />
	<br/><br/>
</form>
<?php 

 if ($_POST["busqueda"] != '')
{ 
	
	$cadbusca="SELECT id, Nombre, ServOfrece, ServBusca FROM inversores WHERE ". $_POST["sel"] ." LIKE '%".$_POST["busqueda"]."%' LIMIT 50";  	
	$conexion = mysql_connect("localhost", "u81329_bdt", "aB1234");
	if ($conexion)
	{		
		if(mysql_select_db("u81329_bdt", $conexion))
		{
			$resEmp = mysql_query($cadbusca, $conexion) or die(mysql_error());
			$totEmp = mysql_num_rows($resEmp);
			echo "Campos encontrados:".$totEmp."<br>";

			if ($totEmp> 0)
			{
				echo '<table border = "1"> ';
				echo "<tr>";
				echo "<td>Nombre del inversor</td>
			      <td>Servicios que ofrece</td>
			      <td>Servicios que busca</td>";		
				echo "</tr>";
				
				while( $rowEmp = mysql_fetch_assoc($resEmp) )
				{
					echo "<tr>";
				echo "</tr>";
				echo "<tr>";
					echo '<td><a href="verProfile.php?id='. $rowEmp["id"] .'">'.$rowEmp["Nombre"] .'</a><br/></td>';
					echo '<td><textarea rows="4" readonly="readonly">'. $rowEmp["ServOfrece"].'</textarea></td>';
					echo '<td><textarea rows="4" readonly="readonly">'. $rowEmp["ServBusca"].'</textarea></td>';
				echo "</tr>";
				}
				echo "</table>";
			}
			else
				echo "No hay palabras coincidentes";
					
		}
	}
}
else
	echo "No hay palabra para buscar";

?>
</body>
</html> 