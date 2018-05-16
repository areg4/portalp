<div style="position: absolute; padding-top:180px; left:25px; width:700px; z-index:200 !important; font-family: sans-serif !important;">
	<table style="font-size: 14px; width:600px; margin-top: 40px; position:relative; border-collapse: collapse; margin-left: 30px; height: auto;" cellpadding="1" cellspacing="0">
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

	<table style="font-size: 14px; width:600px; position:relative; border-collapse: collapse; margin-left: 30px; height: auto; margin-top: 50px; text-align: justify;" cellpadding="1" cellspacing="0">
		<tr>
			<td>Notifico a usted que en la sesión ordinaria del H. Consejo Académico de la Facultad de Informática, celebrada el día <?=fancy_date($fechaCon)?>, se acordó por unanimidad <?=$decision?> examen voluntario de la materia: <b><?=$materia->nombreMateria?></b> con clave: <b><?=$materia->cveMateria?></b> del siguiente alumno que le sea generada el acta correspondiente. </td>
		</tr>
	</table>

	<table style=" width:600px; margin-left: 30px; margin-top: 30px; position:relative; border-collapse: collapse; text-align: center;">
			<tr style="font-size: 12px;">
				<td style="border: 1px solid; border-color: #000;">ALUMNO</td>
				<td style="border: 1px solid; border-color: #000;">EXP.</td>
				<td style="border: 1px solid; border-color: #000;">PLAN</td>
				
				<td style="border: 1px solid; border-color: #000;">MATERIA (CLAVE)</td>
				<td style="border: 1px solid; border-color: #000;">FECHA</td>
			</tr>
			<tr style="font-size: 12px; padding: 10px; box-sizing: border-box;">
				<td style="border: 1px solid; border-color: #000;"><?=$alumno->apellidoPaterno.' '.$alumno->apellidoMaterno.'<br>'.$alumno->nombre?></td>
				<td style="border: 1px solid; border-color: #000;"><?=$alumno->expediente?></td>
				<td style="border: 1px solid; border-color: #000;"><?=$plan->cvePlan?></td>
				<td style="border: 1px solid; border-color: #000;"><?=$materia->cveMateria.' '.$materia->nombreMateria?></td>
				<td style="border: 1px solid; border-color: #000;"><?=fancy_date($fechaApliExam).'<br>'.$horaI.' hrs <br>a '.$horaF.' hrs.'.'<br>Salón '.$aula?></td>
			</tr>
	</table>

	<table style="font-size: 14px; width:600px; position:relative; border-collapse: collapse; margin-left: 30px; height: auto; margin-top: 20px; text-align: justify;" cellpadding="1" cellspacing="0">		
		<tr>
			<td style="padding-top: 10px; padding-bottom: 30px; box-sizing: border-box;">Siendo su presidente <?=$presidente->nombreMaestro?> con clave <?=$presidente->cveMaestro?> y sus sinodales: <?=$sinodalUno->nombreMaestro?> con clave <?=$sinodalUno->cveMaestro?> y <?=$sinodalDos->nombreMaestro?> con clave <?=$sinodalDos->cveMaestro?>.</td>
		</tr>

		<tr>
			<td style="">Sin más por el momento, y agradeciendo la atención a la presente me despido quedando a sus órdenes para cualquier duda o aclaración al respecto.</td>
		</tr>
	</table>

	<p style="width:700px;  margin-top: 50px;  text-align:center; font-size:14px; display:block;">
		<b>A T E N T A M E N T E <br> "RAZONAMIENTO Y TECNOLOGÍA PARA INNOVAR Y TRASCENDER"</b>
	</p>
	<table style="font-size: 14px; width: 700px; position:relative; margin:60px auto 0 auto; text-align:center;">
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