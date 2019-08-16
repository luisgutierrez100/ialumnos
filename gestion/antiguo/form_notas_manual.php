
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml"> <head runat="server"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Formulario de Inscripcion</title> 
<!--<link href="StyleSheet.css" rel="stylesheet" /> -->

<link rel="stylesheet" type="text/css" href="../css/css_prueba2.css">
</head>
<body>
<br></br>
<script src="../../itranet/lib/lib_js/jquery-ui-1.12.1/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
<script src="../../../itranet/lib/lib_js/jquery-ui-1.12.1/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>

    <link rel="stylesheet" type="text/css" href="../../../itranet/lib/lib_js/jquery-ui-1.12.1/jquery-ui-1.12.1.custom/jquery-ui.css">
    
  <script src="../../../itranet/lib/lib_js/jquery-ui-1.12.1/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
  
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  </script>
  <SCRIPT LANGUAGE="JavaScript">
    function validar_clave() {
    var caract_invalido = " ";
    var caract_longitud = 6;
    var cla1 = document.form1.Email1.value;
    var cla2 = document.form1.Email2.value;
    if (cla1 == '' || cla2 == '') {
    alert('Debes introducir tu correo en los 2 campos.');
    return false;
    }
   if (document.form1.Email1.value.indexOf(caract_invalido) > -1) {
    alert("Los correos no pueden contener espacios");
    return false;
    }
    else {
    if (cla1 != cla2) {
    alert ("Los correos introducidos no son iguales");
    return false;
    }
    else {
    //alert('Correo correcto');
    return true;
          }
       }
	   
    }
	
    </script>
  <script>
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>
<script>
function validarn(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
	 if (tecla==9) return true; // 3
	 if (tecla==11) return true; // 3
    patron = /[A-Za-z0-9Ã±Ã‘'Ã¡Ã©Ã­Ã³ÃºÃÃ‰ÃÃ“ÃšÃ Ã¨Ã¬Ã²Ã¹Ã€ÃˆÃŒÃ’Ã™Ã¢ÃªÃ®Ã´Ã»Ã‚ÃŠÃŽÃ”Ã›Ã‘Ã±Ã¤Ã«Ã¯Ã¶Ã¼Ã„Ã‹ÃÃ–Ãœ\s\t]/; // 4
 
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 
</script>
<?php

if(isset($_POST['opcion'])){ 
$idofi=$_POST['opcion'];}
else
{
$idofi=0;
	
}
if(isset($_POST['CI'])){ 
$ci=$_POST['CI'];}

 ?>
 <?php
include_once("../../itranet/Connections/conecta.php");
mysql_query("SET NAMES 'utf8'");
define('CHARSET','UTF-8');
header('Content-type: text/html; charset='.CHARSET);


mysql_select_db($database_conecta,$conecta) or die(mysql_error());

$csql2 = "select idclasificador as id,descripcion as descr
		 from clasificador where idpadre=53";
$rs2 = mysql_query($csql2,$conecta) or die("ERROR de conexion a la base de datos");

mysql_select_db($database_conecta,$conecta) or die(mysql_error());
$csql3 = "select idclasificador as id,descripcion as descr
		 from clasificador where idpadre=53";
$rs3 = mysql_query($csql3,$conecta) or die("ERROR de conexion a la base de datos");

mysql_select_db($database_conecta,$conecta) or die(mysql_error());
$csql4 = "select idclasificador as id,descripcion as descr
		 from clasificador where idpadre=54 order by descr";
$rs4 = mysql_query($csql4,$conecta) or die("ERROR de conexion a la base de datos");

mysql_select_db($database_conecta,$conecta) or die(mysql_error());
$csql5 = "select idclasificador as id,descripcion as descr
		 from clasificador where idpadre=53 order by descr";
$rs5 = mysql_query($csql5,$conecta) or die("ERROR de conexion a la base de datos");

mysql_select_db($database_conecta,$conecta) or die(mysql_error());
$csql7 = "select idclasificador as id,descripcion as descr
		 from clasificador where idpadre=225";
$rs7 = mysql_query($csql7,$conecta) or die("ERROR de conexion a la base de datos");

$arr = array("À" => "A","É" => "E","Í" => "I","Ó" => "O","Ú" => "U","ñ" => "Ñ","á" => "a","é" => "e","í" => "i","ó" => "o","ú" => "u"); 


$consulta = "select * from `asignacionalumno` a where a.IdModulo=1228";
//echo $consulta;
// 
//where am.`CiAlumno`=5066111  and `alum_aprobado`(am.`IdCurso`,am.`CiAlumno`)='A' 
$result = mysql_query($consulta,$conecta) or die("ERROR de conexion a la base de datos alumnos");
?>


<form class="contact_form" method="post" action="../form_inscripcion.php" id="contact_form" runat="server"> 
  <div> <ul>
    <li> <h2>Formulario de Notas</h2>
     </li> 
      <table>
      <tr>
      <th>Nombre</th>
            <th>Nota Examen</th>
                  <th>Asistencia</th>
                        <th>Practicas</th>
                         <th>Recuperatorio</th>
                          <th>Nota Final</th>
      </tr>
   <?php
   $n=1;
      while ($row = mysql_fetch_array($result))
{
	
	$cialumno= $row['CiAlumno'];
	?>
 
<tr>
<th>
 <li> <label for="email"><?php echo $cialumno; ?>:</label>
 </th>
 <th width="50"> <input type="text" class="form-control" name="modulo<?php echo $n; ?>" id="modulo<?php echo $n; ?>" value=""  /> 
 </th>
 <th  width="50"> <input type="text" class="form-control" name="modulo<?php echo $n; ?>" id="modulo<?php echo $n; ?>" value=""  /> 
 </th>
 <th width="50"> <input type="text" class="form-control" name="modulo<?php echo $n; ?>" id="modulo<?php echo $n; ?>" value=""  /> 
 </th>
 <th width="50"> <input type="text" class="form-control" name="modulo<?php echo $n; ?>" id="modulo<?php echo $n; ?>" value=""  /> 
 </th>
 <th width="50"> <input type="text" class="form-control" name="modulo<?php echo $n; ?>" id="modulo<?php echo $n; ?>" value=""  /> 
 </th>
 <?php
 $n=$n+1;
  } ?>
 </li> 
 </tr>
 </table>
 <li> <button name="Buscar" class="contTit" type="submit">Buscar Cursos</button>  </li> 
 </ul> 
 </div>
 
</form>





</body>
</html>
  

 
