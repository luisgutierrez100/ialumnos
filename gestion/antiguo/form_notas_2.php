<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestion de Servicios</title>



</head>
<body>
<!-- para la ventna modal -->
<link rel="stylesheet" href="ventanamodal_edsrv.css" />
	<script type='text/javascript' src='ventanamodal_edsrv.js'></script>
<!-- fin para la ventna modal -->
<link rel="stylesheet" type="text/css" href="../../itranet/lib/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="../../itranet/lib/lib_css/DataTables-1.10.11/media/css/dataTables.bootstrap.css"/>

<link rel="stylesheet" type="text/css" href="../css/style.css"/>
<script type="text/javascript" src="../../itranet/lib/lib_js/DataTables-1.10.11/media/js/jquery-1.12.3.js"></script>
<script type="text/javascript" src="../../itranet/lib/lib_js/DataTables-1.10.11/media/js/jquery.dataTables.js"></script>

<script type="text/javascript" src="../../itranet/lib/lib_js/DataTables-1.10.11/media/js/dataTables.bootstrap.js"></script>
    
    <script type="text/javascript" src="../js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="../js/dataTables.editor.min.js"></script>
<script type="text/javascript" src="../js/dataTables.select.min.js"></script>
<script type="text/javascript" src="../js/jquery-1.12.4.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/dataTables.bootstrap.min.js"></script>	 

<?php

if (!isset($_SESSION) ) {
  session_start(); }
  
include_once("../../itranet/Connections/conecta.php");

include_once('../../itranet/lib/lib_gral/funciones_gral.php');
include_once('../../itranet/lib/lib_gral/funciones_seguridad.php');
$conn = $conecta; //mysql_connect($hostname_conecta, $username_conecta, $password_conecta);


 //$ci=$_GET['ci'];
//echo $ci;

//echo $consulta;
mysql_select_db($database_conecta, $conecta) or die(mysql_error());

$consulta1 = "select * from `asignacionalumno` a where a.IdModulo=1228";

//echo $consulta;
$result1 = mysql_query($consulta1, $conecta) or die("ERROR de conexion a la base de datos de alumno");

$row1 = mysql_fetch_array($result1);

//$nom=$row1['Nombre'];
//echo $nom;

//$ap=$row1['ApPaterno'];
//$am=$row1['ApMaterno'];

?>

<div class="container contFondoDatos">
  <div class="row">
    <div class="col-xs-12 contTit">
      <div align="center"><strong>..:: <?php //echo $nom.' '.$ap.' '.$am; ?> ::..</strong></div>
    </div>
</div>
 
    <div class="table-responsive">
         
     <table  id="clasificador" class="table table-striped table-bordered" height="80%" width="100%" border="0" cellspacing="0" cellpadding="0">
             <thead>
              <tr>
                <th width="10%">Codigo</th>
                <th width="10%">CI/DNI</th>
                <th width="10%">Gestión</th>
                <th width="25%">Programa</th>
                <th width="25%">Módulo</th>
                 <th width="10%">Docente</th>
                <th width="10%" style="width: 50px;">Ingresar Notas</th>
               </tr>
            </thead>
            <tbody>
               <?php
			   
mysql_select_db($database_conecta, $conecta) or die(mysql_error());
{
$consulta = "select *,`nota_final`(a.`Nota`,a.`Asistencia`,a.`Practicas`) as nf from `asignacionalumno` a where a.IdModulo=1228";

}
//echo $consulta;
$result = mysql_query($consulta, $conecta) or die("ERROR de conexion a la base de datos de modulos");

$total = mysql_num_rows($result);


while ($row = mysql_fetch_array($result))
{
$ci=$row['CiAlumno'];
//$programa=$row['IdCurso'];
//$gestion=$row['IdModulo'];
//$nota=$row['notaf'];
//$grupo=$row['ApMaterno'];
//$gestion= $row['gestion'];
//$grupo= $row['Grupo'];
//$codigo= $row['codigo'];
//$cidocente= $row['cidocente'];
//$modulo= utf8_decode($row['modulo']);
//$docente= utf8_decode($row['docente']);
//$idc= $row['IdCurso'];
//$estado= $row['estadoob'];
//$responsable= $row['d_responsable'];
//$idoficina= $row['IdOficina'];

?>
                
             <tr>
                <td class="ui-front"><?php //echo $codigo; ?></td>
                <td width="1%" class="ui-front"><?php echo $ci; ?></td>
                <td width="1%" class="ui-front"><?php //echo $gestion; ?></td>
                <td class="ui-front"><?php //echo $programa; ?></td>
                <td class="ui-front"><?php //echo $modulo; ?></td>
                <td class="ui-front"><?php //echo utf8_decode($docente); ?></td>
                  <td ><a href="./form_notas.php?cialumno=<?php echo $ci; ?>&idmod=<?php echo $mod; ?>&idcur=<?php echo $idc; ?>" title="Ingresar Notas"/><center><span style ="font-size:20px;color:#404654;"  class="glyphicon glyphicon-edit"></span></center></a></td>
               
               </tr> 
                
  <?php  }?>
                
                

            </tbody>
          </table>
    
    </div>
 <!-- Ventana Modal -->

<div id='fade' class='overlay' >
     <div id='light' class='modal'>
          <div id='msgcomun'>
             <span class= 'msgdoscomun ' >Cancelar </span>
             <a class='closemodal' href = 'javascript:void(0)' onclick = 'ocultareldiv() '> X </a>
          </div>
         <div id="respuesta"></div>
     </div>
</div>
<!-- fin ventnaa modal-->        
</body>
</html>

 <script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
		
		fetch_data();
		
		
		function fetch_data()
		{
			var datatable = $('#user_data').DataTable({
				"processing" : true,
				"serverside" : true,
				"order" : [],
				"ajax" :{
						url : "fetch.php",
						type : "POST"
						}
						
					
			
			});
		}
	});
	</script>
 
 
 <script type="text/javascript" class="init">
	


var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
	editor = new $.fn.dataTable.Editor( {
		fields: [ {
				label: "First name:",
				name: "first_name"
			}, {
				label: "Last name:",
				name: "last_name"
			}, {
				label: "Position:",
				name: "position"
			}, {
				label: "Office:",
				name: "office"
			}, {
				label: "Extension:",
				name: "extn"
			}, {
				label: "Start date:",
				name: "start_date",
				type: "datetime"
			}, {
				label: "Salary:",
				name: "salary"
			}
		]
	} );

	// Activate an inline edit on click of a table cell
	$('#example').on( 'click', 'tbody td:not(:first-child)', function (e) {
		editor.inline( this );
	} );

	$('#example').DataTable( {
		order: [[ 1, 'asc' ]],
		columns: [
			{
				data: null,
				defaultContent: '',
				className: 'select-checkbox',
				orderable: false
			},
			{ data: "first_name" },
			{ data: "last_name" },
			{ data: "position" },
			{ data: "office" },
			{ data: "start_date" },
			{ data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
		],
		select: {
			style:    'os',
			selector: 'td:first-child'
		},
		buttons: [
			{ extend: "create", editor: editor },
			{ extend: "edit",   editor: editor },
			{ extend: "remove", editor: editor }
		]
	} );
} );



	</script>