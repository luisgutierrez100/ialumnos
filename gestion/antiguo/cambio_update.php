<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

<?php

$pass=$_POST['nuevopassword1'];
$ci=$_POST['ci'];
//echo $pass;
//echo '</br>';
//echo $ci;


include_once("../../itranet/Connections/conecta.php");
mysql_query("SET NAMES 'utf8'");
define('CHARSET','UTF-8');
header('Content-type: text/html; charset='.CHARSET);


mysql_select_db($database_conecta,$conecta) or die(mysql_error());

$csql="update `docente` 
set Password='$pass'
where CiDocente=$ci";
//echo $csql;
	  $r=mysql_query($csql) or die(mysql_error()) ;
	  
echo 'La contraseña se ha cambiado de manera exitosa.';

?>


</body>
</html> 