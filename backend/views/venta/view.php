<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Venta */

$this->title = 'Ver orden de venta No. ' . $model->numero_orden;
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-eye fa-stack-1x"></i>
							   </span>';
?>
<div class="row">

<div class="col-md-5 col-xs-12 col-sm-12" >


<h2>
<i class="fa fa-list"></i> Datos de la orden
</h2>


	<?php 
	
	$tipoPago = ['1' => 'Tarjeta de credito', '2' => 'Tarjeta de debito', '3' => 'Contado', '4' => 'Transferencia', '5' =>'Cheque'];
	$descuento = [10 => '10 %', 20 => '20 %', 25 => '25 %', 30 => '30 %', 50 =>'50 %'];
	?>
    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'numero_orden',
        		[
        		'attribute'=>'clave_proveedor',
        		'type'=>'html',
        		'value'=> $model->clave_proveedor . ' - ' .$model->claveProveedor->nombre ,
        		],
        		
        		[
        		'attribute'=>'precio_publico',
        		'type'=>'html',
        		'value'=>'$ ' . $model->precio_publico,
        		],
            
            'fecha_venta',
            [
        		'attribute'=>'garantia',
        		'type'=>'html',
        		'value'=> $model->garantia . ' Meses',
        		],
        		[
        		'attribute'=>'seguro_robo',
        		'type'=>'html',
        		'value'=> ($model->seguro_robo)? 'Si' : ' No',
        		],
            'comentarios',
        		[
        		'attribute'=>'tipo_pago',
        		'type'=>'html',
        		'value'=> isset($tipoPago[$model->tipo_pago])? $tipoPago[$model->tipo_pago] : 'No definido',
        		],
        		[
        		'attribute'=>'descuento',
        		'type'=>'html',
        		'value'=> isset($descuento[$model->descuento])? $descuento[$model->descuento] : 'No definido',
        		],
        		[
        		'attribute'=>'monto_total',
        		'type'=>'html',
        		'value'=>'$ ' . $model->monto_total
        		],
        ],
    ]) ?>


</div>

<div class="col-md-7 col-xs-12 col-sm-12" >

<h2>
<i class="fa fa-cubes"></i> Productos en la orden
</h2>

		<table class="table table-hover table-condensed table-bordered">
		
			<thead>
				<tr>
					<th>#Serie</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Codigo desbloqueo</th>
					
					<th>($) Precio </th>
				</tr>
			</thead>
			
			<tbody>
				<?php
				$total = 0.0;
				foreach ($model->productos as $producto): ?>
				
					<tr>
						<td><?= $producto->numero_serie;?></td>
						<td><?=  $producto->tipoProducto->getCategoriaProducto() . ' - '. $producto->tipoProducto->nombre;?></td>
						<td><?= $producto->tipoProducto->descripcion;?></td>
						<td><?= $producto->codigo_registro;?></td>
						<td><?= $producto->precio_sugerido;?></td>
					</tr>
						<?php $total+= $producto->precio_sugerido;?>
				
				<?php endforeach;?>
			</tbody>
			
			<tfoot>
				
				<tr>
					<td colspan="4" align="right">Sub total</td>
						<td>$ <?=$model->precio_publico; ?></td>
				</tr>
				
				<tr>
					<td colspan="4" align="right">+ IVA 16 % <?=($model->iva)?'':'(no aplica)'; ?></td>
						<td>$ <?=($model->iva)? $model->precio_publico * 1.16 : $model->precio_publico ?></td>
				</tr>
				
				
				<tr>
					<td colspan="4" align="right">- Descuento</td>
					<td><?=$model->descuento; ?> %</td>
				</tr>
				
				
				<tr>
					<td colspan="4" align="right">Total</td>
					<td>$ <?=$model->monto_total; ?></td>
				</tr>
				
			</tfoot>
		
		</table>
		

    <p>
        <!--<?php echo Html::a('Actualizar', ['update', 'id' => $model->numero_orden], ['class' => 'btn btn-primary']) ?>-->
       <!--   <?php echo Html::a('Eliminar esta venta', ['delete', 'id' => $model->numero_orden], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Esta seguro de borrar esta venta ?',
                'method' => 'post',
            ],
        ]) ?>-->
        <?php echo Html::a('<i class="fa fa-print"></i> Imprimir', ['reporte-orden-venta', 'id' => $model->numero_orden], ['class' => 'btn btn-primary','target'=>'_blank']) ?>
    </p>


</div>
</div>
