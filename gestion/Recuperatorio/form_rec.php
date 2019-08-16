
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml"> <head runat="server"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Formulario de Inscripcion</title> 
<!--<link href="StyleSheet.css" rel="stylesheet" /> -->

<link rel="stylesheet" type="text/css" href="../../css/css_responsive.css"/>
</head>
<body>

<br></br>
<script language="JavaScript">
function pregunta(){
    if (confirm('¿Estas seguro de enviar las notas?, una vez enviadas no se podrá modificar.')){
       document.formnotas.submit()
    }
}
</script>

  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  </script>
 
  <script>
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){return true;}
	if (tecla==37){return true;}
    if (tecla==39){return true;}
    if (tecla==46){return true;}
    
        
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
<script>
function sumar()


    {
var n=document.getElementById("nf").value;

for (i=1 ; i <= n ; i++)
{
        var valor1=verificar("recuperatorio"+i);

       // realizamos la suma de los valores y los ponemos en la casilla del

        // formulario que contiene el total

        document.getElementById("total"+i).value=parseFloat(valor1);
		}

    }

    /**

     * Funcion para verificar los valores de los cuadros de texto. Si no es un

     * valor numerico, cambia de color el borde del cuadro de texto

     */

    function verificar(id)

    {

        var obj=document.getElementById(id);

        if(obj.value=="")

            value="0";

        else

            value=obj.value;

        if(validate_importe(value,1))

        {

            // marcamos como erroneo

            obj.style.borderColor="#808080";

            return value;

        }else{

            // marcamos como erroneo

            obj.style.borderColor="#f00";

            return 0;

        }

    }

 

    /**

     * Funcion para validar el importe

     * Tiene que recibir:

     *  El valor del importe (Ej. document.formName.operator)

     *  Determina si permite o no decimales [1-si|0-no]

     * Devuelve:

     *  true-Todo correcto

     *  false-Incorrecto

     */

    function validate_importe(value,decimal)

    {

        if(decimal==undefined)

            decimal=0;

 

        if(decimal==1)

        {

            // Permite decimales tanto por . como por ,

            var patron=new RegExp("^[0-9]+((,|\.)[0-9]{1,2})?$");

        }else{

            // Numero entero normal

            var patron=new RegExp("^([0-9])*$")

        }

 

        if(value && value.search(patron)==0)

        {

            return true;

        }

        return false;

    }
</script>
<?php

$idmodulo=$_GET['mod'];

 ?>
 <?php
if (!isset($_SESSION) ) {
  session_start(); }
  
include_once("../../../itranet/Connections/conecta.php");


$conn = mysqli_connect($hostname_conecta, $username_conecta, $password_conecta);
mysqli_select_db($conn,$database_conecta) or die("cannot select DB");

$consulta = "select * from(
select *,`n_alumno`(aa.`CiAlumno`) as nalumno,
aprobado(aa.`IdAsignacionAlumno`) as aprob,
`nota_final`(aa.`Nota`,aa.`Asistencia`,aa.`Practicas`) as rec 
from `asignacionalumno` aa 
where `aa`.`IdModulo`=$idmodulo) xx
where xx.aprob='Reprobado'";


//echo $consulta;
// 
//where am.`CiAlumno`=5066111  and `alum_aprobado`(am.`IdCurso`,am.`CiAlumno`)='A' 
$result=mysqli_query($conn,$consulta) or die(mysqli_error()) ;

?>


<form name=formnotas class="contact_form" method="post" action="recepcion_notas_recuperatorio.php" id="contact_form" runat="server"> 
  
     <h2>Formulario de Notas de Recuperatorio</h2>
     
      <table width="100%">
      <tr>
      <th>Nro.</th>
      <th>Nombre</th>
            <th>Recuperatorio</th>
                 
                        
                          <th>Nota Final</th>
      </tr>
   <?php
   $n=1;
      while ($row = mysqli_fetch_array($result))
{
	
		$cialumno=utf8_encode($row['nalumno']);
	$cialumno= (strtoupper($cialumno)); 
	$array2=array("á" => "A","é" => "E","í" => "I","ó" => "O",'ñ'=>'Ñ',"ú" => "U","ü"=>"Ü");
$cialumno=strtr(($cialumno),$array2); 
	$ci= $row['CiAlumno'];
	?>
 
<tr>
<th width="5%">
 <label for="nro"><?php echo $n; ?></label>
  
 </th>
<th width="20%">
 <label for="email"><?php echo $cialumno; ?>:</label>
  
 </th>
 <th > <input align="middle" type="number" min="0" max="71" class="form-control" name="recuperatorio<?php echo $n; ?>" id="recuperatorio<?php echo $n; ?>" value="" onkeyup="sumar();" onKeyPress="return valida(event);"   /> 
 </th>


 <th > <input align="middle" type="text" class="form-control" name="total<?php echo $n; ?>" id="total<?php echo $n; ?>" value="" readonly  /> 
 <input type="hidden" name="ci<?php echo $n; ?>" id="ci<?php echo $n; ?>" value="<?php echo $ci; ?>"  />
  </th>
 <?php
 $n=$n+1;
  } ?>
 
 </tr>
 </table>
 <input type="hidden" name="nf" id="nf" value="<?php echo $n; ?>"  />
 <input type="hidden" name="mod" id="mod" value="<?php echo $idmodulo; ?>"  />
 <input name="Buscar" value="Enviar Notas" class="contTit" type="submit"/>
 
 

</form>





</body>
</html>
  

 
