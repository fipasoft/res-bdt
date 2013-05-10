<?php
include 'conexion.php';
echo '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Respuesta sistema</title>
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
	  <dt><a href="usuario_perfil.php" title="Aplicación BdT 1.0 beta">Perfil de Usuario</a></dt>
	 </dl>
</div></td>
    <td>';
if ($conexion) {
	if($_POST)
	{
		$cadbusca="SELECT * FROM inversores WHERE Codigo_bdt = '". $_SESSION[user] ."'";
		$resEmp = mysql_query($cadbusca, $conexion) or die(mysql_error());
		$rowEmp = mysql_fetch_assoc($resEmp);
  		$query = "INSERT INTO serv_usuario(id_tipo_serv, descrip, id_usuario, ofer_dem, etiqueta, url_foto) 
				VALUES ('".($_POST["tipoServ"]+1)."','".$_POST["txtBusca"]."','".$rowEmp["id"]."','".$_POST["cmbOD"]."','".$_POST["txtFB"]."','".$_FILES["archivo"]['name']."')";
		if(!mysql_query($query,$conexion)) 
			die(mysql_error());
		if ($_POST["action"] == "upload") 
		{
			// obtenemos los datos del archivo
			$tamano = $_FILES["archivo"]['size'];
			$tipo = $_FILES["archivo"]['type'];
			$archivo = $_FILES["archivo"]['name'];
			if ($archivo != "") {
			// guardamos el archivo a la carpeta files
			$destino =  "images/".$prefijo."_".$archivo;
			if (copy($_FILES['archivo']['tmp_name'],$destino)) {
				$status = "Archivo subido: <b>".$archivo."</b>";
			} else {
				$status = "Error al subir el archivo";
			}
			} else {
				$status = "Error al subir archivo";
			}
			echo $status;
		}
		echo "Servicio agregado exitosamente<br/><br/>";
	}
	
		echo'<form action="guardarServicios.php" method="post" enctype="multipart/form-data"><br/><br/>';
			echo $_SESSION[user]. " favor de guardar los servicios que: ";
			echo'<select name="cmbOD">
				<option value="0" >Demandas</option>
				<option value="1">Ofreces</option>
			</select><BR/>';
			$i = 0;
			echo'<br/>Agrega una categoría:<br/><select name = "tipoServ">';
				$query = "SELECT tipo_serv FROM tipo_servicio";
				$resEmp = mysql_query($query,$conexion) or die(mysql_error());
				while($rowEmp = mysql_fetch_assoc($resEmp))
				{
					echo'<option value ="'.$i.'">'.$rowEmp["tipo_serv"].'</option>';
					$i++;
				}				
			echo'</select><br/><br/>Agrega una nombre o descripción del servicio:<br/>
				<textarea rows="3" name="txtBusca"></textarea><br/><br/>
				Agrega palabras clave del servicio (separadas por una coma)<br/>
				<input type="text" name="txtFB"/>
				<br/><br/>Agrega una fotografía de tu servicio.
			    <input name="archivo" type="file" size="35" />
			    <input name="action" type="hidden" value="upload" />';
			echo '<br/><br/><input type="submit" name="cmdEnviar" id="cmdEnviar" value="Guardar" />';
		echo '</form><br/><br/><a href="usuario_perfil.php">Terminar de agregar los servicios</a>';

	?>
<?php 
} else {
    echo $mensaje;
}
?>
</td>
  </tr>
</table>

</body>
</html>
