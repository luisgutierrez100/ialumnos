<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link rel="stylesheet" type="text/css" href="css_responsive.css"/>
</head>
<script>
function sumar()


    {

for (i=1 ; i <= 5 ; i++)
{

        var valor1=verificar("examen"+i);

        var valor2=verificar("asistencia"+i);

        var valor3=verificar("practicas"+i);



        // realizamos la suma de los valores y los ponemos en la casilla del

        // formulario que contiene el total

        document.getElementById("total"+i).value=parseFloat(valor1)+parseFloat(valor2)+parseFloat(valor3);
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

<body>
<form>
<table>

<?php
$i=1;
$n=1;
$j=5; 
for($i=1;$i<=$j;$i++)
{

?>

<tr>
<th>
<label>Nombre</label>
</th>
<th>
<input class="form-control" class="form-control" type="text" name="examen<?php echo $i; ?>" id="examen<?php echo $i; ?>" size="10"   value="" onkeyup="sumar();" />
</th>
<th>
<input type="text" id="asistencia<?php echo $i; ?>" name="asistencia<?php echo $i; ?>" onkeyup="sumar();" required>
</th>
<th>
<input type="text" id="practicas<?php echo $i; ?>" name="practicas<?php echo $i; ?>" onkeyup="sumar();" required>
</th>
<th>
<input type="text" class="form-control" name="total<?php echo $i; ?>" id="total<?php echo $i; ?>" value="" readonly  />

</th>
</tr>
<?php } ?>

</table>

<input type="submit">
</form>

</body>
</html>