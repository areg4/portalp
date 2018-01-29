<h2 style="text-align:center;  width:400px; font-size: 12px; position: absolute; top:50px; left:150px; z-index:0 !important;">
	PRE-REGISTRO DE MATERIAS <br/>
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
				<td style="border: 1px solid; border-color: #000;">CLAVE MATERIA</td>
				<td style="border: 1px solid; border-color: #000;">NOMBRE DE LA MATERIA</td>
				<td style="border: 1px solid; border-color: #000;">BLOQUE</td>
				<td style="border: 1px solid; border-color: #000;">CRÉDITOS</td>
			</tr>
		</thead>
		<tbody style="font-size:12px;">
			<?php 
				if(!is_null($materias)){
					$totalCreditos = 0; 
					foreach ($materias as $row) {
						$totalCreditos = $totalCreditos +$row->creditos;
			?>
				<tr>
					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;"><?=$row->cveMateria?></td>
					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:left; padding-left:5px;"><?=$row->nombreMateria?></td>
					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;"><?=$row->bloque?></td>
					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;"><?=$row->creditos?></td>
				</tr>
			<?php
					}
				}
			?>	
			<tr style="border:none !important;">
				<td style="border:none !important;"></td>
				<td style="border:none !important;"></td>
				<td align="center" style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;">TOTAL</td>
				<td align="center" style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;"><?=$totalCreditos?></td>
			</tr>
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
	<p style="width:700px;  margin:10px 0 0  0;  text-align:center; font-size:12px; display:block; font-family:sans-serif !important;">
		<b>NOTA:</b> Este documento será necesario para realizar el proceso de registro de materias.
	</p>
</div>

<h2 style="text-align:center;  width:200px; font-size: 12px; position: absolute; bottom:5px; left:0px; z-index:0 !important; font-style:italic; font-weight:100;">
	C.C.P SERVICIOS ESCOLARES
</h2>
<h2 style="text-align:center;  width:200px; font-size: 12px; position: absolute; bottom:5px; right:0px; z-index:0 !important; font-style:italic; font-weight:100;">
	Pag. 1/1
</h2>