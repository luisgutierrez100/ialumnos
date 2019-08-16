<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<link rel="stylesheet" type="text/css" href="../../css/css_prueba.css">

<script language="JavaScript">
function pregunta(){
    if (confirm('¿Esta seguro de enviar la información de satisfacción?')){
       document.formnotas.submit()
    }
}
</script>

<!--<link rel="stylesheet" type="text/css" href="../css/tablas.css"/>-->
<script>
  $( function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  </script>
  
<script>
    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
</script>
  
 
 
<body>

<?php


$cialum=$_GET['cialumno'];
//echo $cialum.'</br>';
$mod=$_GET['idmod'];
//echo $mod.'</br>';
$curso=$_GET['idcur'];
//echo $curso.'</br>';
//echo $cidocente;

?>

<form name="satisfaccion" method="post" action="recepcion.php" >

  <h2>FORMULARIO DE SATISFACCIÓN</h2>

<h3>1. CONTENIDO Y DOCUMENTACIÓN</h3>
<table>
<tr>
   <td width="125">
 
    </td>
     <td width="69" class="centrar">
       <p>
         <label for="Sat1">Nada Satisfecho</label>  
       </p>
     </td>
     <td width="88" class="centrar">
       <p>
         <label for="Sat2">Poco Satisfecho</label>
       </p>
      
     </td>
     <td width="77" class="centrar">
       <label for="Sat3">       Normal<br />
        
       </label>
    
     </td>
     <td width="88" class="centrar">
       <p>
         <label for="Sat4">           Satisfecho</label>
       </p>
      
     </td>
     <td width="91" class="centrar">
       <p>
         <label for="Sat4">Muy Satisfecho</label>
       </p>
    
     </td>
  </tr>
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">a) Contenido teórico del curso</label> 
    
     </td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta11" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta11" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta11" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta11"value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta11" value="1056" required="required" />
       
     </td>
  </tr>
   
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">b) Contenido practico del curso</label> 
    
     </td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta12" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta12" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta12" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta12" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta12" value="1056" required="required" />
       
     </td>
  </tr>
   
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">c) Cumplimiento del contenido programático</label> 
    
     </td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta13" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta13" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta13" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta13" value="1055"  required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta13" value="1056" required="required" />
       
     </td>
  </tr>
   
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">d) Material complementario</label></td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta14" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta14"  value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta14" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta14" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta14" value="1056" required="required" />
       
     </td>
  </tr>
   
      
</table>
<h3>2. EXPOSITOR</h3>
<table>
<tr>
   <td width="125">
 
    </td>
     <td width="69" class="centrar">
       <p>
         <label for="Sat1">Nada Satisfecho</label>  
       </p>
     </td>
     <td width="88" class="centrar">
       <p>
         <label for="Sat2">Poco Satisfecho</label>
       </p>
      
     </td>
     <td width="77" class="centrar">
       <label for="Sat3">       Normal<br />
        
       </label>
    
     </td>
     <td width="88" class="centrar">
       <p>
         <label for="Sat4">           Satisfecho</label>
       </p>
      
     </td>
     <td width="91" class="centrar">
       <p>
         <label for="Sat4">Muy Satisfecho</label>
       </p>
    
     </td>
  </tr>
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">a) Dominio del tema y experiencia</label> 
    
     </td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta21" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta21" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta21" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta21" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta21" value="1056" required="required" />
       
     </td>
  </tr>
   
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">b) Preparación previa del instructor</label> 
    
     </td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta22" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta22" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta22" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta22" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta22" value="1056" required="required" />
       
     </td>
  </tr>
   
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">c) Comunicación del tema</label> 
    
     </td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta23" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta23" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta23" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta23" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta23" value="1056" required="required" />
       
     </td>
  </tr>
   
  <tr>
   <td width="400" height="50">

   <label for="pregunta1">d) Método de impartir el seminario</label></td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta24" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta24" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta24" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta24" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta24" value="1056" required="required" />
       
     </td>
  </tr>
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">e) Atención a consultas y resolución de controversias</label></td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta25" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta25" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta25" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta25" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta25" value="1056" required="required" />
       
     </td>
  </tr>
   
      
