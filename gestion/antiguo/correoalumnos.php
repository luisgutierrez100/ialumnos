<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>




<?php

$grupo=$_POST['a1'];
$especialista=$_POST['a2'];
$tema=$_POST['a3'];
$idmodulo=$_POST['a4'];

/*echo $grupo;
echo '</br>';
echo $especialista;
echo '</br>';
echo $tema;
echo '</br>';
echo $idmodulo;
echo '</br>';*/
include_once("../../itranet/Connections/conecta.php");
include_once("../../itranet/iCapacitacion/gestion/ImpCertif/utilities.php");



mysql_query("SET NAMES 'utf8'");
define('CHARSET','UTF-8');
header('Content-type: text/html; charset='.CHARSET);


mysql_select_db($database_conecta,$conecta) or die(mysql_error());

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



$consulta = " select al.`Email` as email, concat(al.Nombre,' ',al.ApPaterno,' ',ApMaterno) as nombre from `asignacionalumno` a
    inner join `alumnos` al on al.`CiAlumno`=a.`CiAlumno`
    where a.`IdModulo`=$idmodulo";
//echo $consulta;
// 
//where am.`CiAlumno`=5066111  and `alum_aprobado`(am.`IdCurso`,am.`CiAlumno`)='A' 
$result = mysql_query($consulta,$conecta) or die("ERROR de conexion a la base de datos alumnos");


while ($row = mysql_fetch_array($result))
{
$email=$row['email'];
//echo $email;
//echo 'espacio'.'</br>';
$nombre=$row['nombre'];
//echo $nombre;
//echo 'espacio'.'</br>';



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
<span>Estimado Alumno las notas del grupo '.$_POST['a1'].' de: </span><br><br>
<span>'.$_POST['a2'].' </span><br><br>
<span>Módulo: '.$_POST['a3'].' </span><br><br>
Ya se encuentran disponibles en el sistema, para ver sus notas puede ingresar en nuestra plataforma desde el siguiente botón:<br><br>
<a href="http://ibnored.ibnorca.org/ialumno/seguridad/login.php?a=A"><img src="http://ibnored.ibnorca.org/itranet/images/acceso_alumnos.PNG" width="154" height="154" alt="Enviar"></a><br><br>
************************************<br>
Este E-Mail es una respuesta automatica favor no responder el mismo.<br>
************************************<br>
</div>
</body>
</html>';

$cor = new Correo();
$enviado[$n] = $cor->enviarCorreo('info@ibnorca.org', 'infoibno2015', 'IBNORED',$email, $nombre, 'NOTAS IBNORCA', $mm); 
$cor=null;

if ($enviado[$n] == 1) {
	
	 //echo 'mensaje enviado';
	// sleep(1);
	// header('refresh 15;  Location: http://ibnored.ibnorca.org/inscripcion/prueba_css.php'); 
	 
}
else
{ echo 'Error al enviar '.$enviado[$n];
}
}

?>

<h2 align="center"><img src="../../itranet/images/ibnlogo150x154.png" width="150" height="154"></h2>
     <h2 align="center">Los correos fueron enviados satisfactoriamente</h2>
</body>
</html>