<?php
$connect = mysqli_connect("localhost", "root", "", "ibnorca");
if(isset($_POST["id"]))
{
	//echo $_POST["id"];
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE asignacionalumno SET ".$_POST["column_name"]."='".$value."' WHERE IdAsignacionAlumno = '".$_POST["id"]."'";
 //echo $query;
 if(mysqli_query($connect, $query))
 {
  echo 'Datos Actualizados';
 }
}
?>
