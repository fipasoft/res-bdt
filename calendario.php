<?php 
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
	  <dt><a href="index.htm" title="Inicio">Home</a></dt>';
	  if($_SESSION[access] == false) echo '<dt><a href="session.php" title="sesion">Inicia sesión</a></dt>';
	  echo'<dt><a href="catalogoServ.php" title="Perfil">Catalogo de servicios</a></dt>	
	  <dt><a href="listaProfile.php" title="Ver lista de inversores">Inversores</a></dt>
	  <dt><a href="usuario_perfil.php" title="Perfil">Perfil de usuario</a></dt>	  
	 </dl>
</div></td>
    <td>
<table width="729" border="0">
  
  <tr>
    
    <td>
	<iframe src="http://www.google.com/calendar/embed?src=economiasolidariaenred%40gmail.com&ctz=America/Mexico_City" style="border: 0" width="640" height="480" frameborder="0" scrolling="no"></iframe>
	
	</td>
  </tr>
</table>
</td>
  </tr>
</table>
</body>
</html>';
?>