<?php
//fetch.php
//include_once("../../itranet/Connections/conecta.php");

//mysql_select_db($database_conecta, $conecta) or die(mysql_error());

//$connect=$conecta;
$connect = mysqli_connect("localhost", "root", "", "ibnorca");
$columns = array('first_name', 'last_name');

$query = "SELECT * FROM user ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE first_name LIKE "%'.$_POST["search"]["value"].'%" 
 OR last_name LIKE "%'.$_POST["search"]["value"].'%" or Id=8 ';
}
else
{
$query .='where Id=8 ';	
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}

$query1 = '';

/*if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}*/

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);
//echo $query.$query1;

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="first_name">' . $row["first_name"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="last_name">' . $row["last_name"] . '</div>';
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
 $data[] = $sub_array;
 $id=$row['id'];
 //echo $id;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM user";
 
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