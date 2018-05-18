<div style="position: absolute; padding-top: 200px; left:25px; width:700px; z-index:200 !important; font-family: sans-serif !important;">
	<table style="font-size: 14px; width:600px; position:relative; border-collapse: collapse; margin-left: 50px; height: auto; margin-top: 30px;" cellpadding="1" cellspacing="0">
		<tr>
			<td style="width:50%; height: 15px;"><b>M. EN C. DARÍO HURTADO MALDONADO</b></td>
			
		</tr>
		<tr>
			<td style="width:20%; height: 15px;"><b>DIRECTOR DE SERVICIOS ACADÉMICOS, UAQ</b></td>
		</tr>
		<tr>
			<td style="width:20%; height: 15px;"><b>PRESENTE</b></td>
		</tr>
	</table>

	<table style="font-size: 14px; width:600px; position:relative; border-collapse: collapse; margin-left: 50px; height: auto; margin-top: 50px; text-align: justify;" cellpadding="1" cellspacing="0">
		<tr>
			<?php if ($decision=="autorizar"): ?><td>Notifico a usted que en sesión <?=$tipoSesion?> del H. Consejo Académico de esta Facultad, celebrada el día <?=fancy_date($fechaCon)?>, se acordó <?=$decision?> la <b>Readquisión de la Calidad de Pasante</b> al C. <?=$alumno->apellidoPaterno.' '.$alumno->apellidoMaterno.' '.$alumno->nombre?>, con número de expediente <?=$alumno->expediente?>, por un periodo de <?=$tiempoSoli?> en virtud de haber acreditado el Curso de Actualización <b>"<?=$nombreTrabajo?>"</b> en el periodo <?=$periodoCurso?>, según lo establecido en el Artículo 38 de los Lineamientos de Titulación vigentes de esta Facultad, en razón de esto, <b>su Calidad de Pasante vencerá el día <?=fancy_date($fechaVenciPas)?></b></td>
			<?php endif; ?>
			<?php if ($decision=="rechazar"): ?><td>Notifico a usted que en sesión <?=$tipoSesion?> del H. Consejo Académico de esta Facultad, celebrada el día <?=fancy_date($fechaCon)?>, se acordó <?=$decision?> la <b>Readquisión de la Calidad de Pasante</b> al C. <?=$alumno->apellidoPaterno.' '.$alumno->apellidoMaterno.' '.$alumno->nombre?>, con número de expediente <?=$alumno->expediente?>, según lo establecido en el Artículo 38 de los Lineamientos de Titulación vigentes de esta Facultad.</td>
			<?php endif; ?>
		</tr>

		<tr>
			<td style="padding-top: 30px; box-sizing: border-box;">Sin otro particular por el momento, hago propicia la ocasión para enviarle un cordial saludo, y quedo a sus órdenes para cualquier comentario al respecto.</td>
		</tr>
	</table>

	<p style="width:700px;  margin-top: 70px;  text-align:center; font-size:14px; display:block;">
		<b>A T E N T A M E N T E <br> "RAZONAMIENTO Y TECNOLOGÍA PARA INNOVAR Y TRASCENDER"</b>
	</p>
	<table style="font-size: 14px; width: 700px; position:relative; margin:75px auto 0 auto; text-align:center;">
			<tbody>
				<tr>
					<td align="center">
						<b>MISD. CARLOS ALBERTO OLMOS TREJO<br>SECRETARIO DEL H. CONSEJO ACADÉMICO</b>
					</td>	
				</tr>
			</tbody>
		</table>
</div>

<h2 style="text-align:center;  width:200px; font-size: 12px; position: absolute; bottom:5px; left:0px; z-index:0 !important; font-style:italic; font-weight:100;">
	C.C.P Acta <?=$noActa?> 
</h2>
<h2 style="text-align:center;  width:200px; font-size: 12px; position: absolute; bottom:5px; right:0px; z-index:0 !important; font-style:italic; font-weight:100;">
	Pag. 1/1
</h2>