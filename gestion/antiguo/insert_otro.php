<?php require_once('../Connections/conecta.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO alumnos (CiAlumno, Nombre, ApPaterno, ApMaterno, IdProfesion, FechaNacimiento, IdCiudadResidencia, Direccion, FonoDomicilio, FonoCelu, Email, NombreEmpresa, CargoEmpresa, FonoEmpresa, PaginaWebEmpresa, RazonSocial, Nit, IDUsrModifica, IDUsrCrea, irTipo) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['CiAlumno'], "int"),
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['ApPaterno'], "text"),
                       GetSQLValueString($_POST['ApMaterno'], "text"),
                       GetSQLValueString($_POST['IdProfesion'], "int"),
                       GetSQLValueString($_POST['FechaNacimiento'], "date"),
                       GetSQLValueString($_POST['IdCiudadResidencia'], "int"),
                       GetSQLValueString($_POST['Direccion'], "text"),
                       GetSQLValueString($_POST['FonoDomicilio'], "int"),
                       GetSQLValueString($_POST['FonoCelu'], "int"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['NombreEmpresa'], "text"),
                       GetSQLValueString($_POST['CargoEmpresa'], "text"),
                       GetSQLValueString($_POST['FonoEmpresa'], "int"),
                       GetSQLValueString($_POST['PaginaWebEmpresa'], "text"),
                       GetSQLValueString($_POST['RazonSocial'], "text"),
                       GetSQLValueString($_POST['Nit'], "double"),
                       GetSQLValueString($_POST['IDUsrModifica'], "int"),
                       GetSQLValueString($_POST['IDUsrCrea'], "int"),
                       GetSQLValueString($_POST['irTipo'], "text"));

  mysql_select_db($database_conecta, $conecta);
  $Result1 = mysql_query($insertSQL, $conecta) or die(mysql_error());

  $insertGoTo = "../index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">CiAlumno:</td>
      <td><input type="text" name="CiAlumno" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nombre:</td>
      <td><input type="text" name="Nombre" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">ApPaterno:</td>
      <td><input type="text" name="ApPaterno" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">ApMaterno:</td>
      <td><input type="text" name="ApMaterno" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">IdProfesion:</td>
      <td><input type="text" name="IdProfesion" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">FechaNacimiento:</td>
      <td><input type="text" name="FechaNacimiento" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">IdCiudadResidencia:</td>
      <td><input type="text" name="IdCiudadResidencia" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Direccion:</td>
      <td><input type="text" name="Direccion" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">FonoDomicilio:</td>
      <td><input type="text" name="FonoDomicilio" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">FonoCelu:</td>
      <td><input type="text" name="FonoCelu" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Email:</td>
      <td><input type="text" name="Email" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">NombreEmpresa:</td>
      <td><input type="text" name="NombreEmpresa" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">CargoEmpresa:</td>
      <td><input type="text" name="CargoEmpresa" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">FonoEmpresa:</td>
      <td><input type="text" name="FonoEmpresa" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">PaginaWebEmpresa:</td>
      <td><input type="text" name="PaginaWebEmpresa" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">RazonSocial:</td>
      <td><input type="text" name="RazonSocial" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nit:</td>
      <td><input type="text" name="Nit" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">IDUsrModifica:</td>
      <td><input type="text" name="IDUsrModifica" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">IDUsrCrea:</td>
      <td><input type="text" name="IDUsrCrea" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">IrTipo:</td>
      <td><input type="text" name="irTipo" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insertar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
