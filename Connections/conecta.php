<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

function conectabd()
{
	if (!isset($_SESSION)) { session_start();}
	$hostname_conecta = "192.168.10.19";
    $database_conecta = "ibnorca";
	if (isset($_SESSION['MM_Bdatos'])) 
	{  
          if ($_SESSION['MM_Bdatos']==2)
             {$database_conecta = "ibnorca_act";}
          if ($_SESSION['MM_Bdatos']==3)
             {
	           $hostname_conecta = "192.168.10.18";
               $database_conecta = "ibnorca";
			 }
     }
$username_conecta = "ingresobd";
$password_conecta = "ingresoibno";
$conecta = mysqli_connect($hostname_conecta, $username_conecta, $password_conecta) or trigger_error(mysqli_error(),E_USER_ERROR);
return $conecta;
}



$hostname_conecta = "192.168.10.19";
$database_conecta = "ibnorca";
if (!isset($_SESSION)) { session_start();}
if (isset($_SESSION['MM_Bdatos'])) 
{  
 // if ($_SESSION['MM_Bdatos']==2) {$database_conecta = "ibnorca_act";}
  if ($_SESSION['MM_Bdatos']==3)
    {
	 $hostname_conecta = "192.168.10.18";
     $database_conecta = "ibnorca";
	 }
}
$username_conecta = "ingresobd";
$password_conecta = "ingresoibno";
$conecta = mysqli_connect($hostname_conecta, $username_conecta, $password_conecta) or trigger_error(mysqli_error(),E_USER_ERROR);

?>