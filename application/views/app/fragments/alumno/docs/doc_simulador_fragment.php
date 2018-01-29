<h2 style="text-align:center;  width:400px; font-size: 12px; position: absolute; top:50px; left:150px; z-index:0 !important;">
	SIMULADOR DE MATERIAS <br/>
	<?=fancy_date($periodo->fechaInicio,'m')?> - <?=fancy_date($periodo->fechaFin,'m-y')?>
</h2>

<div style="position: absolute; top:200px; left:25px; width:700px; z-index:200 !important;">
	<table style="font-size: 12px; width:650px; position:relative;border-collapse: collapse; margin:10px 0 0 0;" cellpadding="1" cellspacing="0">
		<tr>
			<td style="width:20%;"><b>EXPEDIENTE:</b></td> <td><?=$alumno->expediente?></td>
		</tr>
		<tr>
			<td style="width:20%;"><b>NOMBRE:</b></td> <td><?=$alumno->apellidoPaterno.' '.$alumno->apellidoMaterno.' '.$alumno->nombre?> </td>
		</tr>
		<tr>
			<td style="width:20%;"><b>CARRERA:</b></td> <td> <?=$plan->cvePlan?></td>
		</tr>
		<tr>
			<td style="width:20%;"><b>FECHA DE IMPRESIÓN:</b></td> <td><?=$fechaImpresion?> </td>
		</tr>
	</table>		
	<table style=" width:700px; position:relative;border-collapse: collapse; margin:50px auto 0 auto;"  cellpadding="2" cellspacing="0">
		<thead style="font-weight:bold; font-size:12px; text-align:center;">
			<tr>
				<td rowspan="2" style="border: 1px solid; border-color: #000;">GRUPO</td>
				<td rowspan="2" style="border: 1px solid; border-color: #000;">CLAVE MATERIA</td>
				<td rowspan="2" style="border: 1px solid; border-color: #000;">NOMBRE DE LA MATERIA</td>
				
				<td rowspan="2" style="border: 1px solid; border-color: #000;">PROFESOR</td>
				<td colspan="5" style="border: 1px solid; border-color: #000;">HORARIO</td>
			</tr>
			<tr>
				<td style="border: 1px solid; border-color: #000;">LUN</td>
				<td style="border: 1px solid; border-color: #000;">MAR</td>
				<td style="border: 1px solid; border-color: #000;">MIE</td>
				<td style="border: 1px solid; border-color: #000;">JUE</td>
				<td style="border: 1px solid; border-color: #000;">VIE</td>
			</tr>
		</thead>
		<tbody style="font-size:12px;">
			<?php 
				if(!is_null($materias)){
					foreach ($materias as $row) {
			?>
				<tr>
					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;"><?=$row->grupo?></td>
					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;"><?=$row->cveMateriaShow?></td>
					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:left; padding-left:5px;"><?=$row->nombreMateria?></td>
					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;"><?=$row->nombreMaestro?></td>

					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;"><?=$row->lu_1 .'-'.$row->lu_2.'<br/>'.$row->lu_a?></td>
					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;"><?=$row->ma_1 .'-'.$row->ma_2.'<br/>'.$row->ma_a?></td>
					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;"><?=$row->mi_1 .'-'.$row->mi_2.'<br/>'.$row->mi_a?></td>
					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;"><?=$row->ju_1 .'-'.$row->ju_2.'<br/>'.$row->ju_a?></td>
					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;"><?=$row->vi_1 .'-'.$row->vi_2.'<br/>'.$row->vi_a?></td>
				</tr>
			<?php
					}
				}
			?>	
			
		</tbody>
	</table>		
	<p style="width:700px;  margin:150px 0 0  0;  text-align:center; font-size:12px; display:block; font-family:sans-serif !important;">
		<b>FIRMAS</b>
	</p>
	<table style="font-size: 12px; width:650px; position:relative; margin:80px auto 0 auto; text-align:center; font-weight:bold;">
			<tbody>
				<tr>
				<td align="center">
						____________________________________
						 <br>
						Alumno

					</td>
					<td align="center">
						____________________________________
						<br>
						Vo. Bo.
					</td>
					
				</tr>
			</tbody>
		</table>
	<!-- AQUI VA LA NOTA -->
	<h2 style="text-align:justify;  width:650px; font-size: 12px; position: relative; margin-top: 40px; z-index:0 !important; font-style:italic; font-weight:100;">
		Recuerda que el simulador te apoya a crear tu horario pero para hacerlo de manera oficial, deberás realizarlo en el portal de la U.A.Q.
	</h2>
</div>



<h2 style="text-align:center;  width:200px; font-size: 12px; position: absolute; bottom:5px; left:0px; z-index:0 !important; font-style:italic; font-weight:100;">
	C.C.P SERVICIOS ESCOLARES
</h2>
<h2 style="text-align:center;  width:200px; font-size: 12px; position: absolute; bottom:5px; right:0px; z-index:0 !important; font-style:italic; font-weight:100;">
	Pag. 1/1
</h2>