<?php
use Dompdf\Options;
use Dompdf\Dompdf;
require_once (PATH_MODELS . "/ReporteModel.php");
require_once (PATH_MODELS . "/MateriaDocenteModel.php");
require_once (PATH_HELPERS."/dompdf/autoload.inc.php");
require_once (PATH_HELPERS."/dompdf/src/FontMetrics.php");
require_once (PATH_HELPERS."/jpgraph/jpgraph.php");
require_once (PATH_HELPERS."/jpgraph/jpgraph_pie.php");

class ReporteController {
	
	public function listar(){
		$model = new ReporteModel();
		$id = $_SESSION['SESSION_USER']->usuario_id;
		if($_SESSION['SESSION_USER']->tipo_usuario_id ==1) {
			$id = $_GET['id'];
		}		
		$datos = $model->getlistadoMateriaPeriodo($id);
		$message = "";
		require_once PATH_VIEWS."/Reporte/view.list.php";
	}
	
	public function obtenerDatosCab($id){
		$model = new ReporteModel();
		$datos = $model->getDatosCabecera($id);
		return $datos;
	}
	
	public function obtenerRespuestas(){
		$model = new ReporteModel();
		$datos = $model->getRespuestas();
		return $datos;
	}
	
	public function array_elimina_duplicados($array)
	{
		$new = array();
		$exclude = array("");
		for ($i = 0; $i<=count($array)-1; $i++) {
			if (!in_array(trim($array[$i]->pregunta_id) ,$exclude)) { 
				$new[] = $array[$i]; 
				$exclude[] = trim($array[$i]->pregunta_id); 
			}
		}
		 
		return $new;
	}
	
	public function obtenerPreguntas($id){
		$model = new ReporteModel();
		$datos = $model->getPreguntas($id);		
		$array = self::array_elimina_duplicados($datos);
		foreach ($datos as $dato){		
			foreach ($array as $a){
				if($a->pregunta_id == $dato->pregunta_id){
					if($dato->respuesta_id == 1){
						$a->res1 = $dato->respuesta;
					}
					if($dato->respuesta_id == 2){
						$a->res2 = $dato->respuesta;
					}
					if($dato->respuesta_id == 3){
						$a->res3 = $dato->respuesta;
					}
					if($dato->respuesta_id == 4){
						$a->res4 = $dato->respuesta;
					}
				}
			}
		}			
		return $array;
	}
	
