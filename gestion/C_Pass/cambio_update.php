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


include_once("../../../itranet/Connections/conecta.php");


$conn = mysqli_connect($hostname_conecta, $username_conecta, $password_conecta);
mysqli_select_db($conn,$database_conecta) or die("cannot select DB");


	mysqli_query($conn,"update `docente` 
set Password='$pass'
where CiDocente=$ci");


$csql="update `docente` 
set Password='$pass'
where CiDocente=$ci" or die("cannot select DB");
//echo $csql;
	
	  
echo 'La contraseña se ha cambiado de manera exitosa.';

?>


</body>
</html> 