<?php


?>


<div style="width:21cm;height:29.7cm;margin:0;" >

<table style="width: 100%; font-size: 12px; border: 1px solid black; font-family:times new roman; font-style:bold;">


		<tr>
			<td align="left" rowspan="3"><img alt="" src="/img/mc.jpg"></td>
			<th align="left">MC Multicode SA de CV</th>
			<th align="right"  style="background: #d4d6d8;">No. de orden</th>			
		</tr>
		<tr>
			<td align="left"><small><font  color="blue">http://www.mccode.com</font></small></td>
			<th align="right" rowspan="2"  style="background: #d4d6d8;"><?=$model->numero_orden; ?></th>
						
		</tr>
		<tr>
			<td align="left"><small>Calle de los prados #7, Cd. Neza, Edo. de Mexico, CP 678124</small></td>
			
		</tr>
	
</table>

<br />

<table  style="width:100%; font-size: 10px; border: 1px solid black; font-family:times new roman;">
			
		<tr>
			<td style=" width: 20%;"></td>
			<td style=" width: 40%;"></td>
			<td style=" width: 20%;"></td>
			<td style=" width: 20%;"></td>
		</tr>	
		
		<tr>
			
			<th align="left" style="background: #d4d6d8;"  >Numero de serie</th>
			<td align="left" ><?=$model->numero_serie;?></td>
			
					
		</tr>
		<tr>
			<th align="left" style="background: #d4d6d8" >Codigo</th>
			<td align="left"><?=isset( $model->codigo_registro);?></td>
		</tr>
		<tr>
			<th align="left" style="background: #d4d6d8" >Fecha de creación</th>
			<td align="left"><?=$model->fecha_fabricacion;?></td>	
		</tr>
		<tr>
			<th align="left" style="background: #d4d6d8" >Precio</th>
			<td align="left"><?=isset( $model->precio_sugerido);?></td>
		</tr>
		<tr>
			<th align="left" style="background: #d4d6d8" >Tipo de producto</th>
			<td><?=isset($model->tipoProducto)?$model->tipoProducto->getCategoriaProducto() .' - '.$model->tipoProducto->nombre:' -- ';?></td>
			
		</tr>
		

	
</table>



<br />

<table border="0.5"  style="width:100%; font-size: 12px; border: 1px dotted gray; font-family:times new roman;">
		
	</table>

</div>