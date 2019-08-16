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

include_once("../../../itranet/Connections/conecta.php");
include_once("../../../itranet/iCapacitacion/gestion/ImpCertif/utilities.php");

$conn = mysqli_connect($hostname_conecta, $username_conecta, $password_conecta);
mysqli_select_db($conn,$database_conecta) or die("cannot select DB");


$nf=$_POST['nf']-1;
//echo $nf.'nf'.'</br>';
$idmodulo=$_POST['mod'];
//echo $idmodulo.'mod'.'</br>';
$n=1;

while($n<=$nf){
		$recuperatorio=$_POST['recuperatorio'.$n] ;
	echo $n.$recuperatorio.'nota'.'</br>';
	
	$ci=$_POST['ci'.$n] ;
	echo $ci.'ci'.'</br>';
	
		
		if(isset($_POST['recuperatorio'.$n])) {
			$recuperatorio=$_POST['recuperatorio'.$n] ;
		echo $recuperatorio.'</br>';
		
			mysqli_query($conn,"update `asignacionalumno` a
set a.`Recuperatorio1`=$recuperatorio
where a.`CiAlumno`=$ci and a.`IdModulo`=$idmodulo");// or die("cannot select DB");

		//$csql="";
//echo $csql;
	

		}
		
			  $n=$n+1;
			  echo $n.'</br>';
}
header('Location: ../NotasD/Lista_Notas.php?a='.$idmodulo);
 ?>

</body>
</html>