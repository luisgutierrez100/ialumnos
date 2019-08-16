<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conecta = "localhost";
$database_conecta = "ibnorca";
if (!isset($_SESSION)) {
  session_start();
}
if (isset($_SESSION['MM_Bdatos'])) {  
  if ($_SESSION['MM_Bdatos']==2)
    {$database_conecta = "ibnorca_act";}
  if ($_SESSION['MM_Bdatos']==3)
    {
	 $hostname_conecta = "localhost";
     $database_conecta = "ibnorca";}

}
$username_conecta = "root";
$password_conecta = "";
$conecta = mysql_pconnect($hostname_conecta, $username_conecta, $password_conecta) or trigger_error(mysql_error(),E_USER_ERROR);



?>