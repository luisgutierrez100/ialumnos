<?php 
if (!isset($_SESSION) ) {
  session_start(); }
  
include_once("../../itranet/Connections/conecta.php");

include_once('../../itranet/lib/lib_gral/funciones_gral.php');
include_once('../../itranet/lib/lib_gral/funciones_seguridad.php');
$conn = $conecta;
require('reportes/fpdf/fpdf.php');
require_once ('reportes/jpgraph/src/jpgraph.php');
require_once ('reportes/jpgraph/src/jpgraph_pie.php');
require_once ('reportes/jpgraph/src/jpgraph_pie3d.php');
mysql_query("SET NAMES 'utf8'");

mysql_select_db('ibnorca');

$IdMod=$_GET['mod'];
echo $IdMod;
class PDF extends FPDF
{
	function Header()
	{
    $this->Image('../../itranet/reportes/imagenes/logo_ibnorca.png',172,12,25,25,'PNG');
    $this->SetFont('Arial','B',10);
    $this->Cell(160,10,'Instituto Boliviano de Normalizacion y Calidad',1,0,'C');
	$this->Cell(30,30,'',1);
	$this->LN(10);
	$this->Cell(160,10,'REGISTRO',1,0,'C');
	$this->LN(10);
	$this->Cell(160,10,'INFORME TECNICO DE EVENTOS DE CAPACITACION',1,1,'C');
	}
	function Footer()
	{
	    $this->SetY(-15);
		$this->SetFont('Arial','B',9);
		$this->Cell(40,6,utf8_decode('IBNORCA © '),1,0,'C');
		$this->Cell(70,6,'CODIGO: REG-PRE-SEC-05-02.02',1,0,'C');
		$this->Cell(40,6,'V: 2015-09-17',1,0,'C');
	    $this->Cell(40,6,'Pagina '.$this->PageNo().' de {nb}',1,0,'R');
	}

}


