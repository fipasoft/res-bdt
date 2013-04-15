<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php  
	echo '<input name="idOculto" id = "idOculto" type="hidden" value="'.$_POST["idOculto"].'" />';
	$conexion = mysql_connect("localhost", "u81329_bdt", "aB1234");
	if ($conexion)
	{		
		mysql_select_db("u81329_bdt", $conexion);
		$queEmp = "SELECT * FROM servicios";
	}
	else
			die(mysql_error());

  echo '<table width="374" height="86" >
    <tr>
      <td height="30">Servicios que ofrece</td>
      <td>Servicios que busca</td>
    </tr>
    <tr>
      <td>
        Servicio 1:';
		
        echo '<select name="txtServ1" id="txtServ1">';
		$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
        	while ($rowEmp = mysql_fetch_assoc($resEmp))
				echo '<option value= "'. $rowEmp["id"].'">'. $rowEmp["ofrece"].'</option>';
		echo '</select>';	
		?>	
		<br />
        <br />
        
		Servicio 2:
        <?
			echo '<select name="txtServ2" id="txtServ2">';
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
        	while ($rowEmp = mysql_fetch_assoc($resEmp))
				echo '<option value= "'. $rowEmp["id"].'">'. $rowEmp["ofrece"].'</option>';
		echo '</select>';	
		?>
        <br />
        <br />
        Servicio 3: 
        <?
			echo '<select name="txtServ3" id="txtServ3">';
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
        	while ($rowEmp = mysql_fetch_assoc($resEmp))
				echo '<option value= "'. $rowEmp["id"].'">'. $rowEmp["ofrece"].'</option>';
			echo '</select>';	
		?>
        <br />
        <br />
      Otro Servicio: 
      <input type="text" name="txtOServicio" id="txtOServicio" />
      </td>
  <td>Servicio 1:
        <?
			echo '<select name="txtServ4" id="txtServ4">';
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
        	while ($rowEmp = mysql_fetch_assoc($resEmp))
				echo '<option value= "'. $rowEmp["id"].'">'. $rowEmp["ofrece"].'</option>';
		echo '</select>';	
		?>
        <br />
        <br />
		Servicio 2:
		<?
			echo '<select name="txtServ5" id="txtServ5">';
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
        	while ($rowEmp = mysql_fetch_assoc($resEmp))
				echo '<option value= "'. $rowEmp["id"].'">'. $rowEmp["ofrece"].'</option>';
		echo '</select>';	
		?>
        <br />
        <br />
        Servicio 3:
        <?
			echo '<select name="txtServ6" id="txtServ6">';
			$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
        	while ($rowEmp = mysql_fetch_assoc($resEmp))
				echo '<option value= "'. $rowEmp["id"].'">'. $rowEmp["ofrece"].'</option>';
		echo '</select>';	
		?>
        <br />
        <br />
        Otro Servicio:
  <input type="text" name="txtOServicio2" id="txtOServicio2" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="cmdEnviar" id="cmdEnviar" value="Guardar Servicios" /></td>
  </tr>
  </table>
</form>

</body>
</html>
