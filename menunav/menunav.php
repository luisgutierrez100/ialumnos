<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../itranet/images/intra_ico.ico" rel="shortcut icon" type="image/x-icon" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/stylemenu.css"/>
<link rel="stylesheet" type="text/css" href="../css/style.css"/>
<body>
<?php
if (!isset($_SESSION)) {
  session_start();
}
//echo $_SESSION;




$ci=$_GET['usr'];
$t=$_GET['t'];
//echo $t;

?>
<table width="100%" border="0">
 
  <tr>
    <td width="213" rowspan="2"><!--<img src="../../itranet/images/ibnlogo200x218.png" width="200" height="218" />--></td>
    <?php if($t=="a"){ ?>
    
    <td align="center" height="115"><h2>INTRANET ALUMNOS</h2></td>
    <?php 
	} 
	else
	{
	?>
    <td align="center" height="115"><h2>INTRANET DOCENTES</h2></td>
    <?php 
	}
	?>
  </tr>
    
  <tr>

    <td width="213" align="right"><a href="../seguridad/cierre.php?a=<?php echo $t; ?>">Cerrar Sesión</a>
      <ul id="nav">
 <?php if($t=="a"){ ?>
	<li><a href="#">Notas</a>

	<ul>

	<li><a href="../gestion/Ev_docente/ev_docente.php?ci=<?php echo $ci; ?>" class="" target="contenido">Evaluación Docente</a></li>
    <li><a  href="../gestion/Ev_docente/N_alumno.php?ci=<?php echo $ci; ?>" class="" target="contenido">Ver Notas</a></li>
</ul>
  </li>
    <li><a href="#">Información</a>
    <ul>
      <li><a href="../gestion/Act_Alumno/Act_info.php?ci=<?php echo $ci; ?>" class="" target="contenido">Actualizar</a></li>
    
    
    </ul>
    </li>
    
	<?php }else{ ?>

	
	<li><a href="#">Notas</a>
    <ul>
    <li><a href="../gestion/NotasD/notas_docente.php?ci=<?php echo $ci; ?>" class="" target="contenido">Ingresar Notas</a></li>
    <li><a href="../gestion/Recuperatorio/notas_rec.php?ci=<?php echo $ci; ?>" class="" target="contenido">Ingresar Recuperatorio</a></li>
     <li><a href="../gestion/Historico/H_cursos.php?ci=<?php echo $ci; ?>" class="" target="contenido">Historico de Cursos</a></li>
    
    
    </ul>
    </li>
    <li><a href="#">Seguridad</a>
    <ul>
      <li><a href="../gestion/C_Pass/cambio_password.php?ci=<?php echo $ci; ?>" class="" target="contenido">Cambiar Contraseña</a></li>
    
    
    </ul>
    </li>
    
     <li><a href="#">Satisfacción</a>
    <ul>
      <li><a href="../gestion/Evaluacion/Evaluacion.php?ci=<?php echo $ci; ?>" class="" target="contenido">Satisfacción</a></li>
    
    
    </ul>
    </li>
    <li><a href="#">Información</a>
    <ul>
      <li><a href="../gestion/Act_Docente/Act_infoD.php?ci=<?php echo $ci; ?>" class="" target="contenido">Actualizar</a></li>
    
    
    </ul>
    </li>
    
    
    
    <?php } ?>
 
    
          </td>
    
  </tr>
</table>


      <div class="grid-container contenido"  >
        <div align="center" class="grid-100 contTit">..::Area de Usuario::.. 
        </div>
              <iframe width="100%" height=600px" frameborder="0" name="contenido" scrolling="auto"></iframe>
    
</body>
</html>