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
		if(count($preguntas) >0){		
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
									<td style='text-align:left' rowspan=2>
										<img src='".PATH_IMAGE."/san_gabriel.jpg' style='height: 80px; margin-bottom: 5px;'>
									</td>
									<td style='font-size:20px;text-align:left' colspan='5'>
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
									<td width='150px'><b>Fecha de Evaluación:</b></td><td style='text-align:left'>".$preguntas[0]->fecha_evaluacion."</td>
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
			$html .="</table>";


			self::grafico($perc,1);
			self::grafico($perc1,2);
			
			$html.="<br>
					<br>
					<div style='page-break-after:always;'></div>		
						<table width= 100% border=0>
							<tr>
								<td style='text-align:left:width:10%'>
									<img src='".PATH_IMAGE."/san_gabriel.jpg' style='height: 80px; margin-bottom: 5px;'>
								<td style='text-align:center'>			
									<span style='text-align:center;font-size:20px'><b>Análisis e Interpretación de Resultados</b></span>
								</td>										
							</tr>
						</table>
						<table width= 100% border=0 >
							<tr>
								<td align='center'>
											<span style='text-align:center;font-size:15px'><b>Gestión del Docente</b></span><br>
								</td>
							</tr>			
							<tr>
								<td align='justify'>
											Entre la población estudiantil encuestada se encontraron los siguiente datos: Por un "
											.$perc[3]."% que está totalmente deacuerdo con la gestión del docente, un "
											.$perc[2]."% que está deacuerdo, un "
											.$perc[1]."% que está en desacuerdo y un "										
											.$perc[0]."% que está totalmente desacuerdo.
								</td>
							</tr>
							<tr>
								<td align='center'>
									<img src=".PATH_IMAGE."/graficas/imagen.png>
								</td>
							</tr>
							<tr>
								<td align='center'>
											<span style='text-align:center;font-size:15px'><b>Asistencia del Docente</b></span><br>
								</td>
							</tr>			
							<tr>
								<td align='justify'>
											Entre la población estudiantil encuestada se encontraron los siguiente datos: Por ";
							if($perc1[3] >0){
								$html.=	" un ".$perc1[3]."% que está totalmente deacuerdo que el docente nunca falto a clases";
							}
							if($perc1[2] >0){
								$html.= " un ".$perc1[2]."% que esta deacuerdo que el docente falto a clases";
							}
							if($perc1[1] >0){
								$html.= " un ".$perc1[1]."% que está en desacuerdo que el docente falto a clases";
							}
							if($perc1[0] >0){
								$html.= " un ".$perc1[1]."% que el docente nunca asistió a clases.";
							}
																					
						$html.="</td>
							</tr>
							<tr>
								<td align='center'>								
									<img src=".PATH_IMAGE."/graficas/imagen1.png>
								</td>
							</tr>
						</table>	
					</body></html>";

			$options = new Options();
			$options->set('isHtml5ParserEnabled', true);

			$dompdf = new Dompdf($options);
			$dompdf->load_html($html);

			$dompdf->render();
			$canvas = $dompdf->get_canvas();
			$canvas->page_text(550, 750, "{PAGE_NUM}", $font, 6, array(0,0,0)); //header		
			$dompdf->stream('general', array("Attachment"=>false));		
		} else {
			echo "No exiten datos para generar el reporte Solicitado!.";
		}	
	}
	
	public function grafico($datos,$imagen){
		$leyenda = array("Nunca","En Desacuerdo","Deacuerdo","Totalmente Deacuerdo");
		
		$grafico = new PieGraph(550,300);
		$grafico->SetShadow();
		
		$p1 = new PiePlot($datos);
		$p1->SetLabelPos(0.7);
		$p1->SetLegends($leyenda);
		$p1->SetCenter(1);
		
		$grafico->legend->SetAbsPos(1,50,'right','top');
		$grafico->legend->SetFillColor('#dff0d8');
		
		$grafico->Add($p1);
		//$grafico->legend->SetPos(0.85, 0.3,’center’,’right’);
		
		$grafico->legend->SetColumns(1);
		$grafico->img->SetImgFormat("png");
		if($imagen ==1){
			if(file_exists(PATH_IMAGE."/graficas/imagen.png")) unlink(PATH_IMAGE."/graficas/imagen.png");
			$grafico->Stroke(PATH_IMAGE."/graficas/imagen.png");
		}else{
			if(file_exists(PATH_IMAGE."/graficas/imagen1.png")) unlink(PATH_IMAGE."/graficas/imagen1.png");
			$grafico->Stroke(PATH_IMAGE."/graficas/imagen1.png");
		}
		return $grafico;
	}

	public function docentes() {
		$model = new MateriaDocenteModel();
		$datos = $model->getlistadoDocentes();
		$message = "";
		require_once PATH_VIEWS."/Reporte/view.listDocentes.php";
	}
	
	//Administrativo
	public function docentesAdmin() {
		$model = new MateriaDocenteModel();
		$datos = $model->getlistadoDocentes();
		$message = "";
		require_once PATH_VIEWS."/Reporte/view.listDocAdmin.php";
	}
	
	public function listarAdminByDocente(){
		$model = new ReporteModel();
		$id = $_SESSION['SESSION_USER']->usuario_id;
		if($_SESSION['SESSION_USER']->tipo_usuario_id ==1) {
			$id = $_GET['id'];
		}
		$usuario = $model->getUsuario($id)[0];
		
		$datos = $model->getlistadoAdminByDocente($id);
		$message = "";
		require_once PATH_VIEWS."/Reporte/view.listAdministrativos.php";
	}
	
	
	public function obtenerPreguntasAdmin($id){
		$model = new ReporteModel();
		$datos = $model->getPreguntasAdmin($id);
		$array = self::array_elimina_duplicados($datos);
		foreach ($datos as $dato){
			foreach ($array as $a){
				if($a->pregunta_id == $dato->pregunta_id){
					if($dato->respuesta_id == 5){
						$a->res1 = $dato->respuesta;
					}
					if($dato->respuesta_id == 6){
						$a->res2 = $dato->respuesta;
					}					
				}
			}
		}
		return $array;
	}
	public function verPdfAdmin(){
		$model = new ReporteModel();
		$id = $_GET ['id'];
		$datos_cab = self::obtenerDatosCabAdmin($id)[0];
		$respuestas = $model->getRespuestasAdmin();
		$preguntas = self::obtenerPreguntasAdmin($id);
		
		//if(count($preguntas) >0){
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
									<td style='text-align:left' rowspan=2>
										<img src='".PATH_IMAGE."/san_gabriel.jpg' style='height: 80px; margin-bottom: 5px;'>
									</td>
									<td style='font-size:20px;text-align:left' colspan='5'>
										<b>INSTITUTO TECNOLÓGICO SUPERIOR SAN GABRIEL</b>
									</td>
								</tr>
								<tr>
									<td style='font-size:14px;text-align:center' colspan='6'><b>Evaluación de Autoridades a Docentes ".$datos_cab->periodo_nombre."</b></td>
								</tr>
							</table>
							<br>
							<table border=0>
									<tr>
									<td width='60px'><b>Área:</b></td><td style='text-align:left'>".$datos_cab->espe_nombre."</td>
									<td width='60px'><b>Docente:</b></td style='text-align:left'><td style='text-align:left'>".$datos_cab->docente_nombre." ".$datos_cab->docente_apellido."</td>
									<td width='150px'><b>Fecha de Evaluación:</b></td><td style='text-align:left'>".$datos_cab->fecha_evaluacion."</td>
								</tr>								
							</table>
							<br>
							<table>
								<tr>
									<td style='text-align:center'><b>Detalle</b></td>";
									foreach ($respuestas as $res){
										$html.="<td style='text-align:center'><b>".$res->nombre."</b></td>";
									}									
			$html .="	</tr>	";
			$total = 0;
			$total1 = 0;
			$total2 = 0;
			foreach ($preguntas as $preg){
					$total_preg = ($preg->res1 > $preg->res2)?$preg->res1:$preg->res2;
					$total += $total_preg;
					$total1 += $preg->res1;
					$val1 = ($preg->res1 != null)?'x':null;
					$total2 += $preg->res2;
					$val2 = ($preg->res2 != null)?'x':null;
						
					$html .="	<tr><td>".$preg->pregunta_nombre."</td>";
					$html .="		<td style='text-align:center'>".$val1."</td>";
					$html .="		<td style='text-align:center'>".$val2."</td></tr>";
			}
			$html .="<tr><td style='text-align:center'><b>TOTAL</b></td>
						 <td style='text-align:center'>".$total1."</td>
						 <td style='text-align:center'>".$total2."</td>						 
					</tr></table>
					<br><br>
					<table width='50%' align='center'>
						<tr>
						 	<td align='center'><b>RANGO</b></td>	
						 	<td align='center'><b>VALORACIÓN</b></td>	
						</tr>
						<tr>
						 	<td align='center'>7 a 8 puntos</td>	
						 	<td align='center'>Correcta</td>	
						</tr>
						<tr>
						 	<td align='center'>4 a 6 puntos</td>	
						 	<td align='center'>Aceptable</td>	
						</tr> 		
						<tr>
						 	<td align='center'>Menos de 3 puntos</td>	
						 	<td align='center'>Mejorable</td>	
						</tr>
						<tr>
						 	<td colspan='2' height='15px'></td>						 		
						</tr> 		
						<tr>
						 	<td align='center'>Resultado de Evaluación</td>	
						 	<td align='center'>".$total1."</td>	
						</tr> 		
					</table>
					<br>
					<br>
					<span style='font-size:9pt;'>El/La Docente tiene una valoración de ".$total_preg.", respecto a su evaluación por parte de autoridades,
					y es considerado/a para seguir colaborando en calidad de docente en la institución.</span>
					<br>
					<br>
					<br>
					<br>
					<br>			
					<table width='100%' border='0'>
						<tr>
							<td align='center'>_______________________________</td>
							<td align='center'>_______________________________</td>
						</tr>	
						<tr>
							<td align='center'>Ing.Gabriela Vallejo</td>
							<td align='center'>Mgs. Mauro Gavilánez H.</td>
						</tr>
						<tr>
							<td align='center'><b>RECTOR</b></td>
							<td align='center'><b>VICERRECTOR</b></td>
						</tr>		
					</table>		
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
	
	public function obtenerDatosCabAdmin($id){
		$id_array = explode('-', $id);
		$model = new ReporteModel();
		$datos = $model->getDatosCabeceraAdmin($id_array[1]);
		return $datos;
	}
}