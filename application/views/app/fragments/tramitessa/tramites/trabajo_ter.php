<div style="position: absolute; padding-top:200px; left:25px; width:700px; z-index:200 !important; font-family: sans-serif !important;">
	<table style="font-size: 14px; width:600px; position:relative; border-collapse: collapse; margin-left: 50px; height: auto;" cellpadding="1" cellspacing="0">
		<tr>
			<td style="width:20%; height: 20px;"><b>C. <?=$alumno->apellidoPaterno.' '.$alumno->apellidoMaterno.' '.$alumno->nombre?></b></td>
		</tr>
		<tr>
			<td style="width:20%; height: 20px;"><b><?=$alumno->expediente?></b></td>
		</tr>
		<tr>
			<td style="width:20%; height: 20px;"><b>PRESENTE</b></td>
		</tr>
	</table>

	<table style="font-size: 14px; width:600px; position:relative; border-collapse: collapse; margin-left: 50px; height: auto; margin-top: 30px; text-align: justify;" cellpadding="1" cellspacing="0">
		<tr>
			<td>En relación a su solicitud de Autorización del Trabajo Terminado, comunico a usted, que en sesión <?=$tipoSesion?> del día <?=fancy_date($fechaCon)?>, el H. Consejo Académico de esta Facultad determinó:</td>
		</tr>

		<tr>
			<?php if ($decision=="autorizar"): ?><td style="padding-left: 70px; padding-right: 70px; padding-top: 30px; box-sizing: border-box;"><?=$decision?> según lo establecido al capítulo VII Titulación y Obtención de Grado, Artículo 95 Numeral III del Reglamento de Estudiantes de la Universidad Autónoma de Querétaro, por <b>MEMORIA DE TRABAJO PROFESIONAL</b>, denominada: "<?=$nombreTrabajo?>" en virtud de presentar la aceptación de su asesor <b><?=$maestro->nombreMaestro?></b> docente de la Facultad de Informática.</td>
			<?php else: ?><td style="padding-left: 70px; padding-right: 70px; padding-top: 30px; box-sizing: border-box;"><?=$decision?> según lo establecido al capítulo VII Titulación y Obtención de Grado, Artículo 95 Numeral III del Reglamento de Estudiantes de la Universidad Autónoma de Querétaro, por <b>MEMORIA DE TRABAJO PROFESIONAL</b>, denominada: "<?=$nombreTrabajo?>".</td>
			<?php endif; ?>
		</tr>

		<tr>
			<td style="padding-top: 30px; box-sizing: border-box;">Sin otro particular por el momento, hago propicia la ocasión para enviarle un cordial saludo, y quedo a sus órdenes para cualquier comentario al respecto.</td>
		</tr>
	</table>

	<p style="width:700px;  margin-top: 60px;  text-align:center; font-size:14px; display:block;">
		<b>A T E N T A M E N T E <br> "RAZONAMIENTO Y TECNOLOGÍA PARA INNOVAR Y TRASCENDER"</b>
	</p>
	<table style="font-size: 14px; width: 700px; position:relative; margin:70px auto 0 auto; text-align:center;">
			<tbody>
				<tr>
					<td align="center">
						<b>MSI. GABRIELA XICOTÉNCATL RAMÍREZ<br>SECRETARIA DEL H. CONSEJO ACADÉMICO</b>
					</td>	
				</tr>
			</tbody>
		</table>
</div>

<h2 style="text-align:center;  width:200px; font-size: 12px; position: absolute; bottom:5px; left:0px; z-index:0 !important; font-style:italic; font-weight:100;">
	C.C.P <i class="fa fa-folder-o"></i> Acta <?=$noActa?>
</h2>
<h2 style="text-align:center;  width:200px; font-size: 12px; position: absolute; bottom:5px; right:0px; z-index:0 !important; font-style:italic; font-weight:100;">
	Pag. 1/1
</h2>