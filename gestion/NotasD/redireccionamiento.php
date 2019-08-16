<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<?php

$idmodulo=$_GET['mod'];
//echo $idmodulo;


if (!isset($_SESSION) ) {
  session_start(); }
  
include_once("../../../itranet/Connections/conecta.php");


//$conn = $conecta; //mysql_connect($hostname_conecta, $username_conecta, $password_conecta);
//echo 'llege';
$conn = mysqli_connect($hostname_conecta, $username_conecta, $password_conecta);
mysqli_select_db($conn,$database_conecta) or die("cannot select DB");



$consulta = "select IF(SUM(a.`Nota`)>5,1,0) as cond,m.`FechaFin` as ffin

from `asignacionalumno` a 
inner join modulos m on m.`IdModulo`=a.`IdModulo`
where a.`IdModulo`=$idmodulo";
//echo $consulta;
// 
//where am.`CiAlumno`=5066111  and `alum_aprobado`(am.`IdCurso`,am.`CiAlumno`)='A' 
$rs=mysqli_query($conn,$consulta) or die(mysqli_error()) ;
      	$row=mysqli_fetch_array($rs);

$condicion=$row['cond'];
$fecha=$row['ffin'];
$actual = date("Y-m-d");
//echo $fecha;
//echo '</br>';
//Incrementando 2 dias
$mod_date = strtotime($fecha."+ 1000 days");
//echo date("Y-m-d",$mod_date) . "\n";
$fechalimite=date("Y-m-d",$mod_date);
//echo $fechalimite;
//echo '</br>';
//echo $actual;
if($condicion==1)
{header('Location: Lista_Notas.php?a='.$idmodulo);}
else
{
	if($actual>$fechalimite){echo 'El plazo para ingresar las notas ha expirado. Por favor contactese con el área de capacitación.';}else{
	header('Location: form_notas.php?mod='.$idmodulo);}}


//echo $condicion;

/*
if($condicion==1){header('Location: Lista_Notas.php?a='.$idmodulo);}else{header('Location: form_notas.php?mod='.$idmodulo);}
*/

//header('Location: Lista_Notas.php?a='.$idmodulo);

?>

<body>
</body>
</html>