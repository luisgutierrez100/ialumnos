<?php
/**
 * PHP Grid Component
 *
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org
 * @version 1.4.6
 * @license: see license.txt included in package
 */
if (!isset($_SESSION)) {
  session_start();
}
require_once('../../itranet/Connections/conecta.php');
include_once('../../itranet/lib/lib_gral/funciones_gral.php');

$conn = mysqli_connect($hostname_conecta, $username_conecta, $password_conecta);
mysqli_select_db($conn,$database_conecta) or die("cannot select DB");
if (!isset($_SESSION)) {
  session_start();
}

// include and create object

include_once("../../itranet/lib/lib_jqgrid/php/jqgrid_dist.php");

$usr=$_SESSION["idUsuario"];
/*
//echo $usr;
$csql2="select `d_abrevclasificador`(pa.`IdArea`) as area ,pa.`IdArea` as idarea, po.`IdOficina` as ofi
  from ibnorca.`persona` p
  inner join ibnorca.`personaarea` pa on p.`IdPersona`=pa.`IdPersona`
  inner join ibnorca.`personaoficina` po on p.`IdPersona`=po.`IdPersona`
  where p.`IdPersona`=$usr";
	  //	echo $csql;
	  	$rs=mysqli_query($conn,$csql2) or die(mysqli_error()) ;
      	$dat=mysqli_fetch_array($rs);
	
$area=$dat['area'];
$idarea=$dat['idarea'];
$ofi=$dat['ofi'];

$cond=$_SESSION["MM_condacceso"];
$arrc = array("IdOficina" => "IdCiudad"); 
$cond=strtr($cond,$arrc);*/

//echo $area;
//echo '   '.$idarea;

/*
$puede=false;
if ($_SESSION["abrevrol"]==1)  {
   $puede=true; }*/

$g = new jqgrid();

// set few params
$grid["caption"] = "Seguimiento Alumnos Inscritos";
$grid["multiselect"] = false;
$grid["add_options"] = array('width'=>'950','height'=>480,'dataheight'=>400, 'closeAfterAdd'=>true);
$grid["edit_options"] = array('width'=>'950','height'=>480,'dataheight'=>400, 'closeAfterEdit'=>true);
$grid["autowidth"] = true;
//$grid["autoheight"] = true;
$grid["height"] = 400;
$g->set_options($grid);
$g->set_actions(array(	
					"add"=>false, // allow/disallow add
					"edit"=>false, // allow/disallow edit
					"delete"=>false, // allow/disallow delete
					"rowactions"=>false, // show/hide row wise edit/del/save option
					"export"=>false, // show/hide export to excel option
					"autofilter" => true , // show/hide autofilter for search
					"search" => "advance" // show single/multi field search condition (e.g. simple or advance)
					) 
				);

// set database table for CRUD operations

$g->table = "seguimiento";
/*
if($idarea==13){$cond=$_SESSION["MM_condacceso"];}else{$cond=substr($_SESSION["MM_condacceso"],0,strpos($_SESSION["MM_condacceso"],' and IdArea'));}*/

$g->select_command ="select s.IdComoSeEntero,s.`IdCiudad`,s.CiAlumno,IdSeguimiento,a.`Nombre` as nombre,a.`ApPaterno` as paterno,a.`ApMaterno` as materno, a.Email as email,a.FonoCelu as cel,
`d_clasificador`(s.`IdCiudad`) as ciudad,`d_clasificador`(s.`IdPrograma`) as prog,
`d_clasificador`(s.`IdComoSeEntero`) as enterado
 from seguimiento s
