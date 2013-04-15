<?php 
	session_start();
	if(!isset($_SESSION[access]))
	{
		if($_POST != NULL && $_POST["user"] != "")
		{
			$conexion = mysql_connect("localhost", "u81329_bdt", "aB1234");
			if ($conexion)
			{		
				if(mysql_select_db("u81329_bdt", $conexion))
				{
					$queEmp = "SELECT * FROM inversores WHERE Codigo_bdt = '". $_POST["user"]. "'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$rowEmp = mysql_fetch_assoc($resEmp);

					if($rowEmp["Codigo_bdt"] == $_POST["user"])
					{
						$_SESSION[access] = true;
						$_SESSION[user] = $_POST["user"];
						// echo "INICIO CORRECTO, PARA CONTINUAR PRESIONA EL BOTÓN ";
						// echo '<form id="form1" name="form1" method="post" action="usuario_perfil.php">'.
							  // '<input type="submit" name="cmdEnviar" id="cmdEnviar" value="Continuar" />'.
							 // '</form>';
							?>
							<script>
								window.location.href = "usuario_perfil.php";
							</script>
							<?
					}
					elseif($_POST["user"] == "admin")
					{
						$_SESSION[access] = true;
						$_SESSION[user] = $_POST["user"];
						?>
							<script>
								window.location.href = "admin.php";
							</script>
						<?
					}
					else
					{
						echo "Error, ese códigno no existe";
						$_SESSION[access] = false;
						session_destroy();
					}
				}
			}

		}
	}
	else
		echo "Ud. ya inició sesión, no es necesario que vuelva a iniciar";
echo'
<link href="menu.css" rel="stylesheet" type="text/css">
<body><table width="729" border="0">
  <tr>
    <td width="200">&nbsp;</td>
    <td width="482"><div align="center"><img src="header.png" width="318" height="154" /></div></td>
  </tr>
  <tr>
    <td>
    <div id="menu">
	 <dl>
	  <dt><a href="index.htm" title="Inicio">Home</a></dt>
	  <dt><a href="session.php" title="sesion">Inicia sesión</a></dt>
	  <dt><a href="catalogoServ.php" title="Perfil">Catalogo de servicios</a></dt>	
	  <dt><a href="listaProfile.php" title="Ver lista de inversores">Inversores</a></dt>
	  <dt><a href="usuario_perfil.php" title="Perfil">Perfil de usuario</a></dt>	
	  
      <dt><a href="index.htm" title="Aplicación BdT 1.0 beta">Acerca de</a></dt>
	 </dl>
</div></td>
    <td>
<table width="729" border="0">
  
  <tr>
    
    <td>Inicie sesion <br/><br/>
	<form id="form1" name="form1" method="post" action="session.php">
    Nombre de usuario <input type="text" name="user" id="user"/><br/><br/>
	(Tu nombre de usuario es la parte antes de @ del correo que nos proporcionaste, ejemplo: <br/>
	micorreo123@mail.com  tu nombre de usuario es micorreo123) <br/><br/>
	<input type="submit" name="cmdEnviar" id="cmdEnviar" value="Iniciar" />
	</form>
	</td>
  </tr>
</table>
</td>
  </tr>
</table>
</body>
</html>';?>