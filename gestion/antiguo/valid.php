<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Validación un formulario</title>
<script type="text/javascript">
function valida(f) {
  var ok = true;
  //var msg = "Debes escribir algo en los campos:\n";
 
  if(f.elements["jugador2"]==f.elements["jugador3	"])
  {
	  msg+="Son iguales";
	  ok=false;
	  
  }else
  {
	  msg+="No Son iguales";
	  ok=false;
  }

  if(ok == false)
    alert(msg);
  return ok;
}
</script>
</head>
<body>
<form id="miForm" action="" method="get" onsubmit="return valida(this)">
<p>
Jugador 1: <input type="text" id="jugador1" />
<br />
Jugador 2: <input type="text" id="jugador2" />
<br />
Jugador 3: <input type="text" id="jugador3" />
<br />
<input type="submit" value="Enviar" />
<input type="reset" value="Borrar" />
</p>
</form>
</body>
</html>