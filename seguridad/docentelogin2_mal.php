

<?php require_once('../Connections/conecta.php'); ?>
<?php


if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysqli_real_escape_string($theValue) : mysql_escape_string($theValue);

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
	$t='d';
  $loginUsername=$_POST['ci'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "../menunav/menunav.php?usr=$loginUsername&t=$t";
  $MM_redirectLoginFailed = "loginerrord.php";
  $MM_redirecttoReferrer = false;
  mysqli_select_db($database_conecta, $conecta);
  
  $LoginRS__query=sprintf("SELECT CiDocente, Password FROM docente WHERE CiDocente=%s AND Password=%s",
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
<link href="../../itranet/images/intra_ico.ico" rel="shortcut icon" type="image/x-icon" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>
<link rel="stylesheet" type="text/css" href="../../itranet/lib/lib_jqgrid/themes/smoothness/jquery-ui.custom.css">
      <link rel="stylesheet" href="../css/style.css">

<body>

 <!-- <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>-->
 
 

<div class="login">
  <div class="login-header">
    <h1><img src="../../itranet/images/ibnlogo200x218.png" width="200" height="218" /></h1>
    <br/>
        <br/>

  </div>
      <h1 align="center">Login</h1>
  <div class="login-form">
    <h3>Número de Carnet de Identidad:</h3>
    <form action="<?php echo $loginFormAction; ?>" method="POST">
    <label for="ci"> </label>
    <input type="text" id="ci" name="ci" placeholder="2335790"/><br>
    <h3>Correo:</h3>
    <label for="correo"> </label>
    <input type="text" id="correo" placeholder="info@ibnorca.org" name="correo"/>
    <br>
    <h3>Password:</h3>
    <label for="password"> </label>
    <input type="password" id="password" placeholder="**********" name="password"/>
    <br>
    <input type="submit" name="submit" value="Ingresar" class="login-button"/>
    
    
    
    
    </form>
    <br>
    
    <br>
   
  </div>
</div>

  
</div>

    
    
    
    
   


    
    

</body>
</html>

