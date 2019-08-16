<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<?php

$idmodulo=$_GET['mod'];
//echo $idmodulo;


include_once("../../itranet/Connections/conecta.php");
mysql_query("SET NAMES 'utf8'");
define('CHARSET','UTF-8');
header('Content-type: text/html; charset='.CHARSET);


mysql_select_db($database_conecta,$conecta) or die(mysql_error());
$consulta = "select IF(SUM(a.`Nota`)>5,1,0) as cond,m.`FechaFin` as ffin

from `asignacionalumno` a 
inner join modulos m on m.`IdModulo`=a.`IdModulo`
where a.`IdModulo`=$idmodulo";
//echo $consulta;
// 
//where am.`CiAlumno`=5066111  and `alum_aprobado`(am.`IdCurso`,am.`CiAlumno`)='A' 
$result = mysql_query($consulta,$conecta) or die("El curso no tiene alumnos asiganados");
$row = mysql_fetch_array($result);

$condicion=$row['cond'];
$fecha=$row['ffin'];
$actual = date("Y-m-d");
//Incrementando 2 dias
$mod_date = strtotime($fecha."+ 40 days");
//echo date("Y-m-d",$mod_date) . "\n";
$fechalimite=date("Y-m-d",$mod_date);

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