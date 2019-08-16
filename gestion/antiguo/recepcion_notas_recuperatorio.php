<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recepcion de notas</title>
<script type="text/javascript">
window.onload=function(){
	Objeto=document.getElementsByTagName("a");
	for(a=0;a<Objeto.length;a++){
		Objeto[a].onclick=function(){
			location.replace(this.href);
			return false;
		}
	}
}
</script>
</head>

<body>
<?php

include_once("../../itranet/Connections/conecta.php");
mysql_query("SET NAMES 'utf8'");
define('CHARSET','UTF-8');
header('Content-type: text/html; charset='.CHARSET);


mysql_select_db($database_conecta,$conecta) or die(mysql_error());


$nf=$_POST['nf']-1;
//echo $nf;
$idmodulo=$_POST['mod'];
//echo $nf;
$n=1;

while($n<=$nf){
		$recuperatorio=$_POST['recuperatorio'.$n] ;
	echo $recuperatorio.'</br>';
	
	$ci=$_POST['ci'.$n] ;
	//echo $ci.'</br>';
	
		
		if(isset($_POST['recuperatorio'.$n])) {
			$recuperatorio=$_POST['recuperatorio'.$n] ;
		
		$csql="update `asignacionalumno` a
set a.`Recuperatorio1`=$recuperatorio
where a.`CiAlumno`=$ci and a.`IdModulo`=$idmodulo";
echo $csql;
	  $r=mysql_query($csql);

		}
		
			  $n=$n+1;
}
header('Location: Lista_Notas_recuperatorio.php?a='.$idmodulo);
 ?>

</body>
</html>