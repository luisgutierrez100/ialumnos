<?php





$grupo=$_GET['a1'];
$especialista=$_GET['a2'];
$tema=$_GET['a3'];
$idmodulo=$_GET['a4'];

/*
echo $grupo;
echo '</br>';
echo $especialista;
echo '</br>';
echo $tema;
echo '</br>';
echo $idmodulo;
echo '</br>';*/



?>
 <div align="center">Las Notas del Grupo <?php echo $grupo; ?> de:</div>
  <div align="center"><?php echo $especialista; ?></div>
   <div align="center">Módulo: <?php echo $tema; ?> </div>
    <div align="center">Estan disponibles, para enviar el correo a todos los alumos hacer click en la imagen.</div>

<form name="correo" method="post" action="correoalumnos.php"> 

  <input type="hidden" name="a1" id="a1" value="<?php echo $grupo; ?>"  />
  <input type="hidden" name="a2" id="a2" value="<?php echo $especialista; ?>"  />
  <input type="hidden" name="a3" id="a3" value="<?php echo $tema; ?>"  />
  <input type="hidden" name="a4" id="a4" value="<?php echo $idmodulo; ?>"  />
  <div align="center"><input type="image" value="Enviar" src="../../../itranet/images/enviaremailibnorca.jpg" align="middle" width="180" height="200" name="enviar" /></div>
  </form>