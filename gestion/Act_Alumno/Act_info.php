
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml"> <head runat="server"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Formulario de Inscripcion</title> 
<!--<link href="StyleSheet.css" rel="stylesheet" /> -->
<link rel="stylesheet" type="text/css" href="../../../itranet/lib/lib_css/estilo.css"/>
</head><link rel="stylesheet" type="text/css" href="../../css/css_prueba.css">
<body bgcolor="#D6D6D6">

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
include_once("../../../itranet/Connections/conecta.php");
include_once("../../../itranet/iCapacitacion/gestion/ImpCertif/utilities.php");

$conn = mysqli_connect($hostname_conecta, $username_conecta, $password_conecta);
mysqli_select_db($conn,$database_conecta) or die("cannot select DB");


 



$csql2 = "select idclasificador as id,descripcion as descr
		 from clasificador where idpadre=53";
$rs2=mysqli_query($conn,$csql2) or die(mysqli_error()) ;



$csql3 = "select idclasificador as id,descripcion as descr
		 from clasificador where idpadre=53";
$rs3=mysqli_query($conn,$csql3) or die(mysqli_error()) ;


$csql4 = "select idclasificador as id,descripcion as descr
		 from clasificador where idpadre=54 order by descr";
		 $rs4=mysqli_query($conn,$csql4) or die(mysqli_error()) ;

$csql5 = "select idclasificador as id,descripcion as descr
		 from clasificador where idpadre=53 order by descr";
		 $rs5=mysqli_query($conn,$csql5) or die(mysqli_error()) ;

$csql7 = "select idclasificador as id,descripcion as descr
		 from clasificador where idpadre=225";
		 $rs7=mysqli_query($conn,$csql7) or die(mysqli_error()) ;


$arr = array("À" => "A","É" => "E","Í" => "I","Ó" => "O","Ú" => "U","ñ" => "Ñ","á" => "a","é" => "e","í" => "i","ó" => "o","ú" => "u"); 




// echo $idofi;
//echo '</br>';


$ci=$_GET['ci'];

// echo $ci;
$csql6 = "select *, `d_clasificador`(a.IdProfesion) as profesion,
`d_clasificador`(a.IdCiudadResidencia) as cresidencia 
from ibnorca.alumnos a where a.CiAlumno=$ci";
 $cabe=mysqli_query($conn,$csql6) or die(mysqli_error()) ;
 $row6=mysqli_fetch_array($cabe);
 

$nombre=$row6['Nombre'];
$paterno=$row6['ApPaterno'];
$materno=$row6['ApMaterno'];
$profesion=$row6['profesion'];
$fnacimiento=$row6['FechaNacimiento'];
$idcresidencia=$row6['IdCiudadResidencia'];
$idprofesion=$row6['IdProfesion'];
$residencia=$row6['cresidencia'];
$idresidencia=$row6['IdCiudadResidencia'];
$direccion=$row6['Direccion'];
$fdomicilio=$row6['FonoDomicilio'];
$celu=$row6['FonoCelu'];
$email=$row6['Email'];
$nombreempresa=$row6['NombreEmpresa'];
$cargoempresa=$row6['CargoEmpresa'];
$fempresa=$row6['FonoEmpresa'];
$pwempresa=$row6['PaginaWebEmpresa'];
$rz=$row6['RazonSocial'];
$nit=$row6['Nit'];



?>


