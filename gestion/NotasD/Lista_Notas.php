<?php

require('../../../itranet/lib/fpdf/fpdf.php');
require_once('../../../itranet/Connections/conecta.php');
 if (!isset($_SESSION) ) {
  session_start(); }
  
header("Content-Type: text/html;charset=utf-8");
//$conn = $conecta; //mysql_connect($hostname_conecta, $username_conecta, $password_conecta);
//echo 'llege';
$conn = mysqli_connect($hostname_conecta, $username_conecta, $password_conecta);
mysqli_select_db($conn,$database_conecta) or die("cannot select DB");

$IdModAsig=$_GET['a'];
//echo $IdModAsig;

$sql="select CONCAT(f_codmodulo(m.idmodulo)) as codigo,`d_abrevclasificador`(pc.`IdOficina`) as oficina,
   `d_abrevclasificador`(pc.`IdPrograma`) as programa,`d_clasificador`(pc.`IdGestion`) as gestion,`d_abrevclasificador`(pc.`IdTipo`) as tipo, pc.`Grupo` as grupo,
    NroModulo, FechaInicio, FechaFin,`n_docente`(m.`CiDocente`) d_nombre,`d_cliente`(pc.`idEmpresa`) as emp,
     `d_clasificador`(m.`IdTema`) as d_tema 
     from ibnorca.modulos m 
     inner join ibnorca.programas_cursos pc on m.idcurso=pc.idcurso 
 										WHERE m.IdModulo=$IdModAsig";
$cabe=mysqli_query($conn,$sql) or die(mysqli_error())	;									
$l1=mysqli_fetch_array($cabe);

$oficina=$l1['oficina'];
$codigo=$l1['codigo'];
$tipo=$l1['tipo'];
$programa=$l1['programa'];
$grupo=$l1['grupo'];
$gestion=$l1['gestion'];
$modulo=$l1['NroModulo'];
$docente=$l1['d_nombre'];
$tema=$l1['d_tema'];
$inicio=$l1['FechaInicio'];
$fin=$l1['FechaFin'];
//$empresa=$emp;

$tema1= ($tema); 


$lista="select a.*,	CONCAT(f_codmodulo(a.idmodulo)) as codigo, 
				IFNULL(c2.nombre,'Alumno no registrado') as Nombre,
                IFNULL(c2.appaterno,'Alumno no registrado') as ApPaterno,
                IFNULL(c2.apmaterno,'Alumno no registrado') as ApMaterno, nota_final(a.nota,a.asistencia,a.practicas) as nota_final, aprobado(IdAsignacionAlumno) as aprobado
									from ibnorca.asignacionalumno a
										LEFT join ibnorca.alumnos c2 on a.cialumno=c2.`CiAlumno` WHERE A.IdModulo= $IdModAsig order by c2.appaterno,c2.apmaterno";
$lista=mysqli_query($conn,$lista) or die(mysqli_error())	;					
										



