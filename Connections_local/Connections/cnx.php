<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cnx = "localhost";
$database_cnx = "ibnored_db";
$username_cnx = "root";
$password_cnx = "";
$cnx = mysql_pconnect($hostname_cnx, $username_cnx, $password_cnx) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_set_charset('utf8');
?>