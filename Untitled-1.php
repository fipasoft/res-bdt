<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>
<script>
	function a(){
	alert( parseInt(document.frm.hey1.value) + parseInt(document.frm.hey2.value));
	}
</script>
<body>
<form name="frm">
<input name="hey1" type="text" />
<input name="hey2" type="text" />
<input name="total" type="text" />
<input name="" type="button" onclick="a()" />
</form>
</body>
</html>
