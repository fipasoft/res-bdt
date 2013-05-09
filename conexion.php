<?php

session_start();

if ($_SESSION['access'] == true) {
    $conexion = mysql_connect("localhost", "u81329_bdt", "aB1234");
    if (!$conexion || !mysql_select_db("u81329_bdt", $conexion)) {
        $conexion = false;
        $mensaje = "Error al conectarse a la base de datos.";
    }
} else {
    $conexion = false;
    $mensaje = "No tiene permisos para ver esta p&aacute;gina";
}
