<div style="position: absolute; padding-top:180px; left:25px; width:700px; z-index:200 !important; font-family: sans-serif !important;">
	<table style="font-size: 14px; width:600px; position:relative; border-collapse: collapse; margin-left: 30px; margin-top: 30px; height: auto;" cellpadding="1" cellspacing="0">
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

	<table style="font-size: 14px; width:600px; position:relative; border-collapse: collapse; margin-left: 30px; height: auto; margin-top: 50px; text-align: justify;" cellpadding="1" cellspacing="0">
		<tr>
			<td>Comunico a usted que en sesión ordinaria del H. Consejo Académico de la Facultad de Informática, celebrada el <?=fancy_date($fechaCon)?>, se emitió.</td>
		</tr>

		<tr>
			<td style="padding-left: 70px; padding-right: 70px; padding-top: 30px; box-sizing: border-box; text-align: center;"><b>Dictamen: <?=$decision?></b></td>
		</tr>

		<tr>
			<td style="padding-top: 30px; box-sizing: border-box;">A su solicitud de aprobación de opción de Titulación por Tesis Individual denominada: "<?=$nombreTrabajo?>", perteneciente al programa de <?=$plan->nombrePlan?>.</td>
		</tr>
		<tr>
			<td style="padding-top: 30px; box-sizing: border-box;">Sin otro particular, me es grato saludarle.</td>
		</tr>
	</table>

	<p style="width:700px;  margin-top: 50px;  text-align:center; font-size:14px; display:block;">
		<b>A T E N T A M E N T E <br> "RAZONAMIENTO Y TECNOLOGÍA PARA INNOVAR Y TRASCENDER"</b>
	</p>
	<table style="font-size: 14px; width: 700px; position:relative; margin:50px auto 0 auto; text-align:center;">
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
	C.C.P SERVICIOS ESCOLARES
</h2>
<h2 style="text-align:center;  width:200px; font-size: 12px; position: absolute; bottom:5px; right:0px; z-index:0 !important; font-style:italic; font-weight:100;">
	Pag. 1/1
</h2>