$pdf = new PDF('P','mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(251,260,224);
//CABECERA DE INFORME (279)//
$sql=" select *,d_clasificador(m.IdTema) as tema,
`f_codModulo`(m.`IdModulo`) as codigo,
`d_clasificador`(p.IdOficina) as ofi,
`n_docente`(m.`CiDocente`) as docentemod,
concat(m.`CargaHoraria`,' Horas') as cargahoraria,
(select COUNT(*) from `asignacionalumno` where idmodulo=m.`IdModulo`  ) as cuantos,
(select SUM(c.`Monto`) as suma from `controlpagos` c where c.`IdModulo`=$IdMod)as facturado
 from modulos m 
 inner join `programas_cursos` p on p.IdCurso=m.IdCurso
 
 where IdModulo=$IdMod";
$cabe=mysql_query($sql);
$l1=mysql_fetch_array($cabe);

$modulo=$l1['tema'];
$codigo=$l1['codigo'];
$docente=$l1['docentemod'];
$lugar=$l1['ofi'];
$duracion=$l1['cargahoraria'];
$inicio=$l1['FechaInicio'];
$fin=$l1['FechaFin'];
$cantidad=$l1['cuantos'];
$facturado=$l1['facturado'];


$altoGeneral=6;
$pdf->Ln(5);
$pdf->Cell(25,$altoGeneral,'EVENTO:',1,0,'L',true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(165,$altoGeneral,utf8_decode($modulo),1,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(25,$altoGeneral,'CODIGO:',1,0,'L',true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,$altoGeneral,$codigo,1,0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(25,$altoGeneral,'EXPOSITOR:',1,0,'L',true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,$altoGeneral,utf8_decode($docente),1,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(25,$altoGeneral,'LUGAR:',1,0,'L',true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,$altoGeneral,utf8_decode($lugar),1,0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(25,$altoGeneral,'DURACION:',1,0,'L',true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,$altoGeneral,$duracion,1,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(25,$altoGeneral,'FECHA INICIO:',1,0,'L',true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,$altoGeneral,$inicio,1,0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(25,$altoGeneral,'FECHA FIN:',1,0,'L',true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,$altoGeneral,$fin,1,1);


//I. DATOS DEL CURSO//
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(100,6,'I. DATOS DEL CURSO',0,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(60,$altoGeneral,'Nro. DE ALUMNOS PARTICIPANTES',1,0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(46,$altoGeneral,$cantidad,1,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(60,$altoGeneral,'TOTAL FACTURACION DEL CURSO',1,0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(46,$altoGeneral,$facturado,1,1);

//II. RESULTADO DE EVALUACION DE SATISFACCION DEL CLIENTE//
//1. Contenido y documentacion//
$sql1="select distinct 
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=1  and re.IdRespuestas=1056 and re.`IdModulo`=$IdMod) as ms,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=1  and re.IdRespuestas=1055 and re.`IdModulo`=$IdMod) as s,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=1  and re.IdRespuestas=1054 and re.`IdModulo`=$IdMod) as n,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=1 and re.IdRespuestas=1053 and re.`IdModulo`=$IdMod) as ps,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=1  and re.IdRespuestas=1052 and re.`IdModulo`=$IdMod) as ns,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=1 and re.`IdModulo`=$IdMod) as total
 from `respuestassatisfaccion` r 
 inner join `preguntas` p on p.`idPregunta`=r.`IdPregunta`
where p.`Grupo`=1 and r.`IdModulo`=$IdMod";
//echo $sql1;
$cabe1=mysql_query($sql1);
$l2=mysql_fetch_array($cabe1);

$Muysatisfecho=$l2['ms'];
$Satisfecho=$l2['s'];
$Normal=$l2['n'];
$Pocosatisfecho=$l2['ps'];
$Nadasatisfecho=$l2['ns'];
$total=$l2['total'];

//Porcentajes

$pms=round(($Muysatisfecho*100)/$total);
$ps=round(($Satisfecho*100)/$total);
$pn=round(($Normal*100)/$total);
$pps=round(($Pocosatisfecho*100)/$total);
$pns=round(($Nadasatisfecho*100)/$total);

$altoCol=8;
$anchoCol_1=60;
$anchoCol_2=23;
$anchoCol_3=23;
$anchoCol_4=10;
$anchoCol_5=74;
$texto_1='Muy Satisfecho';
$texto_2='Satisfecho';
$texto_3='Normal';
$texto_4='Poco Satisfecho';
$texto_5='Nada Satisfecho';
$texto_6='TOTAL GENERAL';
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(100,6,'II. RESULTADO DE EVALUACION DE SATISFACCION DEL CLIENTE',0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(100,6,'1. CONTENIDO Y DOCUMENTACION',0,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell($anchoCol_1,$altoCol,utf8_decode('Nivel de Satisfacción'),1,0,'L',true);
$pdf->Cell($anchoCol_2,$altoCol,'Cantidad',1,0,'C',true);
$pdf->Cell($anchoCol_3,$altoCol,'Porcentaje',1,0,'C',true);
$pdf->Cell($anchoCol_4,$altoCol,'Color',1,0,'C',true);
$pdf->Cell($anchoCol_5,$altoCol,'Grafico',1,1,'C',true);
$pdf->SetFont('Arial','',9);
$pdf->Cell($anchoCol_1,$altoCol,$texto_1,1,0);
$pdf->Image('../imagenes/emoji_1.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Muysatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pms.'%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_1.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,0);
$posicionEnX=$pdf->GetX();
$posicionEnY=$pdf->GetY();
$pdf->Ln();
$pdf->Cell($anchoCol_1,$altoCol,$texto_2,1,0);
$pdf->Image('../imagenes/emoji_1.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Satisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$ps.'%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_2.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_3,1,0);
$pdf->Image('../imagenes/emoji_2.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Normal,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pn.'%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_3.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_4,1,0);
$pdf->Image('../imagenes/emoji_3.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Pocosatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pps.'%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_4.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_5,1,0);
$pdf->Image('../imagenes/emoji_3.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Nadasatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pns.'%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_5.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell($anchoCol_1,$altoCol,$texto_6,1,0);
$pdf->Cell($anchoCol_2,$altoCol,$total,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,'100%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,'',1,1);
$pdf->SetY($posicionEnY);
$pdf->SetX($posicionEnX);
//PARA EL GRAFICO//
$data = array($Muysatisfecho,$Satisfecho,$Normal,$Pocosatisfecho,$Nadasatisfecho);// NOTA: Estos datos deben ser reemplazados por los obtenidos del sistema
$color=array('#28ff89','#00d5ff','#fff800','#dd00f4','#ff2932');
$graph = new PieGraph(520,350);
$theme_class= new VividTheme;
$graph->SetTheme($theme_class);
$p1 = new PiePlot3D($data);
$graph->Add($p1);
$p1->ShowBorder();
$p1->SetColor('black');
$p1->SetSize(220);
$p1->value->SetFont(FF_ARIAL,FS_NORMAL,13);
$p1->SetSliceColors($color);
$nombreImagen = 'imagen_1.png';
$graph->Stroke($nombreImagen);

$pdf->Cell($anchoCol_5,($altoCol*6),$pdf->Image('imagen_1.png',($pdf->getX()+2),$pdf->getY(),null,($altoCol*6)),1,1);

//2. Evaluacion al expositor//
$sql1="select distinct 
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=2  and re.IdRespuestas=1056 and re.`IdModulo`=$IdMod) as ms,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=2  and re.IdRespuestas=1055 and re.`IdModulo`=$IdMod) as s,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=2  and re.IdRespuestas=1054 and re.`IdModulo`=$IdMod) as n,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=2 and re.IdRespuestas=1053 and re.`IdModulo`=$IdMod) as ps,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=2  and re.IdRespuestas=1052 and re.`IdModulo`=$IdMod) as ns,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=2 and re.`IdModulo`=$IdMod) as total
 from `respuestassatisfaccion` r 
 inner join `preguntas` p on p.`idPregunta`=r.`IdPregunta`
where p.`Grupo`=1 and r.`IdModulo`=$IdMod";
$cabe1=mysql_query($sql1);
$l2=mysql_fetch_array($cabe1);

$Muysatisfecho=$l2['ms'];
$Satisfecho=$l2['s'];
$Normal=$l2['n'];
$Pocosatisfecho=$l2['ps'];
$Nadasatisfecho=$l2['ns'];
$total=$l2['total'];

//Porcentajes

$pms=round(($Muysatisfecho*100)/$total);
$ps=round(($Satisfecho*100)/$total);
$pn=round(($Normal*100)/$total);
$pps=round(($Pocosatisfecho*100)/$total);
$pns=round(($Nadasatisfecho*100)/$total);


$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(100,6,'2. EVALUACION AL EXPOSITOR',0,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell($anchoCol_1,$altoCol,utf8_decode('Nivel de Satisfacción'),1,0,'L',true);
$pdf->Cell($anchoCol_2,$altoCol,'Cantidad',1,0,'C',true);
$pdf->Cell($anchoCol_3,$altoCol,'Porcentaje',1,0,'C',true);
$pdf->Cell($anchoCol_4,$altoCol,'Color',1,0,'C',true);
$pdf->Cell($anchoCol_5,$altoCol,'Grafico',1,1,'C',true);
$pdf->SetFont('Arial','',9);
$pdf->Cell($anchoCol_1,$altoCol,$texto_1,1,0);
$pdf->Image('../imagenes/emoji_1.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Muysatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pms.'%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_1.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,0);
$posicionEnX=$pdf->GetX();
$posicionEnY=$pdf->GetY();
$pdf->Ln();
$pdf->Cell($anchoCol_1,$altoCol,$texto_2,1,0);
$pdf->Image('../imagenes/emoji_1.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Satisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$ps.'%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_2.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_3,1,0);
$pdf->Image('../imagenes/emoji_2.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Normal,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pn.'%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_3.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_4,1,0);
$pdf->Image('../imagenes/emoji_3.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Pocosatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pps.'%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_4.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_5,1,0);
$pdf->Image('../imagenes/emoji_3.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Nadasatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pns.'%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_5.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell($anchoCol_1,$altoCol,$texto_6,1,0);
$pdf->Cell($anchoCol_2,$altoCol,$total,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,'100%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,'',1,1);
$pdf->SetY($posicionEnY);
$pdf->SetX($posicionEnX);
//PARA EL GRAFICO//
$data = array($Muysatisfecho,$Satisfecho,$Normal,$Pocosatisfecho,$Nadasatisfecho);// NOTA: Estos datos deben ser reemplazados por los obtenidos del sistema
$color=array('#28ff89','#00d5ff','#fff800','#dd00f4','#ff2932');
$graph = new PieGraph(520,350);
$theme_class= new VividTheme;
$graph->SetTheme($theme_class);
$p1 = new PiePlot3D($data);
$graph->Add($p1);
$p1->ShowBorder();
$p1->SetColor('black');
$p1->SetSize(220);
$p1->value->SetFont(FF_ARIAL,FS_NORMAL,13);
$p1->SetSliceColors($color);
$nombreImagen = 'imagen_2.png';
$graph->Stroke($nombreImagen);

$pdf->Cell($anchoCol_5,($altoCol*6),$pdf->Image('imagen_2.png',($pdf->getX()+2),$pdf->getY(),null,($altoCol*6)),1,1);
$pdf->AddPage();
$pdf->Ln(2);

//3. Organizacion y logistica//

$sql1="select distinct 
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=3  and re.IdRespuestas=1056 and (p.`orden`=1 or p.`orden`=2 or p.`orden`=3 or p.`orden`=4) and re.`IdModulo`=$IdMod) as ms,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=3  and re.IdRespuestas=1055 and (p.`orden`=1 or p.`orden`=2 or p.`orden`=3 or p.`orden`=4)  and re.`IdModulo`=$IdMod) as s,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=3  and re.IdRespuestas=1054 and (p.`orden`=1 or p.`orden`=2 or p.`orden`=3 or p.`orden`=4)  and re.`IdModulo`=$IdMod) as n,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=3 and re.IdRespuestas=1053 and (p.`orden`=1 or p.`orden`=2 or p.`orden`=3 or p.`orden`=4)  and re.`IdModulo`=$IdMod) as ps,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=3  and re.IdRespuestas=1052 and (p.`orden`=1 or p.`orden`=2 or p.`orden`=3 or p.`orden`=4)  and re.`IdModulo`=$IdMod) as ns,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=3  and (p.`orden`=1 or p.`orden`=2 or p.`orden`=3 or p.`orden`=4) and re.`IdModulo`=$IdMod) as total
 from `respuestassatisfaccion` r 
 inner join `preguntas` p on p.`idPregunta`=r.`IdPregunta`
where p.`Grupo`=3  and r.`IdModulo`=$IdMod";
$cabe1=mysql_query($sql1);
$l2=mysql_fetch_array($cabe1);

$Muysatisfecho=$l2['ms'];
$Satisfecho=$l2['s'];
$Normal=$l2['n'];
$Pocosatisfecho=$l2['ps'];
$Nadasatisfecho=$l2['ns'];
$total=$l2['total'];

//Porcentajes

$pms=round(($Muysatisfecho*100)/$total);
$ps=round(($Satisfecho*100)/$total);
$pn=round(($Normal*100)/$total);
$pps=round(($Pocosatisfecho*100)/$total);
$pns=round(($Nadasatisfecho*100)/$total);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(100,6,'3. ORGANIZACION Y LOGISTICA',0,1);
$pdf->Cell(100,6,'A) Ambiente, equipos, material auidiovisual (a,b,c,d)',0,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell($anchoCol_1,$altoCol,utf8_decode('Nivel de Satisfacción'),1,0,'L',true);
$pdf->Cell($anchoCol_2,$altoCol,'Cantidad',1,0,'C',true);
$pdf->Cell($anchoCol_3,$altoCol,'Porcentage',1,0,'C',true);
$pdf->Cell($anchoCol_4,$altoCol,'Color',1,0,'C',true);
$pdf->Cell($anchoCol_5,$altoCol,'Grafico',1,1,'C',true);
$pdf->SetFont('Arial','',9);
$pdf->Cell($anchoCol_1,$altoCol,$texto_1,1,0);
$pdf->Image('../imagenes/emoji_1.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Muysatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pms,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_1.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,0);
$posicionEnX=$pdf->GetX();
$posicionEnY=$pdf->GetY();
$pdf->Ln();
$pdf->Cell($anchoCol_1,$altoCol,$texto_2,1,0);
$pdf->Image('../imagenes/emoji_1.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Satisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$ps,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_2.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_3,1,0);
$pdf->Image('../imagenes/emoji_2.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Normal,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pn,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_3.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_4,1,0);
$pdf->Image('../imagenes/emoji_3.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Pocosatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pps,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_4.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_5,1,0);
$pdf->Image('../imagenes/emoji_3.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Nadasatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pns,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_5.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell($anchoCol_1,$altoCol,$texto_6,1,0);
$pdf->Cell($anchoCol_2,$altoCol,$total,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,'100%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,'',1,1,'C');
$pdf->SetY($posicionEnY);
$pdf->SetX($posicionEnX);
//PARA EL GRAFICO//
$data = array($Muysatisfecho,$Satisfecho,$Normal,$Pocosatisfecho,$Nadasatisfecho);// NOTA: Estos datos deben ser reemplazados por los obtenidos del sistema
$color=array('#28ff89','#00d5ff','#fff800','#dd00f4','#ff2932');
$graph = new PieGraph(520,350);
$theme_class= new VividTheme;
$graph->SetTheme($theme_class);
$p1 = new PiePlot3D($data);
$graph->Add($p1);
$p1->ShowBorder();
$p1->SetColor('black');
$p1->SetSize(220);
$p1->value->SetFont(FF_ARIAL,FS_NORMAL,13);
$p1->SetSliceColors($color);
$nombreImagen = 'imagen_3.png';
$graph->Stroke($nombreImagen);

$pdf->Cell($anchoCol_5,($altoCol*6),$pdf->Image('imagen_3.png',($pdf->getX()+2),$pdf->getY(),null,($altoCol*6)),1,1);
//3. Organizacion y logistica//

$sql1="select distinct 
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=3  and re.IdRespuestas=1056 and (p.`orden`=5 or p.`orden`=6 or p.`orden`=7) and re.`IdModulo`=$IdMod) as ms,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=3  and re.IdRespuestas=1055 and (p.`orden`=5 or p.`orden`=6 or p.`orden`=7)  and re.`IdModulo`=$IdMod) as s,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=3  and re.IdRespuestas=1054 and (p.`orden`=5 or p.`orden`=6 or p.`orden`=7)  and re.`IdModulo`=$IdMod) as n,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=3 and re.IdRespuestas=1053 and (p.`orden`=5 or p.`orden`=6 or p.`orden`=7)  and re.`IdModulo`=$IdMod) as ps,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=3  and re.IdRespuestas=1052 and (p.`orden`=5 or p.`orden`=6 or p.`orden`=7)  and re.`IdModulo`=$IdMod) as ns,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=3  and (p.`orden`=5 or p.`orden`=6 or p.`orden`=7) and re.`IdModulo`=$IdMod) as total
 from `respuestassatisfaccion` r 
 inner join `preguntas` p on p.`idPregunta`=r.`IdPregunta`
where p.`Grupo`=3  and r.`IdModulo`=$IdMod";
$cabe1=mysql_query($sql1);
$l2=mysql_fetch_array($cabe1);

$Muysatisfecho=$l2['ms'];
$Satisfecho=$l2['s'];
$Normal=$l2['n'];
$Pocosatisfecho=$l2['ps'];
$Nadasatisfecho=$l2['ns'];
$total=$l2['total'];

//Porcentajes

$pms=round(($Muysatisfecho*100)/$total);
$ps=round(($Satisfecho*100)/$total);
$pn=round(($Normal*100)/$total);
$pps=round(($Pocosatisfecho*100)/$total);
$pns=round(($Nadasatisfecho*100)/$total);

$pdf->Ln(5);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(100,6,utf8_decode('B) Organización del curso (Horario, duración y atención al cliente (e, f, g))'),0,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell($anchoCol_1,$altoCol,utf8_decode('Nivel de Satisfacción'),1,0,'L',true);
$pdf->Cell($anchoCol_2,$altoCol,'Cantidad',1,0,'C',true);
$pdf->Cell($anchoCol_3,$altoCol,'Porcentage',1,0,'C',true);
$pdf->Cell($anchoCol_4,$altoCol,'Color',1,0,'C',true);
$pdf->Cell($anchoCol_5,$altoCol,'Grafico',1,1,'C',true);
$pdf->SetFont('Arial','',9);
$pdf->Cell($anchoCol_1,$altoCol,$texto_1,1,0);
$pdf->Image('../imagenes/emoji_1.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Muysatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pms,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_1.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,0);
$posicionEnX=$pdf->GetX();
$posicionEnY=$pdf->GetY();
$pdf->Ln();
$pdf->Cell($anchoCol_1,$altoCol,$texto_2,1,0);
$pdf->Image('../imagenes/emoji_1.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Satisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$ps,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_2.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_3,1,0);
$pdf->Image('../imagenes/emoji_2.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Normal,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pn,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_3.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_4,1,0);
$pdf->Image('../imagenes/emoji_3.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Pocosatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pps,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_4.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_5,1,0);
$pdf->Image('../imagenes/emoji_3.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Nadasatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pns,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_5.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell($anchoCol_1,$altoCol,$texto_6,1,0);
$pdf->Cell($anchoCol_2,$altoCol,$total,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,'100%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,'',1,1);
$pdf->SetY($posicionEnY);
$pdf->SetX($posicionEnX);
//PARA EL GRAFICO//
$data = array($Muysatisfecho,$Satisfecho,$Normal,$Pocosatisfecho,$Nadasatisfecho);// NOTA: Estos datos deben ser reemplazados por los obtenidos del sistema
$color=array('#28ff89','#00d5ff','#fff800','#dd00f4','#ff2932');
$graph = new PieGraph(520,350);
$theme_class= new VividTheme;
$graph->SetTheme($theme_class);
$p1 = new PiePlot3D($data);
$graph->Add($p1);
$p1->ShowBorder();
$p1->SetColor('black');
$p1->SetSize(220);
$p1->value->SetFont(FF_ARIAL,FS_NORMAL,13);
$p1->SetSliceColors($color);
$nombreImagen = 'imagen_4.png';
$graph->Stroke($nombreImagen);

$pdf->Cell($anchoCol_5,($altoCol*6),$pdf->Image('imagen_4.png',($pdf->getX()+2),$pdf->getY(),null,($altoCol*6)),1,1);
$pdf->Ln(5);
//4. Aspectos generales//

$sql1="select distinct 
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=4  and re.IdRespuestas=1056 and (p.`orden`=1 or p.`orden`=2 or p.`orden`=3) and re.`IdModulo`=$IdMod) as ms,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=4  and re.IdRespuestas=1055 and (p.`orden`=1 or p.`orden`=2 or p.`orden`=3)  and re.`IdModulo`=$IdMod) as s,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=4  and re.IdRespuestas=1054 and (p.`orden`=1 or p.`orden`=2 or p.`orden`=3)  and re.`IdModulo`=$IdMod) as n,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=4 and re.IdRespuestas=1053 and (p.`orden`=1 or p.`orden`=2 or p.`orden`=3)  and re.`IdModulo`=$IdMod) as ps,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=4  and re.IdRespuestas=1052 and (p.`orden`=1 or p.`orden`=2 or p.`orden`=3)  and re.`IdModulo`=$IdMod) as ns,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=4  and (p.`orden`=1 or p.`orden`=2 or p.`orden`=3) and re.`IdModulo`=$IdMod) as total
 from `respuestassatisfaccion` r 
 inner join `preguntas` p on p.`idPregunta`=r.`IdPregunta`
where p.`Grupo`=4  and r.`IdModulo`=$IdMod";
$cabe1=mysql_query($sql1);
$l2=mysql_fetch_array($cabe1);

$Muysatisfecho=$l2['ms'];
$Satisfecho=$l2['s'];
$Normal=$l2['n'];
$Pocosatisfecho=$l2['ps'];
$Nadasatisfecho=$l2['ns'];
$total=$l2['total'];

//Porcentajes

$pms=round(($Muysatisfecho*100)/$total);
$ps=round(($Satisfecho*100)/$total);
$pn=round(($Normal*100)/$total);
$pps=round(($Pocosatisfecho*100)/$total);
$pns=round(($Nadasatisfecho*100)/$total);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(100,6,'4. ASPECTOS GENERALES',0,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(100,6,utf8_decode('A) Comprensión, aplicabilidad y cumplimiento de expectativas (a, b, c)'),0,1);
$pdf->Cell($anchoCol_1,$altoCol,utf8_decode('Nivel de Satisfacción'),1,0,'L',true);
$pdf->Cell($anchoCol_2,$altoCol,'Cantidad',1,0,'C',true);
$pdf->Cell($anchoCol_3,$altoCol,'Porcentage',1,0,'C',true);
$pdf->Cell($anchoCol_4,$altoCol,'Color',1,0,'C',true);
$pdf->Cell($anchoCol_5,$altoCol,'Grafico',1,1,'C',true);
$pdf->SetFont('Arial','',9);
$pdf->Cell($anchoCol_1,$altoCol,$texto_1,1,0);
$pdf->Image('../imagenes/emoji_1.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Muysatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pms,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_1.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,0);
$posicionEnX=$pdf->GetX();
$posicionEnY=$pdf->GetY();
$pdf->Ln();
$pdf->Cell($anchoCol_1,$altoCol,$texto_2,1,0);
$pdf->Image('../imagenes/emoji_1.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Satisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$ps,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_2.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_3,1,0);
$pdf->Image('../imagenes/emoji_2.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Normal,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pn,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_3.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_4,1,0);
$pdf->Image('../imagenes/emoji_3.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Pocosatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pps,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_4.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_5,1,0);
$pdf->Image('../imagenes/emoji_3.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Nadasatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pns,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_5.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell($anchoCol_1,$altoCol,$texto_6,1,0);
$pdf->Cell($anchoCol_2,$altoCol,$total,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,'100%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,'',1,1);
$pdf->SetY($posicionEnY);
$pdf->SetX($posicionEnX);
//PARA EL GRAFICO//
$data = array($Muysatisfecho,$Satisfecho,$Normal,$Pocosatisfecho,$Nadasatisfecho);// NOTA: Estos datos deben ser reemplazados por los obtenidos del sistema
$color=array('#28ff89','#00d5ff','#fff800','#dd00f4','#ff2932');
$graph = new PieGraph(520,350);
$theme_class= new VividTheme;
$graph->SetTheme($theme_class);
$p1 = new PiePlot3D($data);
$graph->Add($p1);
$p1->ShowBorder();
$p1->SetColor('black');
$p1->SetSize(220);
$p1->value->SetFont(FF_ARIAL,FS_NORMAL,13);
$p1->SetSliceColors($color);
$nombreImagen = 'imagen_5.png';
$graph->Stroke($nombreImagen);

$pdf->Cell($anchoCol_5,($altoCol*6),$pdf->Image('imagen_5.png',($pdf->getX()+2),$pdf->getY(),null,($altoCol*6)),1,1);
$pdf->AddPage();
//4. Aspectos generales//

$sql1="select distinct 
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=4  and re.IdRespuestas=1056 and (p.`orden`=4 or p.`orden`=5) and re.`IdModulo`=$IdMod) as ms,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=4  and re.IdRespuestas=1055 and (p.`orden`=4 or p.`orden`=5)  and re.`IdModulo`=$IdMod) as s,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=4  and re.IdRespuestas=1054 and (p.`orden`=4 or p.`orden`=5)  and re.`IdModulo`=$IdMod) as n,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=4 and re.IdRespuestas=1053 and (p.`orden`=4 or p.`orden`=5)  and re.`IdModulo`=$IdMod) as ps,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=4  and re.IdRespuestas=1052 and (p.`orden`=4 or p.`orden`=5)  and re.`IdModulo`=$IdMod) as ns,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where p.`Grupo`=4  and (p.`orden`=4 or p.`orden`=5) and re.`IdModulo`=$IdMod) as total
 from `respuestassatisfaccion` r 
 inner join `preguntas` p on p.`idPregunta`=r.`IdPregunta`
where p.`Grupo`=4  and r.`IdModulo`=$IdMod";
$cabe1=mysql_query($sql1);
$l2=mysql_fetch_array($cabe1);

$Muysatisfecho=$l2['ms'];
$Satisfecho=$l2['s'];
$Normal=$l2['n'];
$Pocosatisfecho=$l2['ps'];
$Nadasatisfecho=$l2['ns'];
$total=$l2['total'];

//Porcentajes

$pms=round(($Muysatisfecho*100)/$total);
$ps=round(($Satisfecho*100)/$total);
$pn=round(($Normal*100)/$total);
$pps=round(($Pocosatisfecho*100)/$total);
$pns=round(($Nadasatisfecho*100)/$total);

$pdf->Ln(2);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(100,6,utf8_decode('B) Grado de satisfacción general del curso (d, e)'),0,1);
$pdf->Cell($anchoCol_1,$altoCol,utf8_decode('Nivel de Satisfacción'),1,0,'L',true);
$pdf->Cell($anchoCol_2,$altoCol,'Cantidad',1,0,'C',true);
$pdf->Cell($anchoCol_3,$altoCol,'Porcentage',1,0,'C',true);
$pdf->Cell($anchoCol_4,$altoCol,'Color',1,0,'C',true);
$pdf->Cell($anchoCol_5,$altoCol,'Grafico',1,1,'C',true);
$pdf->SetFont('Arial','',9);
$pdf->Cell($anchoCol_1,$altoCol,$texto_1,1,0);
$pdf->Image('../imagenes/emoji_1.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Muysatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pms,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_1.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,0);
$posicionEnX=$pdf->GetX();
$posicionEnY=$pdf->GetY();
$pdf->Ln();
$pdf->Cell($anchoCol_1,$altoCol,$texto_2,1,0);
$pdf->Image('../imagenes/emoji_1.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Satisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$ps,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_2.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_3,1,0);
$pdf->Image('../imagenes/emoji_2.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Normal,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pn,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_3.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_4,1,0);
$pdf->Image('../imagenes/emoji_3.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Pocosatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pps,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_4.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_5,1,0);
$pdf->Image('../imagenes/emoji_3.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Nadasatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pns,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_5.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell($anchoCol_1,$altoCol,$texto_6,1,0);
$pdf->Cell($anchoCol_2,$altoCol,$total,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,'100%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,'',1,1);
$pdf->SetY($posicionEnY);
$pdf->SetX($posicionEnX);
//PARA EL GRAFICO//
$data = array($Muysatisfecho,$Satisfecho,$Normal,$Pocosatisfecho,$Nadasatisfecho);// NOTA: Estos datos deben ser reemplazados por los obtenidos del sistema
$color=array('#28ff89','#00d5ff','#fff800','#dd00f4','#ff2932');
$graph = new PieGraph(520,350);
$theme_class= new VividTheme;
$graph->SetTheme($theme_class);
$p1 = new PiePlot3D($data);
$graph->Add($p1);
$p1->ShowBorder();
$p1->SetColor('black');
$p1->SetSize(220);
$p1->value->SetFont(FF_ARIAL,FS_NORMAL,13);
$p1->SetSliceColors($color);
$nombreImagen = 'imagen_6.png';
$graph->Stroke($nombreImagen);

$pdf->Cell($anchoCol_5,($altoCol*6),$pdf->Image('imagen_6.png',($pdf->getX()+2),$pdf->getY(),null,($altoCol*6)),1,1);
$pdf->Ln(5);

//RESUMEN GENERAL//

$sql1="select distinct 
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where re.IdRespuestas=1056 and re.`IdModulo`=$IdMod and p.`Grupo`<>5) as ms,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where re.IdRespuestas=1055  and re.`IdModulo`=$IdMod and p.`Grupo`<>5) as s,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where re.IdRespuestas=1054 and re.`IdModulo`=$IdMod and p.`Grupo`<>5) as n,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where re.IdRespuestas=1053  and re.`IdModulo`=$IdMod and p.`Grupo`<>5) as ps,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where re.IdRespuestas=1052 and re.`IdModulo`=$IdMod and p.`Grupo`<>5) as ns,
(select count(*) from `respuestassatisfaccion` re
inner join preguntas p on p.`idPregunta`=re.`IdPregunta`
where re.`IdModulo`=$IdMod and p.`Grupo`<>5) as total
 from `respuestassatisfaccion` r 
 inner join `preguntas` p on p.`idPregunta`=r.`IdPregunta`
where  r.`IdModulo`=$IdMod and p.`Grupo`<>5";
$cabe1=mysql_query($sql1);
$l2=mysql_fetch_array($cabe1);

$Muysatisfecho=$l2['ms'];
$Satisfecho=$l2['s'];
$Normal=$l2['n'];
$Pocosatisfecho=$l2['ps'];
$Nadasatisfecho=$l2['ns'];
$total=$l2['total'];

//Porcentajes

$pms=round(($Muysatisfecho*100)/$total);
$ps=round(($Satisfecho*100)/$total);
$pn=round(($Normal*100)/$total);
$pps=round(($Pocosatisfecho*100)/$total);
$pns=round(($Nadasatisfecho*100)/$total);

$pdf->Ln(2);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(100,6,'4. RESUMEN GENERALES',0,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(100,6,'',0,1);
$pdf->Cell($anchoCol_1,$altoCol,utf8_decode('Nivel de Satisfacción'),1,0,'L',true);
$pdf->Cell($anchoCol_2,$altoCol,'Cantidad',1,0,'C',true);
$pdf->Cell($anchoCol_3,$altoCol,'Porcentage',1,0,'C',true);
$pdf->Cell($anchoCol_4,$altoCol,'Color',1,0,'C',true);
$pdf->Cell($anchoCol_5,$altoCol,'Grafico',1,1,'C',true);
$pdf->SetFont('Arial','',9);
$pdf->Cell($anchoCol_1,$altoCol,$texto_1,1,0);
$pdf->Image('../imagenes/emoji_1.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Muysatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pms,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_1.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,0);
$posicionEnX=$pdf->GetX();
$posicionEnY=$pdf->GetY();
$pdf->Ln();
$pdf->Cell($anchoCol_1,$altoCol,$texto_2,1,0);
$pdf->Image('../imagenes/emoji_1.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Satisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$ps,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_2.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_3,1,0);
$pdf->Image('../imagenes/emoji_2.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Normal,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pn,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_3.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_4,1,0);
$pdf->Image('../imagenes/emoji_3.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Pocosatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pps,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_4.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->Cell($anchoCol_1,$altoCol,$texto_5,1,0);
$pdf->Image('../imagenes/emoji_3.png',($pdf->GetX()-($altoCol+2)),($pdf->GetY()+1),null,($altoCol-2),'PNG');
$pdf->Cell($anchoCol_2,$altoCol,$Nadasatisfecho,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,$pns,1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,$pdf->Image('../imagenes/color_5.png',$pdf->getX(),$pdf->getY(),$anchoCol_4,$altoCol),1,1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell($anchoCol_1,$altoCol,$texto_6,1,0);
$pdf->Cell($anchoCol_2,$altoCol,$total,1,0,'C');
$pdf->Cell($anchoCol_3,$altoCol,'100%',1,0,'C');
$pdf->Cell($anchoCol_4,$altoCol,'',1,1);
$pdf->SetY($posicionEnY);
$pdf->SetX($posicionEnX);
//PARA EL GRAFICO//
$data = array($Muysatisfecho,$Satisfecho,$Normal,$Pocosatisfecho,$Nadasatisfecho);// NOTA: Estos datos deben ser reemplazados por los obtenidos del sistema
$color=array('#28ff89','#00d5ff','#fff800','#dd00f4','#ff2932');
$graph = new PieGraph(520,350);
$theme_class= new VividTheme;
$graph->SetTheme($theme_class);
$p1 = new PiePlot3D($data);
$graph->Add($p1);
$p1->ShowBorder();
$p1->SetColor('black');
$p1->SetSize(220);
$p1->value->SetFont(FF_ARIAL,FS_NORMAL,13);
$p1->SetSliceColors($color);
$nombreImagen = 'imagen_7.png';
$graph->Stroke($nombreImagen);

$pdf->Cell($anchoCol_5,($altoCol*6),$pdf->Image('imagen_7.png',($pdf->getX()+2),$pdf->getY(),null,($altoCol*6)),1,1);
$pdf->Ln(5);

$pdf->AddPage();

//5. CURSOS SUGERIDOS

$sql1="select r.`Respuestatxt` as sugerencia from `respuestassatisfaccion` r
 inner join `preguntas` p on p.`idPregunta`=r.`IdPregunta`
where  r.`IdModulo`=$IdMod and p.`idPregunta`=921 and ( CHARACTER_LENGTH(ifnull(r.`Respuestatxt`,''))>9) ";
$cabe1=mysql_query($sql1);


$pdf->Ln(2);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(190,8,'6. CURSOS SUGERIDOS',1,1,'L',true);
$pdf->SetFont('Arial','',8);
while ($l2=mysql_fetch_array($cabe1)){
$sugerencia1=utf8_decode($l2['sugerencia']);
$pdf->MultiCell(190,4,$sugerencia1,1);
}
//6.SUGERENCIAS Y RECLAMOS
$sql1="select r.`Respuestatxt` as sugerencia from `respuestassatisfaccion` r
 inner join `preguntas` p on p.`idPregunta`=r.`IdPregunta`
where  r.`IdModulo`=$IdMod and p.`idPregunta`=922 and (CHARACTER_LENGTH(ifnull(r.`Respuestatxt`,''))>9) ";
$cabe1=mysql_query($sql1);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(190,8,'7. SUGERENCIAS Y/O RECLAMOS',1,1,'L',true);
$pdf->SetFont('Arial','',8);
while ($l2=mysql_fetch_array($cabe1)){
$sugerencia1=utf8_decode($l2['sugerencia']);
$pdf->MultiCell(190,4,$sugerencia1,1);
}
$pdf->Cell(190,8,'',1,1);
$pdf->Output();
//ELIMINAMOS IMAGENES//
unlink('imagen_1.png');
unlink('imagen_2.png');
unlink('imagen_3.png');
unlink('imagen_4.png');
unlink('imagen_5.png');
unlink('imagen_6.png');
unlink('imagen_7.png');
?>