class PDF extends FPDF
{
var $codigo;
var $oficina;
var $tipo;
var $programa;
var $grupo;
var $gestion;
var $modulo;
var $docente;
var $tema1;
var $inicio;
var $fin;
var $empresa;


//$productos2=0;

// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../../img/ibnologo.gif',260,12,25,25,'GIF');
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->Cell(249,10,'Instituto Boliviano de Normalizacion y Calidad',1,0,'C');
	$this->Cell(30,30,'',1);
	$this->LN(10);
	$this->Cell(249,10,'REGISTRO',1,0,'C');
	$this->LN(10);
	$this->Cell(249,10,'ACTA DE NOTAS',1,1,'C');
	$this->SetFont('Arial','B',9);
	$this->Cell(23,6,'REGIONAL:',1,0,'R');


$this->SetFont('Arial','',9);
global $oficina;
$this->Cell(23,6,$oficina,1,0,'C');

$this->SetFont('Arial','B',9);
$this->Cell(23,6,'TIPO:',1,0,'R');
$this->SetFont('Arial','',9);
global $tipo;
$this->Cell(23,6,$tipo,1,0,'C');

$this->SetFont('Arial','B',9);
$this->Cell(26,6,'PROGRAMA:',1,0,'R');
$this->SetFont('Arial','',9);
global $programa;
$this->Cell(23,6,$programa,1,0,'C');

$this->SetFont('Arial','B',9);
$this->Cell(23,6,'GRUPO:',1,0,'R');
$this->SetFont('Arial','',9);
global $grupo;
$this->Cell(23,6,$grupo,1,0,'C');

$this->SetFont('Arial','B',9);
$this->Cell(23,6,'MODULO:',1,0,'R');
$this->SetFont('Arial','',9);
global $modulo;
$this->Cell(23,6,$modulo,1,0,'C');

$this->SetFont('Arial','B',9);
$this->Cell(23,6,'GESTION:',1,0,'R');
$this->SetFont('Arial','',9);
global $gestion;
$this->Cell(23,6,$gestion,1,1,'C');

$this->SetFont('Arial','B',9);
$this->Cell(23,6,'DOCENTE:',1,0,'R');
$this->SetFont('Arial','',9);
global $docente;
$this->Cell(141,6,$docente,1,0,'C');

$this->SetFont('Arial','B',9);
$this->Cell(36,6,'CODIGO',1,0,'R');

global $codigo;
$this->SetFont('Arial','',9);
$this->Cell(79,6,$codigo,1,1,'C');
global $tema1;
$numCaracteresEnTema=strlen($tema1);
$altoEnTema=6;
$xEnTema=90;
for($i=0;$i<$numCaracteresEnTema;$i++){
	if($i>$xEnTema){
		$altoEnTema=$altoEnTema+6;
		$xEnTema=$xEnTema+90;
	}
}
$this->Cell(23,$altoEnTema,'TEMA:',1,0,'R');
$yEnTema=$this->GetY();
$xEnTema=$this->GetX();
$this->MultiCell(141,6,$tema1,1,'C');
$this->SetY($yEnTema);
$this->SetX($xEnTema+141);
$this->SetFont('Arial','B',9);
$this->Cell(36,$altoEnTema,'OBSERVACIONES',1,0,'R');
$this->SetFont('Arial','',9);
$this->Cell(79,$altoEnTema,'',1,1,'C');
$this->SetFont('Arial','B',9);
global $empresa;
$numCaracteresEnEmpresa=strlen($empresa);
$altoEnEmpresa=6;
$xEnEmpresa=54;
for($i=0;$i<$numCaracteresEnEmpresa;$i++){
	if($i>$xEnEmpresa){
		$altoEnEmpresa=$altoEnEmpresa+6;
		$xEnEmpresa=$xEnEmpresa+54;
	}
}
$this->Cell(30,$altoEnEmpresa,'FECHA INICIO:',1,0,'R');
global $inicio;
$this->Cell(30,$altoEnEmpresa,$inicio,1,0,'C');

$this->Cell(30,$altoEnEmpresa,'FECHA FIN:',1,0,'R');
global $fin;
$this->Cell(30,$altoEnEmpresa,$fin,1,0,'C');

$this->Cell(80,$altoEnEmpresa,'EMPRESA:',1,0,'R');
$this->MultiCell(79,6,$empresa,1,'C');

$this->Cell(279,6,'',0,1,'C');

    // Título
    // Salto de línea
    

}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    
$this->SetFont('Arial','B',9);/*
$this->Cell(69,6,'IBNORCA ©',1,0,'C');
$this->SetFont('Arial','B',9);
$this->Cell(72,6,'CODIGO: REG-PRE-SEC-05-02.02',1,0,'C');
$this->SetFont('Arial','B',9);
$this->Cell(69,6,'V: 2015-09-17',1,0,'C');
$this->SetFont('Arial','B',9);
$this->Cell(69,6,'PAGINA 1 DE 1',1,0,'C');*/
    // Número de página
	$this->Cell(69,6,'IBNORCA © ',1,0,'C');
	$this->Cell(72,6,'CODIGO: REG-PRE-SEC-05-06.02',1,0,'C');
	$this->Cell(69,6,'V: 2015-09-17',1,0,'C');
    $this->Cell(69,6,'Pagina '.$this->PageNo().' de {nb}',1,0,'R');

}
}

