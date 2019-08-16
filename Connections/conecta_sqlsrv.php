<?php

/// conexion a sql
	$dsn = "conta"; 
	//debe ser de sistema no de usuario
	$usuario = "sa";
	$clave="ibnosistemas";
	//realizamos la conexion mediante odbc
	$cid=odbc_connect($dsn, $usuario, $clave);
	if (!$cid){
		exit("<strong>Ya ocurrido un error tratando de conectarse con el origen de datos. SQL_SRV/Contabilidad</strong>");
	}

?>