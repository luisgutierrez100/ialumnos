<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php

session_start();
session_destroy();

$tipo=$_GET['a'];

if($tipo=="a")
{header("location: ./login.php?a=A");
//echo $tipo;
}
else
{header("location: ./login.php?a=D");
//echo $tipo;
}


?>


</body>
</html>