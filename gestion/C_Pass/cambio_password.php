<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cambiar Contraseña</title>
<link rel="stylesheet" type="text/css" href="../../../itranet/lib/lib_jqgrid/themes/smoothness/jquery-ui.custom.css">
      <link rel="stylesheet" href="../../css/style.css">
    
      <script src="../../../itranet/lib/lib_js/jquery-ui-1.12.1/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
      
    <link rel="stylesheet" type="text/css" href="../../../itranet/lib/lib_js/jquery-ui-1.12.1/jquery-ui-1.12.1.custom/jquery-ui.css">
    <style type="text/css">
    .login-form form #ci {
	text-align: left;
}
    </style>
  <script src="../../../itranet/lib/lib_js/jquery-ui-1.12.1/jquery-ui-1.12.1.custom/jquery-ui.js"></script>

</head>

<body>
<br />
<br />
<SCRIPT LANGUAGE="JavaScript">
    function validar_clave() {
    var caract_invalido = " ";
    var caract_longitud = 6;
    var cla1 = document.form1.nuevopassword1.value;
    var cla2 = document.form1.nuevopassword2.value;
	var cla3 = document.form1.passwordactual1.value;
    var cla4 = document.form1.passwordactual2.value;
    
	if (cla3 == '' || cla4 == '') {
    alert('Debes introducir la contraseña.');
    return false;
    }
   if (document.form1.passwordactual1.value.indexOf(caract_invalido) > -1) {
    alert("La contraseñas no pueden contener espacios");
    return false;
    }
    if (cla3 != cla4) {
    alert ("La contraseña no coincide con la actual.");
    return false;
    }
    else {
    //alert('Correo correcto');
	if (cla1 == '' || cla2 == '') {
    alert('Debes introducir la contraseña 2 veces.');
    return false;
    }
   if (document.form1.nuevopassword1.value.indexOf(caract_invalido) > -1) {
    alert("Las contraseñas no pueden contener espacios");
    return false;
    }
    else {
    if (cla1 != cla2) {
    alert ("Los contraseñas introducidas no son iguales");
    return false;
    }else
	{
		return true;
     }
       }
	}
    }
	
    </script>
   
    
<?php

$ci=$_GET['ci'];
//echo $ci;
//echo $idmodulo;


if (!isset($_SESSION) ) {
  session_start(); }
  
include_once("../../../itranet/Connections/conecta.php");


$conn = mysqli_connect($hostname_conecta, $username_conecta, $password_conecta);
mysqli_select_db($conn,$database_conecta) or die("cannot select DB");


$consulta = "select d.`Password` as pass from `docente` d
where d.`CiDocente`=$ci";

// 
//where am.`CiAlumno`=5066111  and `alum_aprobado`(am.`IdCurso`,am.`CiAlumno`)='A' 
$rs=mysqli_query($conn,$consulta) or die(mysqli_error()) ;
      	$row=mysqli_fetch_array($rs);
		

$pass=$row['pass'];

?>

 <h1 align="center">Cambiar Contraseña</h1>
  <div class="login-form">	
    <h3 align="center">Contraseña Actual:</h3>
    <form name="form1" action="cambio_update.php" method="POST" onSubmit="return validar_clave()">
        <input type="password" id="passwordactual1" name="passwordactual1" placeholder="*******"/><br>
        <input hidden="true" type="password" id="passwordactual2" name="passwordactual2" value="<?php echo $pass; ?>" placeholder="*******"/><br>
    <h3  align="center">Nueva Contraseña:</h3>
    <input type="password" name="nuevopassword1" id="nuevopassword1" placeholder="*******" value="" />
    <h3  align="center">Repetir Nueva Contraseña:</h3>
    <input type="password" id="nuevopassword2" placeholder="******" name="nuevopassword2"/>
    <br>
    <br /><input type="hidden" name="ci" id="ci" value="<?php echo $ci; ?>"  />
    <input type="submit" name="submit" value="Cambiar" class="login-button"/>
    
    
    
    
    </form>
    <br>
    
    <br>
   
  </div>
</body>
</html>