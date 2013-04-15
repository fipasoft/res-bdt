<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
session_start();
	if(isset($_SESSION[access])) {
		echo "Hola, ".$_SESSION[user];
		
		$conexion = mysql_connect("localhost", "u81329_bdt", "aB1234");
		if ($conexion)
		{		
			if(mysql_select_db("u81329_bdt", $conexion))
			{
				$cadbusca="SELECT * FROM inversores WHERE Codigo_bdt = '". $_SESSION[user] ."'";
				$resEmp = mysql_query($cadbusca, $conexion) or die(mysql_error());
				$rowEmp = mysql_fetch_assoc($resEmp);
				$cadbusca1="SELECT * FROM inversores WHERE Nombre = '". $_POST["recibe"] ."'";
				$resEmp1 = mysql_query($cadbusca1, $conexion) or die(mysql_error());
				$rowEmp1 = mysql_fetch_assoc($resEmp1);

				$i = $rowEmp["nHoras"];
				$i = $i - $_POST["horas"];
				$t = $rowEmp1["nHoras"];
				$t = $t + $_POST["horas"];

				if ($i < -5)
				{
					echo "<br/>No se puede realizar pago de horas, ya no cuenta con horas suficientes, contacte a su Agente de Tiempo";
					echo '<br/><a href="index.htm">Volver a inicio</a>';
				}
				elseif ($t > 20)
				{
					echo "<br/>No se pudo realizar pago de horas porque el destinatario ya tiene su max. de horas";
					echo '<br/><a href="index.htm">Volver a inicio</a>';
				}
				else
				{
					$query = "INSERT INTO pagos (concepto, id_emisor, id_receptor, num_horas, fecha_pago, calif, comentario) 
					VALUES ('". $_POST["concepto"]. "','". $rowEmp["id"]. "','". $rowEmp1["id"]. "','". $_POST["horas"]. "','". date('y/m/d')."','". $_POST["cal"]."','".$_POST["comentario"]."')";
					mysql_query($query, $conexion) or die(mysql_error());
					$query = 'UPDATE inversores SET nHoras="'. $t . '" WHERE Nombre = "'. $_POST["recibe"] .'"';
					mysql_query($query, $conexion) or die(mysql_error());
					$query = 'UPDATE inversores SET nHoras="'. $i . '" WHERE Codigo_bdt = "'. $_SESSION[user] .'"';
					mysql_query($query, $conexion) or die(mysql_error());
					echo "<br/>". $rowEmp["Nombre"]. " le has pagado " . $_POST["horas"] ." hora(s) a ". $_POST["recibe"];
					echo '<br/><a href="usuario_perfil.php">Volver</a>';
					
					$headers = "MIME-Version: 1.0\r\n"; 
					$headers .= "Content-type: text/html; charset=utf-8\r\n";
					//dirección del remitente 
					$headers .= "From: Red de Economía Solidaria <economíasolidariaenred@gmail.com>\r\n"; 
					//dirección de respuesta, si queremos que sea distinta que la del remitente 
					$headers .= "Reply-To: economíasolidariaenred@gmail.com\r\n"; 	
					$mensaje = "Te pagaron horas de la Red de economia solidaria. El inversor ". $rowEmp["Nombre"] . " te pago ". $_POST["horas"] ." hora(s) puedes ver tu saldo <a href='www.rayon.com.mx/bdt'>aqui</a>";
					mail($rowEmp1["Correo"], "Te pagaron horas de tiempo", $mensaje,$headers);
				}
									
				
			}
		}
	}
	else
		echo "No has iniciado sesion";

?>