	public function verPdf(){
		$model = new ReporteModel();
		$id = $_GET ['id'];
		$datos_cab = self::obtenerDatosCab($id)[0];
		$respuestas = self::obtenerRespuestas();
		$preguntas = self::obtenerPreguntas($id);
		
		$html = "<html>
					<head>
						<link href='http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'/>
						<style>
								body {
								margin: 20px 20px 20px 50px;
								}
								table{
								border-collapse: collapse; width: 100%;
								}
								
								td{
								border:1px solid #ccc; padding:1px;
								font-size:9pt;
								}
						</style>
					</head>
					<body>
						<table width= 100% border=0 >
							<tr>
								<td style='text-left' rowspan=2>
									<img src='".PATH_IMAGE."/san_gabriel.jpg' style='height: 50px; margin-bottom: 5px;'>
								</td>
								<td style='font-size:20px;text-ñeft' colspan='5'>
									<b>INSTITUTO TECNOLÓGICO SUPERIOR SAN GABRIEL</b>
								</td>										
							</tr>					
							<tr>
								<td style='font-size:14px;text-align:center' colspan='6'><b>Evaluación Docentes ".$datos_cab->periodo_nombre."</b></td>
							</tr>
						</table>
						<br>
						<table border=0>				
							<tr>
								<td width='60px'><b>Área:</b></td><td style='text-align:left'>".$datos_cab->espe_nombre."</td>
								<td width='60px'><b>Sección:</b></td style='text-align:left'><td>".$datos_cab->seccion_nombre."</td>
								<td width='60px'><b>Materia:</b></td style='text-align:left'><td>".$datos_cab->materia_nombre."</td>
							</tr>			
							<tr>
								<td width='60px'><b>Docente:</b></td><td style='text-align:left'>".$datos_cab->docente_nombre." ".$datos_cab->docente_apellido."</td>
								<td width='60px'><b>Curso:</b></td><td style='text-align:left'>".$datos_cab->curso_nombre."</td>								
								<td width='150px'><b>Fecha de Evaluación:</b></td><td style='text-align:left'>".$datos_cab->curso_nombre."</td>
							</tr>
						</table>
						<br>
						<table>
							<tr>
								<td rowspan='3' style='text-align:center'><b>Preguntas</b>
								</td>										
								<td colspan='4' style='text-align:center'><b>Valor del Grado de Acuerdo con las siguientes afirmaciones</b></td>
								<td rowspan='3' style='text-align:center'><b>Total Alumnos</b>
							</tr>
							<tr>";		
							foreach ($respuestas as $res){
								$html.="<td style='text-align:center'><b>".$res->nombre."</b></td>";							
							}
		$html .="	</tr>";
							foreach ($respuestas as $res){
								$html.="<td style='text-align:center'><b>".$res->valor."</b></td>";
							}
		$html .="	</tr>	";
		$total = 0;
		$total1 = 0;
		$total2 = 0;
		$total3 = 0;
		$total4 = 0;
							foreach ($preguntas as $preg){
								if($preg->unica == 0){
		$total_preg = $preg->res1+$preg->res2+$preg->res3+$preg->res4;
		$total += $total_preg;
		$total1 += $preg->res1;
		$total2 += $preg->res2;
		$total3 += $preg->res3;
		$total4 += $preg->res4;
		
		$html .="	<tr><td>".$preg->pregunta_nombre."</td>";								
		$html .="		<td style='text-align:center'>".$preg->res1."</td>";							
		$html .="		<td style='text-align:center'>".$preg->res2."</td>";								
		$html .="		<td style='text-align:center'>".$preg->res3."</td>";							
		$html .="		<td style='text-align:center'>".$preg->res4."</td>";		
		$html .="       <td style='text-align:center'>".$total_preg."</td></tr>";
					}
				}
		$perc[] = number_format((($total1 *100)/$total),2);
		$perc[] = number_format((($total2 *100)/$total),2);
		$perc[] = number_format((($total3 *100)/$total),2);
		$perc[] = number_format((($total4 *100)/$total),2);
					
		$html .="<tr><td style='text-align:center'><b>TOTAL</b></td>
					 <td style='text-align:center'>".$total1."</td>
					 <td style='text-align:center'>".$total2."</td>
					 <td style='text-align:center'>".$total3."</td>
					 <td style='text-align:center'>".$total4."</td>
					 <td style='text-align:center'>".$total."</td>
				</tr>
				<tr>
				   	<td></td>
					<td style='text-align:center'>".$perc[0]."</td>
					<td style='text-align:center'>".$perc[1]."</td>
					<td style='text-align:center'>".$perc[2]."</td>
					<td style='text-align:center'>".$perc[3]."</td>
					<td style='text-align:center'>100</td>
				</tr>";
		self::grafico($perc);
		
		$total1 = 0;
		$total1a = 0;
		$total2b = 0;
		$total3c = 0;
		$total4d = 0;
		$html .="<tr><td colspan='6'><br><br></td></tr>";
		foreach ($preguntas as $preg){
			if($preg->unica == 1){
				$total_preg1 = $preg->res1+$preg->res2+$preg->res3+$preg->res4;
				$total1 += $total_preg;
				$total1a += $preg->res1;
				$total2b += $preg->res2;
				$total3c += $preg->res3;
				$total4d += $preg->res4;
		
				$html .="	<tr><td>".$preg->pregunta_nombre."</td>";
				$html .="		<td style='text-align:center'>".$preg->res1."</td>";
				$html .="		<td style='text-align:center'>".$preg->res2."</td>";
				$html .="		<td style='text-align:center'>".$preg->res3."</td>";
				$html .="		<td style='text-align:center'>".$preg->res4."</td>";
				$html .="       <td style='text-align:center'>".$total_preg1."</td></tr>";
			}
		}
		$perc1[] = number_format((($total1a *100)/$total1),2);
		$perc1[] = number_format((($total2b *100)/$total1),2);
		$perc1[] = number_format((($total3c *100)/$total1),2);
		$perc1[] = number_format((($total4d *100)/$total1),2);
		
		$html .="<tr>
				   	<td></td>
					<td style='text-align:center'>".$perc1[0]."</td>
					<td style='text-align:center'>".$perc1[1]."</td>
					<td style='text-align:center'>".$perc1[2]."</td>
					<td style='text-align:center'>".$perc1[3]."</td>
					<td style='text-align:center'>100</td>
				</tr>";
		self::grafico($perc);
		
		$html .="</table>";
		self::grafico($perc);
		
		$html.="<br><img src=".PATH_IMAGE."/graficas/imagen.png>
				</body></html>";
		
		$options = new Options();
		$options->set('isHtml5ParserEnabled', true);
		$dompdf = new Dompdf($options);
		$dompdf->load_html($html);
		
		$dompdf->render();
		$canvas = $dompdf->get_canvas();
		$canvas->page_text(550, 750, "{PAGE_NUM}", $font, 6, array(0,0,0)); //header		
		$dompdf->stream('general', array("Attachment"=>false));		
	}
	
	public function grafico($datos){
		$leyenda = array("Nunca","En Desacuerdo","Deacuerdo","Totalmente Deacuerdo");
		
		$grafico = new PieGraph(550,400);
		$grafico->SetShadow();
		
		$grafico->title->Set("Gestion de Docentes");
		$grafico->title->SetFont(FF_FONT1,FS_BOLD);
		
		$p1 = new PiePlot($datos);
		$p1->SetLabelPos(0.7);
		$p1->SetLegends($leyenda);
		//$p1->ExplodeAll();
		$p1->SetCenter(1);
		
		$grafico->legend->SetAbsPos(5,250,'right','top');
		$grafico->Add($p1);
		//$grafico->legend->SetPos(0.85, 0.3,’center’,’right’);
		
		$grafico->legend->SetColumns(1);
		$grafico->img->SetImgFormat("png");
		if(file_exists(PATH_IMAGE."/graficas/imagen.png")) unlink(PATH_IMAGE."/graficas/imagen.png");
		$grafico->Stroke(PATH_IMAGE."/graficas/imagen.png");
		return $grafico;
	}

	public function docentes() {
		$model = new MateriaDocenteModel();
		$datos = $model->getlistadoDocentes();
		$message = "";
		require_once PATH_VIEWS."/Reporte/view.listDocentes.php";
	}
}