<form class="contact_form" onSubmit="return validar_clave()" action="Inf_rec.php" method="post" name="form1">
 <div>
   <ul>
    <li> <h2>Datos del Alumno</h2>
   <span class="required_notification">* Datos requeridos</span> </li>
          
     <li>
     <label for="nombre">Nombre:<span class="required_notification">*</span></label> <input type="text" name="Nombre" id="Nombre" value="<?php if(isset($row6['Nombre'])){echo $row6['Nombre'];}?>" required />
     </li>
     
     <li>
     <label for="appaterno">Apellido Paterno:<span class="required_notification">*</span></label> <input type="text" name="ApPaterno" id="ApPaterno"  value="<?php if(isset($row6['ApPaterno'])){echo $row6['ApPaterno'];}?>" required /> 
     </li>
     
     <li>
     <label for="apmaterno">Apellido Materno:</label> <input type="text" name="ApMaterno" id="ApMaterno"  value="<?php if(isset($row6['ApMaterno'])){echo $row6['ApMaterno'];}?>" />
     </li>
     
     <li>
     <label for="profesion">Profesión:</label><select name="Profesion">
        <?php
     while($row4 = mysqli_fetch_array($rs4)) { 
	       $tipo=utf8_encode($row4['descr']);
		 //  $tipo=strtr(utf8_decode($tipo),$arr);
			$clasificadortipo=$row4['id'];
	         ?>
        <option  value="<?php echo $clasificadortipo ;?>" <?php if ($clasificadortipo==$idprofesion) { ?> selected="selected" <?php }?> ><?php echo $tipo ;?>  </option>
        <?php
		 }		
		 ?>
      </select>
     </li>
     
     <li>
     <label for="fnacimiento">Fecha de Nacimiento:</label><input type="text" id="datepicker" name="fnacimiento"  value="<?php if(isset($row6['FechaNacimiento'])){echo $row6['FechaNacimiento'];}?>"/>
     </li>
     
     <li>
     <label for="residencia">Ciudad de residencia:<span class="required_notification">*</span></label><select name="Residencia" required >
        <?php
     while($row5 = mysqli_fetch_array($rs5)) { 
	       $tipo=$row5['descr'];
			$clasificadortipo=$row5['id'];
	         ?>
        <option value="<?php echo $clasificadortipo ;?>" <?php if ($clasificadortipo==$idcresidencia) { ?> selected="selected" <?php }?> ><?php echo utf8_decode($tipo) ;?></option>
        <?php } ?>
      </select>
     </li>
     
     <li>
     <label for="direccion" >Dirección:</label><input type="text" class="inputText" name="Direccion" id="Direccion" value="<?php if(isset($row6['Direccion'])){echo $row6['Direccion'];}?>" onkeypress="return validarn(event)" />
     <span class="form_hint">Ej: "Llojeta Calle A Nro 305"</span></li>
     
     <li>
     <label for="fono">Teléfono de Casa:</label> <input type="text" name="TDomicilio" id="TDomicilio" onkeypress="return valida(event)" value="<?php if(isset($row6['FonoDomicilio'])){echo $row6['FonoDomicilio'];}?>" />
     </li>
     
     <li>
     <label for="cel">Nro. de Celular:<span class="required_notification">*</span></label><input type="text" onkeypress="return valida(event)" name="TCel" id="TCel" value="<?php if(isset($row6['FonoCelu'])){echo $row6['FonoCelu'];}?>" required />
     </li>
     
     <li>
     <label for="email">Email:<span class="required_notification">*</span></label><input type="Email1" name="Email1" id="Email1" value="<?php if(isset($row6['Email'])){echo $row6['Email'];}?>" required /> <span class="form_hint">Formato correo: "gonzalo.romero@ibnorca.org"</span>
     </li>
     <li>
     <label for="email">Repetir Email:<span class="required_notification">*</span></label><input type="Email2" name="Email2" id="Email2" value="<?php if(isset($row6['Email2'])){echo $row6['Email2'];}?>" required /> <span class="form_hint">Formato correo: "gonzalo.romero@ibnorca.org"</span>
     </li>
     
     <li>
     <label for="nempresa">Nombre de Empresa:</label><input type="text" name="NEmpresa"  id="NEmpresa" value="<?php if(isset($row6['NombreEmpresa'])){echo $row6['NombreEmpresa'];}?>" />
     </li>
     
     <li>
     <label for="cempresa">Cargo de Empresa:</label> <input type="text" name="CEmpresa" id="CEmpresa"  value="<?php if(isset($row6['CargoEmpresa'])){echo $row6['CargoEmpresa'];}?>" /> 
     </li>
     
     <li>
     <label for="fempresa">Teléfono Empresa:</label><input type="text" name="TEmpresa" id="TEmpresa" onkeypress="return valida(event)" value="<?php if(isset($row6['FonoEmpresa'])){echo $row6['FonoEmpresa'];}?>" />
     </li>
     
     <li>
     <label for="pwempresa">Página Web Empresa:</label><input type="text" name="PEmpresa" id="PEmpresa" value="<?php if(isset($row6['PaginaWebEmpresa'])){echo $row6['PaginaWebEmpresa'];}?>" />
     </li>
     
     <li>
     <label for="rz">Razon Social(Factura):<span class="required_notification">*</span></label><input type="text" name="rz" id="rz" value="<?php if(isset($row6['RazonSocial'])){echo $row6['RazonSocial'];}?>" required /> 
     </li>
     
     <li>
     <label for="nit">Nit(Factura):<span class="required_notification">*</span></label><input type="text" onkeypress="return valida(event)" name="Nit" id="NIT" value="<?php if(isset($row6['Nit'])){echo $row6['Nit'];}?>" required /> 
     </li>
     
    
     
     
     <input hidden="true "type="text" name="ci" id="ci" value="<?php echo $ci; ?>" />
     <input hidden="true "type="text" name="idofi" id="idofi" value="<?php echo $idofi; ?>" />
      <li> <button name="Buscar" class="contTit" type="submit">Enviar</button>  </li> 
   </ul>
 </div>   
  
</form>


<?php
 
 
// }
 ?>

</body>
</html>
  

 
