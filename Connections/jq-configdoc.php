<?php
// ** MySQL settings ** //
//define('DB_NAME', 'northwind');    // The name of the database
//define('DB_HOST', 'localhost');    // 99% chance you won't need to change this value
//header('Content-Type: text/html; charset=utf-8' );
/*$acentos = $db->query("SET NAMES 'utf8'");*/


//mysql_set_charset('utf8');
$hostname_conecta="192.168.10.19";
$database_conecta='dbdocumentos';
$username_conecta = "ingresobd";
$password_conecta = "ingresoibno";
$port="63342";

//if ($_SESSION['MM_Bdatos']==2)
//  {$database_conecta = "ibnorca_act";}
if ($_SESSION['MM_Bdatos']==3)
  {$hostname_conecta="192.168.10.18";;}

define('DB_DSN_DOC','mysql:dbname=' . $database_conecta .
                ';host=' . $hostname_conecta .
                ';port:'.$port.';');
define('DB_USER_DOC', $username_conecta);     // Your MySQL username
define('DB_PASSWORD_DOC', $password_conecta); // ...and password
define('ABSPATH_DOC', 'C:\xampp\htdocs\itranet\lib\lib_jqgrid/');
//mysql_query("SET NAMES 'utf8'");
//array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''); 
//require_once(ABSPATH.'tabs.php');
?>