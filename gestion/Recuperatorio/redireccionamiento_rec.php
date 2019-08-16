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
if (!isset($_SESSION) ) {
  session_start(); }
  
include_once("../../../itranet/Connections/conecta.php");


//$conn = $conecta; //mysql_connect($hostname_conecta, $username_conecta, $password_conecta);
//echo 'llege';
$conn = mysqli_connect($hostname_conecta, $username_conecta, $password_conecta);
mysqli_select_db($conn,$database_conecta) or die("cannot select DB");


$consulta = "select IF(SUM(IF(`nota_final`(a.`Nota`,a.`Asistencia`,a.`Practicas`)<71,1,0))>0,1,0)  as cond 
from `asignacionalumno` a where a.`IdModulo`=$idmodulo";
//echo $consulta;
// 
//where am.`CiAlumno`=5066111  and `alum_aprobado`(am.`IdCurso`,am.`CiAlumno`)='A' 
$rs=mysqli_query($conn,$consulta) or die(mysqli_error()) ;
      	$row=mysqli_fetch_array($rs);
		
$condicion=$row['cond'];
echo $condicion;

if($condicion==0){header('Location: ../NotasD/Lista_Notas.php?a='.$idmodulo);}else{header('Location: form_rec.php?mod='.$idmodulo);}


//header('Location: Lista_Notas.php?a='.$idmodulo);

?>

<body>
</body>
</html>