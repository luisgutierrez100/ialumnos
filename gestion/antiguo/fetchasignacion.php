<?php
//fetch.php
//include_once("../../itranet/Connections/conecta.php");

//mysql_select_db($database_conecta, $conecta) or die(mysql_error());

//$connect=$conecta;
$connect = mysqli_connect("localhost", "root", "", "ibnorca");
$columns = array('Nota', 'Practicas','Asistencia','Recuperatorio1');

$query = " select *,`n_alumno`(a.`CiAlumno`) as nalumno
from `asignacionalumno` a ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE (Nota LIKE "%'.$_POST["search"]["value"].'%" 
 OR Practicas LIKE "%'.$_POST["search"]["value"].'%" 
 OR Asistencia LIKE "%'.$_POST["search"]["value"].'%"
 OR Recuperatorio1 LIKE "%'.$_POST["search"]["value"].'%"

  ) and a.IdModulo=1228 ';
}
else
{
$query .='where a.IdModulo=1228 ';	
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY IdAsignacionAlumno DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

//echo $query.' '.$query1;

$data = array();

while($row = mysqli_fetch_array($result))
{
	
	
 $sub_array = array();
 

 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["IdAsignacionAlumno"].'" data-column="Nota">' . $row["Nota"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["IdAsignacionAlumno"].'" data-column="Practicas">' . $row["Practicas"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["IdAsignacionAlumno"].'" data-column="Asistencia">' . $row["Asistencia"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["IdAsignacionAlumno"].'" data-column="Recuperatorio1">' . $row["Recuperatorio1"] . '</div>';
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["IdAsignacionAlumno"].'">' . $row["Nota"] . '</button>';
 $data[] = $sub_array;
 //$id=$row['id'];
 //echo $id;
}

function get_all_data($connect)
{
 $query = " select *, `n_alumno`(a.`CiAlumno`) as nalumno
from `asignacionalumno` a where a.IdModulo=1228 ";
 
 $result = mysqli_query($connect, $query);
 
 return mysqli_num_rows($result);
 
}
//echo $result;
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>