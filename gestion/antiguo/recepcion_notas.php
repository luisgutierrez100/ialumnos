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
include_once("../../itranet/iCapacitacion/gestion/ImpCertif/utilities.php");



mysql_query("SET NAMES 'utf8'");
define('CHARSET','UTF-8');
header('Content-type: text/html; charset='.CHARSET);


mysql_select_db($database_conecta,$conecta) or die(mysql_error());


$nf=$_POST['nf']-1;
//echo $nf;
$idmodulo=$_POST['mod'];
$tema=$_POST['tema'];
$grupo=$_POST['grupo'];
//echo $_POST['grupo'];
$especislista=$_POST['especialista'];
//echo $_POST['especialista'];

//echo $nf;
$n=0;
$n=$n+1;

while($n<=$nf){
		$examen=$_POST['examen'.$n] ;
	//echo $examen.'</br>';
		$asistencia=$_POST['asistencia'.$n] ;
//	echo $asistencia.'</br>';
		$practicas=$_POST['practicas'.$n] ;
		$nalumno=$_POST['nalumno'.$n] ;
	//	echo $nalumno;
	//echo $practicas.'</br>';
	$ci=$_POST['ci'.$n] ;
	//echo $ci.'</br>';
	
		
		
		
		$csql="update `asignacionalumno` a
set a.`Nota`=$examen,a.`Asistencia`=$asistencia,a.`Practicas`=$practicas
where a.`CiAlumno`=$ci and a.`IdModulo`=$idmodulo";
//echo $csql;
	  $r=mysql_query($csql) or die(mysql_error()) ;
	  $n=$n+1;
	  
	  

//echo $row['codigo'];


}

require_once('../../PHPMailer/class.phpmailer.php');
require_once('../../PHPMailer/class.smtp.php');

class Correo {
	public function enviarCorreo($correoEnvia, $pwdCorreo, $nomEnvia, $correoDestino, $nomDestino, $asunto, $mensaje){
	  $m = new PHPMailer();
	  //echo $m->Version;
	  //indico a la clase que use SMTP
	  $m->isSMTP();
	  
	  //permite modo debug para ver mensajes de las cosas que van ocurriendo
	  $m->SMTPDebug =(0);
	//Debo de hacer autenticación SMTP
	$m->SMTPAuth = true;
	//$m->SMTPSecure ="ssl";
	$m->SMTPSecure ="tls";
	
	//indico el servidor de Gmail para SMTP
	$m->Host ="smtp.gmail.com";
	//indico el puerto que usa Gmail
	//$m->Port = 465;
	$m->Port = 587;
	$m->CharSet='UTF-8';
	  
	  //indico un usuario / clave de un usuario de gmail
	  $m->Username = $correoEnvia;
	  $m->Password = $pwdCorreo;
	  $m->setFrom($correoEnvia,$nomEnvia);
	  //$m->AddReplyTo('info@ibnorca.org','Info Ibnorca');
	  $m->Subject = $asunto;
	  $m->MsgHTML = $mensaje;

$m->Body=$mensaje;

	  $m->AltBody ='Mensaje';
	  
	  
	  //indico destinatario
  
	  $m->AddAddress($correoDestino, $nomDestino);
	 // $m->AddAddress($email,$nalumno);
	  //$m->addCC('willy.miranda@ibnorca.org','Willy');
	  //
	 // echo $mensaje;
	  //$m­>AddAddress($address, "Info Ibnorca");
	  if (!$m->Send()) {
	  $resp = 'Error al enviar '. $m->ErrorInfo; 
	  
	  }
	  else
	  { 
	  
	  $resp = true;
	  }
	  return $resp;
	}

}

$consulta = " select  `f_codModulo`(m.`IdModulo`) as codigo,p.`IdOficina` as ofi,
`d_clasificador`(p.`IdPrograma`) as programa,
n_docente(m.CiDocente) as docente,m.CiDocente as cidocente,
 `d_clasificador`(p.IdGestion) as gestion,`d_clasificador`(m.`IdTema`) as modulo
 
  from modulos m
  inner join `programas_cursos` p on p.IdCurso=m.IdCurso 
 where m.`IdModulo`=$idmodulo";
//echo $consulta;
// 
//where am.`CiAlumno`=5066111  and `alum_aprobado`(am.`IdCurso`,am.`CiAlumno`)='A' 
$result = mysql_query($consulta,$conecta) or die("ERROR de conexion a la base de datos alumnos");
$row = mysql_fetch_array($result);

$ofi=$row['ofi'];
$coordinadora=recuperaFirma($ofi)->coordinadora;
$correocor=recuperaFirma($ofi)->correocor;
//echo $coordinadora;
//echo $correocor;

$mm='<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml"> <head runat="server"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<body style="margin: 0.2em; color: #000000;">
<div style="width: 80%; font-family: Arial, Helvetica, sans-serif; font-size: 1em; padding: 2em;">
<div align="center">
<link rel="stylesheet" type="text/css" href="http://ibnored.ibnorca.org/itranet/lib/lib_css/estilo.css"/>
<img src="http://ibnored.ibnorca.org/itranet/images/ibnlogo150x154.png" width="150" height="154">
</div><br><br>
<span style="font-size: 20px;">NOTAS IBNORCA</span><br><br>
<span>Estimada Coordinadora las notas del grupo '.$_POST['grupo'].' de: </span><br><br>
<span>'.$_POST['especialista'].' </span><br><br>
<span>Módulo: '.$_POST['tema'].' </span><br><br>
Ya se encuentran disponibles en el sistema, haga click en el siguiente botón para enviar correo a los alumnos:<br><br>
<a href="http://ibnored.ibnorca.org/ialumno/gestion/envioalumnos.php?a1='.$_POST['grupo'].'&a2='.$_POST['especialista'].'&a3='.$_POST['tema'].'&a4='.$_POST['mod'].'"><img src="http://ibnored.ibnorca.org/itranet/images/ENVIAR.jpg" width="280" height="154" alt="Enviar"></a> <br><br>

************************************<br>
Este E-Mail es una respuesta automatica favor no responder el mismo.<br>
************************************<br>
</div>
</body>
</html>';

$cor = new Correo();
$enviado[$n] = $cor->enviarCorreo('info@ibnorca.org', 'infoibno2015', 'IBNORED',$correocor,$coordinadora, 'NOTAS IBNORCA', $mm); 
$cor=null;

if ($enviado[$n] == 1) {
	
	 //echo 'mensaje enviado';
	// sleep(15);
	// header('refresh 15;  Location: http://ibnored.ibnorca.org/inscripcion/prueba_css.php'); 
	 
}
else
{ echo 'Error al enviar '.$enviado[$n];
}




//header('Location: Lista_Notas.php?a='.$idmodulo);
 ?>

</body>
</html>