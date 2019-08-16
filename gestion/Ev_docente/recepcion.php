<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

<?php
include_once("../../../itranet/Connections/conecta.php");
include_once("../../../itranet/iCapacitacion/gestion/ImpCertif/utilities.php");

$conn = mysqli_connect($hostname_conecta, $username_conecta, $password_conecta);
mysqli_select_db($conn,$database_conecta) or die("cannot select DB");


$cialum=$_POST['cialumno'];
//echo $cialum.'</br>';
$mod=$_POST['idmod'];
//echo $mod.'</br>';
$curso=$_POST['idcur'];
//echo $curso.'</br>';
$i=1;
	

$pregunta[$i]=$_POST['Pregunta11'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta12'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta13'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta14'];
$i=$i+1;




//Segunda seccion de preguntas
$pregunta[$i]=$_POST['Pregunta21'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta22'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta23'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta24'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta25'];
$i=$i+1;

//Tercera Seccion de preguntas
$pregunta[$i]=$_POST['Pregunta31'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta32'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta33'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta34'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta35'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta36'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta37'];
$i=$i+1;

//Cuarta seccion de preguntas
$pregunta[$i]=$_POST['Pregunta41'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta42'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta43'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta44'];
$i=$i+1;
$pregunta[$i]=$_POST['Pregunta45'];
$i=$i+1;

//Quinta Seccion - preguntas abiertas
$pregunta[$i]=$_POST['preg5'];
$i=$i+1;
$pregunta[$i]=$_POST['preg6'];


/*
echo $pregunta21;
echo '</br>';
echo $pregunta22;
echo '</br>';
echo $pregunta23;
echo '</br>';
$i=0;*/
$p=900;
for($j=1;$j<22;$j++){
	
	mysqli_query($conn,"insert into respuestassatisfaccion (IdRespuesta,IdPregunta,IdRespuestas,IdModulo,IdCurso,CiAlumno,fechareg)
Values
(0,$p,$pregunta[$j],$mod,$curso,$cialum,now())") or die("cannot select DB");

	$p=$p+1;
	}
	
	$j=22;
	for($j=22;$j<24;$j++){
	
	mysqli_query($conn,"insert into respuestassatisfaccion (IdRespuesta,IdPregunta,Respuestatxt,IdModulo,IdCurso,CiAlumno,fechareg)
Values
(0,$p,'$pregunta[$j]',$mod,$curso,$cialum,now())") or die("cannot select DB");
$p=$p+1;
	
	}






?>
Los Datos fueron recibidos, ya puede revisar la nota de su módulo.

</body>
</html>