<?php include 'conexion.php'?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Datos del Usuario</title>
</head>

<link href="menu.css" rel="stylesheet" type="text/css">

<script language="javascript">
	function seleccionaServ( serv, i )
	{
		var cmbServicio = document.form1.elements[i];		
		var it;
		for( it = 0; it <= cmbServicio.length; it++)
		{
			if(cmbServicio.options[it].text == serv)
			{
				cmbServicio.options[it].selected = true;
			}
		}
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
	  <dt><a href="index.htm" title="Aplicación BdT 1.0 beta">Acerca de</a></dt>
	 </dl>
</div></td>
<?php if ($conexion) { ?>
    <td>
    <form action="agregarServicios.php" method="post" name="form1" id="form1">
      <p>
        <?php
	
	if($_GET != NULL)
	{
				$queEmp = "SELECT * FROM inversores WHERE id = '". $_GET["id"]. "'";
				echo '<input name="idOculto" id = "idOculto" type="hidden" value="'.$_GET["id"].'" />';
				$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
				$rowEmp = mysql_fetch_assoc($resEmp);
				
				echo 'Nombre: '. $rowEmp["Nombre"];
				echo '<br/> Correo: '. $rowEmp["Correo"];
				echo '<br/> Teléfono: '. $rowEmp["Telefono"];
				
				$queEmp = 'SELECT servicios.ofrece FROM  ServInv_oferta , inversores, servicios WHERE inversores.id ='. $_GET["id"] .' AND inversores.id = ServInv_oferta.id_inversor AND ServInv_oferta.num_serv = servicios.id';
				$query2 = "SELECT * FROM servicios ORDER BY ofrece ASC";
				
				$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
				
				echo '<br/> <br/>'.  mysql_num_rows($resEmp) .' Servicios que ofrece: <br/>';
				$i = 0;
				while ($rowEmp = mysql_fetch_assoc($resEmp))
				{
					echo '<select name ="cmbSO'.$i.'" id="cmbSO'.$i.'>';
					$resEmp2 = mysql_query($query2, $conexion) or die(mysql_error());
					while ($rowEmp2 = mysql_fetch_assoc($resEmp2))
						echo '<option value= '. $rowEmp2["ofrece"] .'>'. $rowEmp2["ofrece"].'</option>';
					echo '</select>';	
					?>
        			
					<script>
						var env ='<? echo $rowEmp["ofrece"]; ?>';
						var env2 = '<? echo $i; ?>';
						seleccionaServ(env, env2);
					</script>
       				<?
					$i++;
				}
				
				$queEmp = 'SELECT servicios.ofrece FROM  ServInv_demanda , inversores, servicios WHERE inversores.id ='.$_GET["id"].' AND inversores.id = ServInv_demanda.id_inversor  AND ServInv_demanda.num_serv = servicios.id';
				$query2 = "SELECT * FROM servicios ORDER BY id ASC";
				
				$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
				
				echo '<br/> <br/>'.  mysql_num_rows($resEmp) .' Servicios que demanda: <br/>';
				//$i = 11;
				while ($rowEmp = mysql_fetch_assoc($resEmp))
				{
					echo '<select name ="cmbSO'.$i.'" id="cmbSO'.$i.'>';
					$resEmp2 = mysql_query($query2, $conexion) or die(mysql_error());
					while ($rowEmp2 = mysql_fetch_assoc($resEmp2))
						echo '<option selected= "selected" value= '. $rowEmp2["id"] .'>'. $rowEmp2["ofrece"].'</option>';
					echo '</select>';	
					?>
					<script>
						var env ='<? echo $rowEmp["ofrece"]; ?>';
						var env2 = '<? echo $i; ?>';
						seleccionaServ(env, env2);
					</script>
        <?
					$i++;
				}
				
	}
?>

</p>
      <p>
        <label>
        <input type="submit" name="cmdAdd" id="cmdAdd" value="Agregar + servicios" />
        </label>
</p>
    </form>
</td>
  </tr>

<?php
} else { 
    echo $mensaje;
}
?>
</table>
</body>
</html>
