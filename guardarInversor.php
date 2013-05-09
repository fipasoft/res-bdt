<?php include 'conexion.php'; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Respuesta de Sistema</title>
</head>

<body>
<?php
	if ($conexion)
	{		
			$clave = substr($_POST['txtCorreo'],0, strpos($_POST['txtCorreo'],"@"));
			if($_POST["id"] == NULL)
			{	
				$query = "SELECT Nombre FROM inversores WHERE Correo ='". $_POST['txtCorreo']. "'";
				$resEmp = mysql_query($query,$conexion) or die(mysql_error());
				$totEmp = mysql_num_rows($resEmp);
				
				if($totEmp >= 1)
					echo' El usuario ya existe, no se puede grabar';
				else
				{
					//query para guardar
					$query = "INSERT INTO inversores(Nombre, Sexo, Nacimiento, Domicilio, Correo, Telefono, Lugar_Nac, Entero_bdt, nombreFB, Ingreso_bdt, Codigo_bdt, Colonia, CP, Ciudad, ServBusca, ServOfrece, nHoras, activo, asesor) VALUES ( '". strtoupper($_POST['txtNombre'])."', '" . $_POST['cmbSexo']."', '" . $_POST['txtFNacimiento']. "', '" . $_POST['txtDomicilio']. "',	'" . $_POST['txtCorreo']."', '" . $_POST['txtTelefono']. "', '" . $_POST['txtLugarNac']."', '" . $_POST['txtEntero']."', '" . $_POST['txtFB']. "', '" . $_POST['txtIngreso']. "', '" . $clave."', '" . $_POST['txtColonia']."', '" . $_POST['txtCP']."', '" . $_POST['txtCiudad']."', '" . $_POST['txtBusca']."', '" . $_POST['txtOfrece']. "', '5', '1', '". $_POST['txtAsesor'] ."')";
					if(!mysql_query($query,$conexion)) 
						die(mysql_error());
					echo "Inversor agregado exitosamente<br />";
					$headers = "MIME-Version: 1.0\r\n"; 
					$headers .= "Content-type: text/html; charset=utf-8\r\n";
					//dirección del remitente 
					$headers .= "From: Red de Economía Solidaria <economíasolidariaenred@gmail.com>\r\n"; 
					//dirección de respuesta, si queremos que sea distinta que la del remitente 
					$headers .= "Reply-To: economíasolidariaenred@gmail.com\r\n";
					$mensaje = "Hola ".$_POST['txtNombre'].", 

te agradecemos tu interés en la Red de Economía solidaria, ya eres parte del banco de tiempo y parte del movimiento de transformación de la economía de este país.

Para poder acceder al sistema tienes que entrar a la URL: www.rayon.com.mx/bdt  tu clave de acceso es: ". $clave . " 
Te recordamos que tienes 5 horas de tiempo para poder utilizarlas en intercambiar servicios.

También agréganos en FB en la dirección www.facebook.com/res.guadalajara y visitar nuestro blog http://reddeeconomiasolidaria.blogspot.mx/ 
Cualquier duda puedes escribirnos a economiasolidariaenred@gmail.com
								
¡Saludos!
Equipo de la Red de Economía Solidaria (RES)";
					if(mail($_POST['txtCorreo'], "Red de economia solidaria", $mensaje,$headers))
					{
						echo "Si usted es inversor nuevo entonces cuenta con 5 horas de saldo para poder obtener servicios<br/> favor de acercarse con el agente de tiempo para obtener informacion acerca de como realizar los intercambios de tiempo.";
						echo "<br/><a href = 'www.rayon.com.mx/bdt'>Regresar</a>";
					}
					else
						echo "Hubo un error al envíar el correo electrónico";
				}
			}
			else
			{	
				$query = 'UPDATE inversores SET Nombre="'. strtoupper($_POST['txtNombre']).'", Sexo='.$_POST['cmbSexo'].', Nacimiento="'.$_POST['txtFNacimiento'].'", Domicilio="'.  $_POST['txtDomicilio'].'", Correo="'. $_POST['txtCorreo'].'", Telefono="'. $_POST['txtTelefono']. '", Lugar_Nac="'. $_POST['txtLugarNac'].'", Entero_bdt="'. $_POST['txtEntero'].'", nombreFB="'. $_POST['txtFB']. '", Ingreso_bdt="'. $_POST['txtIngreso'] . '", Codigo_bdt="'.  $_POST['txtCodigo'].'", Colonia="'. $_POST['txtColonia'].'", CP="'.  $_POST['txtCP'].'", Ciudad="'. $_POST['txtCiudad'].'", ServOfrece="'. $_POST['txtOfrece'].'", ServBusca="'. $_POST['txtBusca']. '", nHoras="'.$_POST["txtHora"] .'", activo="'.$_POST["txtActivo"].'" WHERE id="'. $_POST['id'].'"';
				//echo $query;
				 if(!mysql_query($query,$conexion)) 
					die(mysql_error());
				echo "Inversor editado exitosamente<br />";
            }
	} else {
	    echo $mensaje;
    }
	
?>
</body>
</html>
