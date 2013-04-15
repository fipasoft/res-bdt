<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Respuesta de Sistema</title>
</head>

<body>
<?php
	
	$conexion = mysql_connect("localhost", "u81329_bdt", "aB1234");
	if ($conexion)
	{	
		if(mysql_select_db("u81329_bdt", $conexion))
		{	
				$query = 'UPDATE inversores SET Nombre="'. strtoupper($_POST['txtNombre']).'", Sexo='.$_POST['cmbSexo'].', Nacimiento="'.$_POST['txtFNacimiento'].'", Domicilio="'.  $_POST['txtDomicilio'].'", Correo="'. $_POST['txtCorreo'].'", Telefono="'. $_POST['txtTelefono']. '", Lugar_Nac="'. $_POST['txtLugarNac'].'", Entero_bdt="'. $_POST['txtEntero'].'", nombreFB="'. $_POST['txtFB']. '", Ingreso_bdt="'. $_POST['txtIngreso'] . '", Codigo_bdt="'.  $_POST['txtCodigo'].'", Colonia="'. $_POST['txtColonia'].'", CP="'.  $_POST['txtCP'].'", Ciudad="'. $_POST['txtCiudad'].'" WHERE id="'. $_POST['id'].'"';
				//echo $query;
				 if(!mysql_query($query,$conexion)) 
					die(mysql_error());
				echo "Inversor editado exitosamente<br /><a href ='usuario_perfil.php'>Volver</a>";				
            				
		}	
		else
			die(mysql_error());
	}
	
?>
</body>
</html>
