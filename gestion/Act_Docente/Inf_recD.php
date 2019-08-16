<?php

//echo 'inicia';

include_once("../../../itranet/Connections/conecta.php");


//$conn = $conecta; //mysql_connect($hostname_conecta, $username_conecta, $password_conecta);
//echo 'llege';
$conn = mysqli_connect($hostname_conecta, $username_conecta, $password_conecta);
mysqli_select_db($conn,$database_conecta) or die("cannot select DB");


$ci=$_POST['ci'];
//echo $ci;
echo '</br>';
echo '</br>';



$nombre=$_POST['Nombre'];
$paterno=$_POST['ApPaterno'];
$materno=$_POST['ApMaterno'];
$profesion=$_POST['Profesion'];
$fnacimiento=$_POST['fnacimiento'];
$idcresidencia=$_POST['Residencia'];
$direccion=$_POST['Direccion'];
$td=$_POST['TDomicilio'];
$cel=$_POST['TCel'];
$email=$_POST['Email1'];
$fact=$_POST['factura'];
$to=$_POST['TEmpresa'];
//$pw=$_POST['PEmpresa'];
$rz=$_POST['rz'];
$nit=$_POST['Nit'];

mysqli_query($conn,"UPDATE docente
SET Nombre='$nombre', ApPaterno='$paterno', ApMaterno='$materno', FechaNacimiento='$fnacimiento', IdProfesion=$profesion, IdCiudadResidencia='$idcresidencia',FonoDomicilio='$td',FonoCelu='$cel',Email='$email',Factura='$fact',FonoOficina='$to', RazonSocial='$rz', Nit='$nit' WHERE CiDocente=$ci") or die("Los datos No se actualizaron");
		

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="Refresh" CONTENT="6; URL=http://ibnored.ibnorca.org/inscripcion/form_inscripcion_alumno.php">
<title>Envio de correo</title>

</head>
<body bgcolor="#D6D6D6">

</head>

</head>

<body>
<div> <ul>
	     <h2 align="center">Sus datos se actualizaron correctamente.</h2>
    
    
</ul>
</div>
</body>
</html>
