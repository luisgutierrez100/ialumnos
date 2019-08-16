<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cnxibn = "127.0.0.1";
$database_cnxibn = "ibnorca";
$username_cnxibn = "root";
$password_cnxibn = "";
$cnxibn = mysql_pconnect($hostname_cnxibn, $username_cnxibn, $password_cnxibn, true) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_set_charset('utf8');
?>