// Creación del objeto de la clase heredada
$pdf = new PDF('L','mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(9,8,'Nº',1,0,'C');
$pdf->Cell(30,8,'Ap. Paterno',1,0,'C');
$pdf->Cell(25,8,'Ap. Materno',1,0,'C');
$pdf->Cell(40,8,'Nombres',1,0,'C');
$pdf->Cell(23,8,'Asistencia',1,0,'C');
$pdf->Cell(23,8,'T. Practico',1,0,'C');
$pdf->Cell(23,8,'Examen',1,0,'C');
$pdf->Cell(23,8,'Nota Final',1,0,'C');
$pdf->Cell(26,8,'Recuperatorio 1',1,0,'C');
$pdf->Cell(26,8,'Recuperatorio 2',1,0,'C');
$pdf->Cell(31,8,'Aprobacion',1,1,'C');
//$pdf->Ln(8);
$pdf->SetFont('Arial','',9);


//Para Datos del contenido del PDF


$item=0;
//$productos2=0;

while($lista2 = mysqli_fetch_array($lista)){

$appat=($lista2['ApPaterno']);
$apmat=($lista2['ApMaterno']);
$nomb=($lista2['Nombre']);
//echo ($nomb).' '.($appat).' '.($apmat).'</br>';
/*$array2=array("á" => "a","é" => "e","í" => "i","ó" => "o",'ñ'=>'Ñ',"ú" => "u","ü"=>"Ü");
$nomb=strtr(($nomb),$array2); 
$appat=strtr(($appat),$array2); 
$apmat=strtr(($apmat),$array2); */

//echo ($nomb).' '.($appat).' '.($apmat).'</br>';
$appat1= (strtoupper($appat)); 
$apmat1= (strtoupper($apmat)); 
$nomb1= (strtoupper($nomb)); 

$array2=array("á" => "A","é" => "E","í" => "I","ó" => "O",'ñ'=>'Ñ',"ú" => "U","ü"=>"Ü");
$nomb1=strtr(($nomb1),$array2); 
$appat1=strtr(($appat1),$array2); 
$apmat1=strtr(($apmat1),$array2);

	//echo ($nomb1).' '.($appat1).' '.($apmat1).'</br>';
	//Algoritmo para campos dinamicos//
	$a=strlen($appat1);
	$b=strlen($apmat1);
	$c=strlen($nomb1);
	$altoEnLista=8;
	$altoEnMc=4;

	$item=$item +1;
	$pdf->Cell(9,$altoEnLista,$item,1);
	if($a>19){
		$yEnLista=$pdf->GetY();
		$xEnLista=$pdf->GetX();
		$pdf->MultiCell(30,$altoEnMc,($appat1),1);
		$pdf->SetY($yEnLista);
		$pdf->SetX($xEnLista+30);
	}else{
		$pdf->Cell(30,$altoEnLista,($appat1),1);
	}
	if($b>15){
		$yEnLista=$pdf->GetY();
		$xEnLista=$pdf->GetX();
		$pdf->MultiCell(25,$altoEnMc,$apmat1,1);
		$pdf->SetY($yEnLista);
		$pdf->SetX($xEnLista+25);
	}else{
		$pdf->Cell(25,$altoEnLista,$apmat1,1);
	}
	if($c>25){
		$yEnLista=$pdf->GetY();
		$xEnLista=$pdf->GetX();
		$pdf->MultiCell(40,$altoEnMc,$nomb1,1);
		$pdf->SetY($yEnLista);
		$pdf->SetX($xEnLista+40);
	}else{
		$pdf->Cell(40,$altoEnLista,$nomb1,1);
	}
	$pdf->Cell(23,$altoEnLista,$lista2['Asistencia'],1);
	$pdf->Cell(23,$altoEnLista,$lista2['Practicas'],1);
	$pdf->Cell(23,$altoEnLista,$lista2['Nota'],1);
	$pdf->Cell(23,$altoEnLista,$lista2['nota_final'],1);
	$pdf->Cell(26,$altoEnLista,$lista2['Recuperatorio1'],1);
	$pdf->Cell(26,$altoEnLista,$lista2['Recuperatorio2'],1);
	$pdf->Cell(31,$altoEnLista,$lista2['aprobado'],1);


	$pdf->Ln(8);	
}


$pdf->Output();




?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Acta de Notas</title>
<script type="text/javascript">
window.onload=function(){
	Objeto=document.getElementsByTagName("a");
	for(a=0;a<Objeto.length;a++){
		Objeto[a].onclick=function(){
			location.replace(this.href);
			return false;
		}
	}
}
</script>
</head>

<body>
</body>
</html>
