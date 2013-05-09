<?php include 'conexion.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nuevo Inversor de Tiempo</title>
</head>
<link href="menu.css" rel="stylesheet" type="text/css">
<script language="javascript">
	function seleccionaCmb( id )
	{
		var cmbServicio = document.form1.cmbSexo;
		cmbServicio.options[id].selected = true;
	}
</script>

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
		  <dt><a href="listaProfile.php" title="Ver lista de inversores">Inversores</a></dt>
		  <dt><a href="frmNuevo.php" title="Agrega un inversor">Nuevo Inversor</a></dt>
		  <dt><a href="usuario_perfil.php" title="Perfil">Perfil de usuario</a></dt>	  
		  <dt><a href="index.htm" title="Aplicación BdT 1.0 beta">Acerca de</a></dt>
	 </dl>
</div></td>

<?php if ($conexion) { ?>

<?
if($_GET != NULL)
{
    $queEmp = "SELECT * FROM inversores WHERE id = '". $_GET["id"]. "'";
    $resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
    $rowEmp = mysql_fetch_assoc($resEmp);
}
?>
    <td><form id="form1" name="form1" method="post" action="editarInversor.php">
      <p>Datos del nuevo inversor:</p>
  <table width="534" border="1">
    <tr>
      <td width="203">Nombres y apellidos
        <label>
		<? echo '<input name="id" type="hidden" value='. $rowEmp["id"].'>' ?>
        <? echo '<input type="text" name="txtNombre" id="txtNombre" value="'. $rowEmp["Nombre"].'"/>'; ?>
        </label></td>
      <td width="119">Sexo:
        <label>
        <select name="cmbSexo" id="cmbSexo">
            <option value="0" >Femenino</option>
            <option value="1">Masculino</option>
        </select>
		<script>
			var env = '<? echo $rowEmp["Sexo"];?>';
		   	seleccionaCmb(env);	
		</script>
        
        </label>
        <label></label></td>
      <td width="170">Lugar
        <label> nacimiento:
        <? echo '<input type="text" name="txtLugarNac" id="txtLugarNac" value="'.$rowEmp["Lugar_Nac"].'"/>';?>
        </label>
        <label> </label></td>
    </tr>
    <tr>
      <td>Fecha Nacimiento:
        <label>
        <? echo '<input type="text" name="txtFNacimiento" id="txtFNacimiento" value="'.$rowEmp["Nacimiento"].'"/>';?>
        </label></td>
      <td><label>Teléfono de contacto:
        <? echo '<input type="text" name="txtTelefono" id="txtTelefono" value="'.$rowEmp["Telefono"].'"/>';?>
      </label></td>
      <td>Correo:
        <label>
        <? echo '<input type="text" name="txtCorreo" id="txtCorreo" value="'.$rowEmp["Correo"].'"/>';?>
        </label></td>
    </tr>
    <tr>
      <td>Domicilio:
        <label>
        <? echo '<input type="text" name="txtDomicilio" id="txtDomicilio" value="'.$rowEmp["Domicilio"].'" />'; ?>
        </label></td>
      <td>Colonia: 
        <? echo '<input type="text" name="txtColonia" id="txtColonia" value="'.$rowEmp["Colonia"].'"/>';?></td>
      <td>Código Postal: 
        <? echo '<input type="text" name="txtCP" id="txtCP" value='.$rowEmp["CP"].'>';?></td>
    </tr>
    <tr>
      
      <td>¿Cómo se enteró del BdT?
        <label>
        <? echo '<input type="text" name="txtEntero" id="txtEntero" value="'. $rowEmp["Entero_bdt"].'"/>';?>
        </label></td>
      <td>Nombre de facebook
        <label>
        <? echo '<input type="text" name="txtFB" id="txtFB" value="'.$rowEmp["nombreFB"].'"/>';?>
        </label></td>
    </tr>
    <tr>
      <td>Fecha de ingreso al BdT:
        <label>
        <? echo '<input type="text" name="txtIngreso" id="txtIngreso" value="'.$rowEmp["Ingreso_bdt"].'"/>';?>
        </label></td>
     
	
		<?
			if($_GET != NULL)
			{	
					echo '<td> Codigo ingreso
						<input type="text" name="txtCodigo" value="'.$rowEmp["Codigo_bdt"].'"/>
					</td>';
			}
		?>
	
		<td>Ciudad: 
        <?
			$conexion = mysql_connect("localhost", "u81329_bdt", "aB1234");
			if ($conexion)	
				if(mysql_select_db("u81329_bdt", $conexion))
				{
					$queEmp = "SELECT * FROM municipios WHERE estado = '1' ORDER BY nombre_municipio ASC";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
				}
			echo '<select name="txtCiudad" id="txtCiudad">';
			while($rowEmp = mysql_fetch_assoc($resEmp))
				echo'<option>'. $rowEmp["nombre_municipio"]. '</option>';
			echo'</select>';
			?></td>
        
    </tr>
  </table>
  <p>
    <label>
    <input type="submit" name="cmdEnviar" id="cmdEnviar" value="Guardar" />
    </label>
  </p>
</form></td>
  </tr>
  
<?php 

} else {
    echo $mensaje;
}

?>
</table>
</body>
</html>
