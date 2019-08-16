<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Redireccionamiento</title>
<script Language="JavaScript">
   if(window.history.forward(1) != null)
        window.history.forward(1);
</script>

</head>
<?php

$idmodulo=$_GET['mod'];
//echo $idmodulo;


include_once("../../itranet/Connections/conecta.php");
mysql_query("SET NAMES 'utf8'");
define('CHARSET','UTF-8');
header('Content-type: text/html; charset='.CHARSET);


mysql_select_db($database_conecta,$conecta) or die(mysql_error());
$consulta = "select IF(SUM(IF(`nota_final`(a.`Nota`,a.`Asistencia`,a.`Practicas`)<71,1,0))>0,1,0)  as cond 
from `asignacionalumno` a where a.`IdModulo`=$idmodulo";
//echo $consulta;
// 
//where am.`CiAlumno`=5066111  and `alum_aprobado`(am.`IdCurso`,am.`CiAlumno`)='A' 
$result = mysql_query($consulta,$conecta) or die("ERROR de conexion a la base de datos alumnos");
$row = mysql_fetch_array($result);

$condicion=$row['cond'];
//echo $condicion;
if($condicion==0){header('Location: Lista_Notas_recuperatorio.php?a='.$idmodulo);}else{header('Location: form_notas_recuperatorio.php?mod='.$idmodulo);}


//header('Location: Lista_Notas.php?a='.$idmodulo);

?>

<body>
</body>
</html>