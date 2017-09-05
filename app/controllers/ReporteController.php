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
	public function verPdf(){
		$model = new ReporteModel();
		$id = $_GET ['id'];
		$datos_cab = self::obtenerDatosCab($id)[0];
		$respuestas = self::obtenerRespuestas();
		
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
								<td rowspan='3'>Preguntas
								</td>										
								<td colspan='4'>Valor del Grado de Acuerdo con las siguientes afirmaciones</td>
							</tr>
							<tr>";		
							foreach ($respuestas as $res){
								$html.="<td>".$res->nombre."</td>";							
							}
		$html .="	</tr>";
							foreach ($respuestas as $res){
								$html.="<td>".$res->valor."</td>";
							}
		$html .="	</tr>				
						</table>";
		$html .="</body></html>";		
		
		$options = new Options();
		$options->set('isHtml5ParserEnabled', true);
		$dompdf = new Dompdf($options);
		$dompdf->load_html($html);
		
		$dompdf->render();
		$canvas = $dompdf->get_canvas();
		// $font = FontMetrics::getFont("helvetica", "bold");
		$canvas->page_text(550, 750, "Pág. {PAGE_NUM}/{PAGE_COUNT}", $font, 6, array(0,0,0)); //header
		$canvas->page_text(270, 770, "Copyright © 2017", $font, 6, array(0,0,0)); //footer
		$dompdf->stream('general', array("Attachment"=>false));
		
	}
}