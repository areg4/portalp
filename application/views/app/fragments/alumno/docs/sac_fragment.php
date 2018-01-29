<h2 style="text-align:center;  width:400px; font-size: 16px; position: absolute; top:50px; left:180px; z-index:0 !important;">
	<?=$sac->nombreSac?> <br/>
	<?=fancy_date($sac->fechaInicio,'d-m')?> al <?=fancy_date($sac->fechaFin,'d-m')?>
</h2>

<div style="position: absolute; top:150px; left:25px; width:700px; z-index:200 !important;">
	<table style="font-size: 14px; width:650px; position:relative;border-collapse: collapse; margin:30px 0 0 0;" cellpadding="1" cellspacing="0">
		<tr>
			<td style="width:40%;"><b>EXPEDIENTE:</b></td> <td><?=$alumno->expediente?></td>
		</tr>
		<tr>
			<td style="width:40%;"><b>NOMBRE:</b></td> <td><?=$alumno->apellidoPaterno.' '.$alumno->apellidoMaterno.' '.$alumno->nombre?> </td>
		</tr>
		<tr>
			<td style="width:40%;"><b>PLAN:</b></td> <td> <?=$plan->cvePlan?></td>
		</tr>
		<tr>
			<td style="width:40%;"><b>FECHA DE IMPRESIÓN:</b></td> <td><?=$fechaImpresion?> </td>
		</tr>
	</table>		
	<table style=" width:700px; position:relative;border-collapse: collapse; margin:80px auto 0 auto;"  cellpadding="2" cellspacing="0">
		
		<tbody style="font-size:12px;">
			<?php 
				if(!is_null($codigos)){
					$totalCreditos = 0; 
					foreach ($codigos as $row) {
						//die(var_dump($row['eventos']));
					if(count($row['eventos']) > 0):
			?>
			<tr>
				<td colspan="4" style="font-size:12px; border: 1px solid; border-color: #000; text-align:left;"><b><?=$row['dia']?></b></td>	
			</tr>
			
			<?php 		
					
						for ($i = 0; $i < count($row['eventos']); $i++) {
							$totalCreditos = $totalCreditos +$row['eventos'][$i]->puntos;
					
			?>
				<tr>
					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;"><?=$row['eventos'][$i]->nombreEvento?></td>
					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;"><?=$row['eventos'][$i]->nombreTipoEvento?></td>
					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:center; padding-left:5px;"><?=$row['eventos'][$i]->horaInicio.' - '.$row['eventos'][$i]->horaFin?></td>
					<td style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;"><?=$row['eventos'][$i]->puntos?> Puntos</td>
				</tr>
			<?php
						}
					endif;
					}
				}
			?>	
			<tr style="border:none !important;">
				<td align="center" style="font-size:12px; border:none; text-align:center;" colspan="3"></td>
				<td align="center" style="font-size:12px; border: 1px solid; border-color: #000; text-align:center;"><b><?=$totalCreditos?> PUNTOS TOTALES</b></td>
			</tr>
		</tbody>
	</table>		
	
	
</div>