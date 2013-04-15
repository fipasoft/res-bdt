<?php
	$conexion = mysql_connect("localhost", "u81329_bdt", "aB1234");
	if ($conexion)		
		if(!mysql_select_db("u81329_bdt", $conexion))
			die(mysql_error());
			
	$queEmp = "SELECT * FROM tipo_servicio";
	$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
	
	$headers = "MIME-Version: 1.0\r\n"; 
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	//dirección del remitente 
	$headers .= "From: Red de Economía Solidaria <economíasolidariaenred@gmail.com>\r\n"; 
	//dirección de respuesta, si queremos que sea distinta que la del remitente 
	$headers .= "Reply-To: economíasolidariaenred@gmail.com\r\n"; 
	$asunto = "CATALOGO DE SERVICIOS: BDT"; 

	$mensaje = '<html><link href="www.rayon.com.mx/bdt/menu.css" rel="stylesheet" type="text/css">
	<body><div id = "prof"><p>Estos son los servicios que se ofrecen dentro de la red de inversores de tiempo.<br/>
	Actualiza lo mas pronto posible tus servicios dentro del sistema del banco para se encuentren dentro de este catalogo.
	Si necesitas ayuda acude con tu agente de tiempo <br>
	Recuerda que la Red de Economia Solidaria se crea con la participacian de todos <br>
	Si quieres conocer las clases que se imparten en la Escuela de Habiliadades (EHCC)<a href="www.tradeschool.coop/guadalajara">hazlo aqui</a><br/>
	No olvides estar al pendiente de los tianguis de trueque y el trueque agroecologico.<br/><br/> SERVICIOS <table>';
	
	for($t=0;$t < mysql_num_rows($resEmp); $t++)
	{
		$rowEmp = mysql_fetch_assoc($resEmp);
		$mensaje .= "<tr><td><br><amarillo>".$rowEmp["tipo_serv"]."</amarillo></td></tr>";
		$queEmp1 = "SELECT descrip, id_usuario FROM serv_usuario WHERE id_tipo_serv ='". $rowEmp["id"] ."' AND ofer_dem = '1'";
		$resEmp1 = mysql_query($queEmp1, $conexion) or die(mysql_error());
		if(mysql_num_rows($resEmp1) > 0)		
			while($rowEmp1 = mysql_fetch_assoc($resEmp1))
			{
				$mensaje .= "<tr><td><a href='www.rayon.com.mx/bdt/verProfile.php?id=".$rowEmp1["id_usuario"]."'>".$rowEmp1["descrip"] . "</a>
				<hr align='center' width='85%'></td></tr>";
			}
		else
			$mensaje.="<tr><td>No hay servicios en esta categoria<td></tr>";
	}
	$mensaje.="</table></div></td></table></body></html>";		
	
	//echo $headers.$mensaje;
	
	$queEmp = "SELECT Correo FROM inversores";
	$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
	while($rowEmp = mysql_fetch_assoc($resEmp))
		mail($rowEmp["Correo"],$asunto,$mensaje,$headers);
		//mail("cool_aguilar@hotmail.com",$asunto,$mensaje,$headers);
?>