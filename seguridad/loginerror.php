<?php require_once('../Connections/conecta.php'); ?>
<?php


if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['ci'])) {
  $loginUsername=$_POST['ci'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "../menunav/menunav.php?usr=$loginUsername";
  $MM_redirectLoginFailed = "login.php?a=A";
  $MM_redirecttoReferrer = false;
  mysqli_select_db($database_conecta, $conecta);
  
  $LoginRS__query=sprintf("SELECT CiAlumno, Email FROM alumnos WHERE CiAlumno=%s AND Email=%s",
    GetSQLValueString($loginUsername, "int"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysqli_query($LoginRS__query, $conecta) or die(mysql_error());
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>
<link rel="stylesheet" type="text/css" href="../../itranet/lib/lib_jqgrid/themes/smoothness/jquery-ui.custom.css">
      <link rel="stylesheet" href="../css/style.css">

<body>

 <!-- <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>-->

<table width="60%" border="0" align="center" cellpadding="2" cellspacing="1">
       <tr> <td align="center"><p>AL PARECER SUS DATOS DE IDENTIFICACION NO SON CORRECTOS </p>
         <p>O NO ESTA AUTORIZADO PARA INGRESAR A ESTA AREA</p>
         <p>INTENTE NUEVAMENTE O CONTACTESE CON EL ADMINISTRADOR</p></td></tr>
       <tr> <td align="center"><a href="login.php?a=A"><input type="submit" name="button" id="button" value="..:: Volver a Intentar ::.."></a></td></tr>
       </table>

   

</body>
</html>
