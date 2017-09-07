<?php
use Dompdf\Options;
use Dompdf\Dompdf;
require_once (PATH_MODELS . "/ReporteModel.php");
require_once (PATH_HELPERS."/dompdf/autoload.inc.php");
require_once (PATH_HELPERS."/dompdf/src/FontMetrics.php");

class ReporteController {
	
	public function listar(){
		$model = new ReporteModel();
		$id = $_SESSION['SESSION_USER']->usuario_id;
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
									<img src='".PATH_IMAGES."/san_gabriel.jpg' style='height: 50px; margin-bottom: 5px;'>
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
				</tr>
			</table></body></html>";
		$options = new Options();
		$options->set('isHtml5ParserEnabled', true);
		$dompdf = new Dompdf($options);
		$dompdf->load_html($html);
		
		$dompdf->render();
		$canvas = $dompdf->get_canvas();
		// $font = FontMetrics::getFont("helvetica", "bold");
		$canvas->page_text(550, 750, "{PAGE_NUM}", $font, 6, array(0,0,0)); //header		
		$dompdf->stream('general', array("Attachment"=>false));
		
	}
}