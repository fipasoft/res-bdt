<?php
session_start(); 
echo '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Datos del Usuario</title>
</head>
<link href="menu.css" rel="stylesheet" type="text/css">
<body>
<table width="729" border="0">
  <tr>
    <td width="200">&nbsp;</td>|
    <td width="482"><div align="center"><img src="header.png" width="318" height="154" /></div></td>
  </tr>
  <tr>
	<td valign="top">
    <div id="menu">
	 <dl>
	 <dt><a href="index.htm" title="Inicio">Home</a></dt>
		  <dt><a href="listaProfile.php" title="Ver lista de inversores">Inversores</a></dt>
		  <dt><a href="usuario_perfil.php" title="Perfil">Perfil de usuario</a></dt>	  
		  <dt><a href="calendario.php" title="Perfil">Calendario</a></dt>	
		  <dt><a href="index.htm" title="Aplicación BdT 1.0 beta">Acerca de</a></dt>
	 </dl>
</div></td>
    <td>';
	
if($_SESSION[access] == true) 
{		
	
	echo '<div id = "prof">Dentro del catalogo de servicios encontrara la informacion de los servicios que se estan ofreciendo y 
		  aquellos que se estan buscando. Podra acceder a los datos de quien ofrece o busca ese servicio con darle click al nombre del servicio.<br/>
		  <br/><a href="catalogoServ1.php"> Se ofrece </a><br/><br/>
		  <a href="catalogoServ2.php"> Se busca </a></div">';
}
?>