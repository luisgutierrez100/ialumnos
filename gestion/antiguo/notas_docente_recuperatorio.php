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
    
	 
    <script type="text/javascript" language="javascript" class="init">
$(document).ready(function(){
	$('#clasificador').dataTable({
		"sPaginationType":"full_numbers",
		"aaSorting":[[0, "asc"]],
		"columnDefs": [ {
			"targets": [0],
			"orderable": false,
			"searchable": false
			} ],
		"bJQueryUI":true,
		buttons: [
           'excel'
        ],
	});
})
</script>




<?php

if (!isset($_SESSION) ) {
  session_start(); }
  
include_once("../../itranet/Connections/conecta.php");

include_once('../../itranet/lib/lib_gral/funciones_gral.php');
include_once('../../itranet/lib/lib_gral/funciones_seguridad.php');
$conn = $conecta; //mysql_connect($hostname_conecta, $username_conecta, $password_conecta);

$ci=$_GET['ci'];
//echo $ci;

//echo $consulta;
mysql_select_db($database_conecta, $conecta) or die(mysql_error());

$consulta1 = "select CiALumno,Nombre,ApPaterno,ApMaterno from alumnos
				where CiAlumno=".$ci;

//echo $consulta;
$result1 = mysql_query($consulta1, $conecta) or die("ERROR de conexion a la base de datos de alumno");

$row1 = mysql_fetch_array($result1);

$nom=$row1['Nombre'];
//echo $nom;

$ap=$row1['ApPaterno'];
$am=$row1['ApMaterno'];

?>

<div class="container contFondoDatos">
  <div class="row">
    <div class="col-xs-12 contTit">
      <div align="center"><strong>..:: <?php echo $nom.' '.$ap.' '.$am; ?> ::..</strong></div>
    </div>
</div>
 
    <div class="table-responsive">
         
     <table  id="clasificador" class="table table-striped table-bordered" height="80%" width="100%" border="0" cellspacing="0" cellpadding="0">
             <thead>
              <tr>
                <th width="10%">Codigo</th>
                <th width="10%">Inicio</th>
                <th width="10%">Fin</th>
                <th width="10%">Gestión</th>
                <th width="25%">Programa</th>
                <th width="25%">Módulo</th>
                 <th width="10%">Docente</th>
                <th width="10%" style="width: 50px;">Ingresar Nota de Recuperatorio</th>
               </tr>
            </thead>
            <tbody>
               <?php
mysql_select_db($database_conecta, $conecta) or die(mysql_error());
{
$consulta = "select cursos.* from (select m.`FechaInicio`,m.`FechaFin`,m.`IdModulo` as nromod,`f_codModulo`(m.`IdModulo`) as codigo,
`d_clasificador`(p.`IdPrograma`) as programa,
n_docente(m.CiDocente) as docente,m.CiDocente as cidocente,
`d_clasificador`(`id_estadoobjeto`(597,p.`IdCurso`)) as estad,
 `d_clasificador`(p.IdGestion) as gestion,`d_clasificador`(m.`IdTema`) as modulo
  
   from `modulos` m 
   inner join `programas_cursos` p on p.IdCurso=m.IdCurso 
   
   where m.`CiDocente`=$ci) as cursos where estad <>'Emisión de Certificados' and estad <>'Curso Cerrado'";

}
//echo $consulta;
$result = mysql_query($consulta, $conecta) or die("ERROR de conexion a la base de datos de modulos");

$total = mysql_num_rows($result);


while ($row = mysql_fetch_array($result))
{
$ci=$row['cidocente'];
$idmodulo=$row['nromod'];
$programa=$row['programa'];
$gestion=$row['gestion'];
$inicio=$row['FechaInicio'];
$fin=$row['FechaFin'];
//$gestion= $row['gestion'];
//$grupo= $row['Grupo'];
$codigo= $row['codigo'];
$cidocente= $row['cidocente'];
$modulo= $row['modulo'];
$docente= $row['docente'];
//$idc= $row['IdCurso'];
//$estado= $row['estadoob'];
//$responsable= $row['d_responsable'];
//$idoficina= $row['IdOficina'];

?>
                
              <tr>
                <td class="ui-front"><?php echo $codigo; ?></td>
                <td width="1%" class="ui-front"><?php echo $inicio; ?></td>
                <td width="1%" class="ui-front"><?php echo $fin; ?></td>
                <td width="1%" class="ui-front"><?php echo $gestion; ?></td>
                <td class="ui-front"><?php echo html_entity_decode($programa); ?></td>
                <td class="ui-front"><?php echo html_entity_decode($modulo); ?></td>
                <td class="ui-front"><?php echo html_entity_decode($docente); ?></td>
                  <td ><a href="./redireccionamiento_recuperatorio.php?cialumno=<?php echo $ci; ?>&mod=<?php echo $idmodulo; ?>" title="Ingresar Notas"/><center><span style ="font-size:20px;color:#404654;"  class="glyphicon glyphicon-edit"></span></center></a></td>
             <!-- &idmod=<?php echo $idmodulo; ?>&idcur=<?php echo $idc; ?>  -->  
               </tr> 
                
  <?php }?>
                
                

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