inner join alumnos a on s.`CiAlumno`=a.`CiAlumno`
";
//echo $g->select_command;
/*
select * from (select s.IdComoSeEntero,s.`IdCiudad`,s.CiAlumno,IdSeguimiento,a.`Nombre` as nombre,a.`ApPaterno` as paterno,a.`ApMaterno` as materno, a.Email as email,a.FonoCelu as cel,
`d_clasificador`(s.`IdCiudad`) as ciudad,`d_clasificador`(s.`IdPrograma`) as prog,
`d_clasificador`(s.`IdComoSeEntero`) as enterado
 from seguimiento s
inner join alumnos a on s.`CiAlumno`=a.`CiAlumno`) xx

*/
//select o.*,c.abrev as d_programa  from programas_cursos o
//inner join clasificador c on idoficina=c.idclasificador

//`d_clasificador`(`id_estadoobjeto`(597,p.`IdCurso`)) as estad,

// propiedades de columnas
$col = array();
$col["title"] = "IdSeguimiento"; // caption of column
$col["name"] = "IdSeguimiento"; 
//$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["hidden"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "IdCiudad"; // caption of column
$col["name"] = "IdCiudad"; 
//$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["hidden"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "IdComoSeEntero"; // caption of column
$col["name"] = "IdComoSeEntero"; 
//$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["hidden"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "CiAlumno";
$col["name"] = "CiAlumno";
$col["width"] = "50";
//$col["autofilter"] = true;
$col["editable"] = false;
$col["hidden"]=true;
$cols[] = $col;

$col = array();
$col["title"] = "nombre";
$col["name"] = "nombre";
$col["width"] = "50";
//$col["autofilter"] = true;
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["title"] = "paterno";
$col["name"] = "paterno";
$col["width"] = "30";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["title"] = "materno";
$col["name"] = "materno";
$col["width"] = "30";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["title"] = "ciudad";
$col["name"] = "ciudad";
$col["width"] = "45";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["title"] = "email";
$col["name"] = "email";
$col["width"] = "100";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["title"] = "cel";
$col["name"] = "cel";
$col["width"] = "30";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["title"] = "prog";
$col["name"] = "prog";
$col["width"] = "250";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["title"] = "enterado";
$col["name"] = "enterado";
$col["width"] = "45";
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["title"] = "Confirmar";
$col["name"] = "Confirmar";
$col["width"] = "150";
$col["align"] = "center";
$col["search"] = false;
$col["sortable"] = false;
$buttons_html = "<a  href='../itranet/iCapacitacion/gestion/GesAlumnos/Confirmacion.php?ci={CiAlumno}&ciudad={IdCiudad}' target='contenido3' style='text-decoration:none; white-space:none; border:1px solid gray; padding:2px; position:relative; width:25px; color:red'>Confirmar</a> ";
$col["default"] = $buttons_html;
$cols[] = $col;




# no new line in this html, only space. otherwise it may break ui of grid   target='_blank'
/*$buttons_html = "<a  href='./Modulos_registro.php?idpro={IdCurso}&tipo={IdTipo}&prog={IdPrograma}' target='contenido3' style='text-decoration:none; white-space:none; border:1px solid gray; padding:2px; position:relative; width:25px; color:red'>Modulo</a> <a  href='../../../recursos/RecursosServicios/default.php?idO={IdCurso}&idOf=597' target='contenido3' style='text-decoration:none; white-space:none; border:1px solid gray; padding:2px; position:relative; width:25px; color:red'>Sol. Recursos</a>";
$col["default"] = $buttons_html;
$cols[] = $col;*/


// pass the cooked columns to grid
$g->set_columns($cols);
			
// render grid
$out = $g->render("list1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<link rel="stylesheet" type="text/css" media="screen" href="../../itranet/lib/lib_jqgrid/themes/smoothness/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="../../itranet/lib/lib_jqgrid/jqgrid/css/ui.jqgrid.css"></link>	
	
	<script src="../../itranet/lib/lib_jqgrid/js/jquery.min.js" type="text/javascript"></script>
	<script src="../../itranet/lib/lib_jqgrid/js//i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="../../itranet/lib/lib_jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="../../itranet/lib/lib_jqgrid/js/jquery-ui.custom.min.js" type="text/javascript"></script>
</head>
<body>
	<div style="margin:10px">
	<?php echo $out?>
	</div>
</body>
</html>