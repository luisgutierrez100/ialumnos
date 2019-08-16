<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestion de Servicios</title>



</head>
<body>

<link rel="stylesheet" type="text/css" href="../../../itranet/lib/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="../../../itranet/lib/lib_css/DataTables-1.10.11/media/css/dataTables.bootstrap.css"/>

<link rel="stylesheet" type="text/css" href="../../css/style.css"/>
<script type="text/javascript" src="../../../itranet/lib/lib_js/DataTables-1.10.11/media/js/jquery-1.12.3.js"></script>
<script type="text/javascript" src="../../../itranet/lib/lib_js/DataTables-1.10.11/media/js/jquery.dataTables.js"></script>

<script type="text/javascript" src="../../../itranet/lib/lib_js/DataTables-1.10.11/media/js/dataTables.bootstrap.js"></script>
    
	 
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
  
include_once("../../../itranet/Connections/conecta.php");
include_once('../../../itranet/lib/lib_gral/funciones_gral.php');
include_once('../../../itranet/lib/lib_gral/funciones_seguridad.php');

//$conn = $conecta; //mysql_connect($hostname_conecta, $username_conecta, $password_conecta);
//echo 'llege';
$conn = mysqli_connect($hostname_conecta, $username_conecta, $password_conecta);
mysqli_select_db($conn,$database_conecta) or die("cannot select DB");
$ci=$_GET['ci'];
$cia=$ci;
/*$usr=$_SESSION["idUsuario"];
echo $usr;*/

//echo $consulta;

$consulta1 = "select CiAlumno,Nombre,ApPaterno,ApMaterno from alumnos
				where CiAlumno=".$ci;

//echo $consulta;
$rs=mysqli_query($conn,$consulta1) or die(mysqli_error()) ;
      	$row1=mysqli_fetch_array($rs);
	

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
                <th width="10%" style="width: 50px;">Ingresar Notas</th>
               </tr>
            </thead>
            <tbody>
               <?php


$consulta = "select *,`f_codModulo`(a.`IdModulo`) as codigo,`d_clasificador`(p.`IdPrograma`) as programa,n_docente(m.CiDocente) as docente,m.CiDocente as cidocente,
`d_clasificador`(p.IdGestion) as gestion,`d_clasificador`(m.`IdTema`) as modulo 
from `asignacionalumno` a
inner join `programas_cursos` p on a.IdCurso=p.IdCurso
inner join `modulos` m on a.IdModulo=m.Idmodulo
where a.`CiAlumno`=".$ci." and a.`IdModulo` not in (select r.`IdModulo` from `respuestassatisfaccion` r where r.`IdModulo`=a.IdModulo and r.`CiAlumno`=a.`CiAlumno`  )
and ((YEAR(m.`FechaFin`))=2018 or YEAR(m.`FechaFin`)=2019) 
     and now()>= ADDDATE(m.`FechaFin`, interval 1  DAY)";


//echo $consulta;
$rs=mysqli_query($conn,$consulta) or die(mysqli_error()) ;
     
$total = mysqli_num_rows($rs);


while ($row = mysqli_fetch_array($rs))
{
$ci=$row['CiDocente'];
$idmodulo=$row['IdModulo'];
$programa=$row['programa'];
$gestion=$row['gestion'];
$inicio=$row['FechaInicio'];
$fin=$row['FechaFin'];
//$gestion= $row['gestion'];
//$grupo= $row['Grupo'];
$codigo= $row['codigo'];
$cidocente= $row['cidocente'];
$modulo= $row['modulo'];
$docente=$row['docente'];
$mod= $row['IdModulo'];
$idc= $row['IdCurso'];
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
                <td class="ui-front"><?php echo utf8_encode($programa); ?></td>
                <td class="ui-front"><?php echo utf8_encode($modulo); ?></td>
                <td class="ui-front"><?php echo utf8_encode($docente); ?></td>
                  <td ><a href="./form_evaluacion.php?cialumno=<?php echo $cia; ?>&idmod=<?php echo $mod; ?>&idcur=<?php echo $idc; ?>" title="Calificar Docente"/><center><span style ="font-size:20px;color:#404654;"  class="glyphicon glyphicon-edit"></span></center></a></td>
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