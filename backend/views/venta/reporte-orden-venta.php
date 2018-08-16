<?php


?>


<div style="width:21cm;height:29.7cm;margin:0;" >

<table style="width: 100%; font-size: 12px; border: 1px solid black; font-family:times new roman; font-style:bold;">


		<tr>
			<td align="left" rowspan="3"><img alt="" src="/img/mc.jpg"></td>
			<th align="left">Multicode SA de CV</th>
			<th align="right"  style="background: #d4d6d8;">No. de orden</th>			
		</tr>
		<tr>
			<td align="left"><small><font  color="blue">http://www.multicode.com.mx/</font></small></td>
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
			
			<th align="left" style="background: #d4d6d8;"  >Cliente</th>
			<td align="left" ><?=$model->clave_proveedor;?></td>
			
			<td align="left" colspan="2" ><?=isset( $model->claveProveedor)?$model->claveProveedor->nombre : 'Sin cliente' ;?></td>
					
		</tr>
		<tr>
			<th align="left" style="background: #d4d6d8" >Dirección</th>
			<td align="left"><?=isset( $model->claveProveedor)?$model->claveProveedor->direccion : 'Sin cliente' ;?></td>
			<th align="right" style="background: #d4d6d8" >Fecha elaboración</th>
			<td align="right"><?=$model->fecha_venta;?></td>
	
						
		</tr>
		<tr>
			<th align="left" style="background: #d4d6d8" >Telefono</th>
			<td align="left"><?=isset( $model->claveProveedor)?$model->claveProveedor->telefono : 'Sin telefono' ;?></td>
			<th align="right" style="background: #d4d6d8" >Modo pago</th>
			<td align="right">Contado</td>
		</tr>

	
</table>



<br />

<table border="0.5"  style="width:100%; font-size: 12px; border: 1px dotted gray; font-family:times new roman;">
		<tr>
			<th align="left" style="background: #d4d6d8;" >Item</th>
			<th align="left" style="background: #d4d6d8;">Numero serie</th>
			<th align="left" style="background: #d4d6d8;">Codigo desbloqueo</th>				
			<th align="left" style="background: #d4d6d8;">Nombre</td>
			<th align="left" style="background: #d4d6d8;">Precio unitario</td>
		</tr>
		<tbody>
			
			<?php $i=0; foreach ($model->productos as $producto):?>
			<tr>
			<td><?=++$i; ?></td>
			<td><?=$producto->numero_serie; ?></td>
			<td><?=$producto->codigo_registro; ?></td>
			<td><?=isset($producto->tipoProducto)?$producto->tipoProducto->getCategoriaProducto() .' - '.$producto->tipoProducto->nombre:' -- ';?></td>
			<td align="right"><?=$producto->precio_sugerido; ?></td>
			</tr>
			<?php  endforeach;?>
		</tbody>
		
		<tfoot>
				
				<tr>
					<td colspan="4" align="right" style="background: #d4d6d8;">Sub total</td>
						<td  align="right">$ <?=$model->precio_publico; ?></td>
				</tr>
				
				<tr>
					<td colspan="4" align="right" style="background: #d4d6d8;">+ IVA 16 % <?=($model->iva)?'':'(no aplica)'; ?></td>
						<td  align="right">$ <?=($model->iva)? $model->precio_publico * 1.16 : $model->precio_publico ?></td>
				</tr>
				
				
				<tr>
					<td colspan="4" align="right" style="background: #d4d6d8;">- Descuento</td>
					<td  align="right"><?=$model->descuento; ?> %</td>
				</tr>
				
				
				<tr>
					<td colspan="4" align="right" style="background: #d4d6d8;">Total</td>
					<td  align="right">$ <?=$model->monto_total; ?></td>
				</tr>
				
			</tfoot>
		
	</table>

</div>