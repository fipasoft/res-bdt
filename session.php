<?php 
	include 'conexion.php';
	if($conexion)
	{
		if($_POST != NULL && $_POST["user"] != "")
		{
					$queEmp = "SELECT * FROM inversores WHERE Codigo_bdt = '". $_POST["user"]. "'";
					$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
					$rowEmp = mysql_fetch_assoc($resEmp);

					if($rowEmp["Codigo_bdt"] == $_POST["user"])
					{
						$_SESSION[access] = true;
						$_SESSION[user] = $_POST["user"];
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
						echo "Error, ese c�digno no existe";
						$_SESSION[access] = false;
						session_destroy();
					}

		}
	}
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
	  <dt><a href="session.php" title="sesion">Inicia sesi�n</a></dt>
	  <dt><a href="catalogoServ.php" title="Perfil">Catalogo de servicios</a></dt>	
	  <dt><a href="listaProfile.php" title="Ver lista de inversores">Inversores</a></dt>
	  <dt><a href="usuario_perfil.php" title="Perfil">Perfil de usuario</a></dt>	
	  
      <dt><a href="index.htm" title="Aplicaci�n BdT 1.0 beta">Acerca de</a></dt>
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