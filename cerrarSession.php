<?php
	session_start();	
	if(isset($_SESSION[access]))
	{
		$_SESSION[access] = false;
		session_destroy();
	}
	?>
							<script>
								window.location.href = "index.htm";
							</script>
							<?
	
?>