</table>
<h3>3. ORGANIZACIÓN Y LOGÍSTICA</h3>
<table>
<tr>
   <td width="125">
 
    </td>
     <td width="69" class="centrar">
       <p>
         <label for="Sat1">Nada Satisfecho</label>  
       </p>
     </td>
     <td width="88" class="centrar">
       <p>
         <label for="Sat2">Poco Satisfecho</label>
       </p>
      
     </td>
     <td width="77" class="centrar">
       <label for="Sat3">       Normal<br />
        
       </label>
    
     </td>
     <td width="88" class="centrar">
       <p>
         <label for="Sat4">           Satisfecho</label>
       </p>
      
     </td>
     <td width="91" class="centrar">
       <p>
         <label for="Sat4">Muy Satisfecho</label>
       </p>
    
     </td>
  </tr>
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">a) Comodidad de los ambientes</label> 
    
     </td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta31" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta31" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta31" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta31" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta31" value="1056" required="required" />
       
     </td>
  </tr>
   
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">b) Equipos adecuados</label> 
    
     </td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta32" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta32" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta32" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta32" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta32" value="1056" required="required" />
       
     </td>
  </tr>
   
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">c) Nivel del material de enseñanza</label> 
    
     </td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta33" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta33" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta33" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta33" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta33" value="1056" required="required" />
       
     </td>
  </tr>
   
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">d) Nivel del material audiovisual utilizado</label></td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta34" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta34" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta34" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta34" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta34" value="1056" required="required" />
       
     </td>
  </tr>
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">e) Cumplimiento de los horarios preestablecidos</label></td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta35" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta35" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta35" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta35" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta35" value="1056" required="required" />
       
     </td>
  </tr>
  <tr>
   <td width="400" height="50">

   <label for="pregunta1">f) Duración del curso</label></td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta36" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta36" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta36" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta36" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta36" value="1056" required="required" />
       
     </td>
  </tr>
  <tr>
   <td width="400" height="50">

   <label for="pregunta1">g) Información y atención oportuna a consultas</label></td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta37" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta37" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta37" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta37" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta37" value="1056" required="required" />
       
     </td>
  </tr>
   
      
</table>
<h3>4. ASPECTOS GENERALES</h3>
<table>
<tr>
   <td width="125">
 
    </td>
     <td width="69" class="centrar">
       <p>
         <label for="Sat1">Nada Satisfecho</label>  
       </p>
     </td>
     <td width="88" class="centrar">
       <p>
         <label for="Sat2">Poco Satisfecho</label>
       </p>
      
     </td>
     <td width="77" class="centrar">
       <label for="Sat3">       Normal<br />
        
       </label>
    
     </td>
     <td width="88" class="centrar">
       <p>
         <label for="Sat4">           Satisfecho</label>
       </p>
      
     </td>
     <td width="91" class="centrar">
       <p>
         <label for="Sat4">Muy Satisfecho</label>
       </p>
    
     </td>
  </tr>
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">a) Cumplimiento de expectativas</label> 
    
     </td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta41" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta41" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta41" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta41" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta41" value="1056" required="required" />
       
     </td>
  </tr>
   
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">b) Aplicabilidad del curso</label> 
    
     </td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta42" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta42" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta42" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta42" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta42" value="1056" required="required" />
       
     </td>
  </tr>
   
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">c) Comprensiòn general del curso</label> 
    
     </td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta43" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta43" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta43" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta43" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta43" value="1056" required="required" />
       
     </td>
  </tr>
   
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">d) Cual es su grado de satisfacción respecto al curso</label></td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta44" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta44" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta44" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta44" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta44" value="1056" required="required" />
       
     </td>
  </tr>
   <tr>
   <td width="400" height="50">

   <label for="pregunta1">e) Califique al curso a nivel general</label></td>
     <td width="69" class="centrar">
      
         <input type="radio" name="Pregunta45" value="1052" required />
      
     </td>
     <td width="88" class="centrar">
       
         <input type="radio" name="Pregunta45" value="1053" required="required" />
      
     </td>
     <td width="77" class="centrar">
     
      <input type="radio" name="Pregunta45" value="1054" required="required" />
     </td>
     <td width="88" class="centrar">
      
         <input type="radio" name="Pregunta45" value="1055" required="required" />
      
     </td>
     <td width="91" class="centrar">
      
         <input type="radio" name="Pregunta45" value="1056" required="required" />
       
     </td>
  </tr>
          
</table>
<h3>5. Sugiera 3 cursos o temas de su interés, que desearía que IBNORCA Desarrolle:</h3>
<table>
<tr>
    
   <td width="742" height="50">
   <textarea  name="preg5" cols="121" rows="3" onkeypress="return soloLetras(event)"></textarea>
   </td>
     
   </tr>
   </table>
   <h3>6. Tiene usted algún reclamo o sugerencia, para nuestra mejora:</h3>
<table>
<tr>
    
   <td width="742" height="50">
   <textarea name="preg6" cols="121" rows="3" onkeypress="return soloLetras(event)"></textarea>
   </td>
     
   </tr>
   </table>
   
    <input type="text" hidden="true" name="cialumno" value="<?php echo $cialum; ?>"  />
    <input type="text" hidden="true" name="idmod" value="<?php echo $mod; ?>"  />
    <input type="text" hidden="true" name="idcur" value="<?php echo $curso; ?>"  />
<input type="submit" onClick="return confirm('¿Esta seguro de enviar la información de satisfacción?.');" value="Continuar" name Continuar />

</form>

</body>
</html>