<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\Proveedor;
use yii\helpers\ArrayHelper;
use backend\models\Producto;
use yii\web\View;
use yii\grid\GridView;
use backend\models\TipoProducto;

/* @var $this yii\web\View */
/* @var $model backend\models\Venta */
/* @var $form yii\bootstrap\ActiveForm */


$dataListProveedor=ArrayHelper::map(Proveedor::findBySql('select clave_proveedor,  CONCAT(clave_proveedor, \' - \',nombre ) as nombre from tbl_proveedor')->all(), 'clave_proveedor', 'nombre');
$dataListProductos=ArrayHelper::map(Producto::findBySql('select pro.numero_serie as numero_serie, concat(pro.numero_serie, \' - \' , tpro.nombre) as descripcion  from tbl_producto pro, tbl_tipo_producto tpro  where pro.tipo_producto = tpro.id_tipo_producto and pro.estado = 1')->all(), 'numero_serie', 'descripcion');


$this->registerJs("
		
			/*Pos end function**/
		
				var suggestedPrice =  $( '#suggestedprice' ).val();
		
				if($('#ivacheck').is(':checked')) {  
				
						var ivaPrice = Math.round( (suggestedPrice * 1.16) * 100) / 100;
				
						$('#ivaprice').val(ivaPrice);
				
		            } else {  
				
		              $('#ivaprice').val(suggestedPrice);
		            }  
		
				var discount =  $( '#discountdrop' ).val();
				
				 var ivapri = $('#ivaprice').val();
				
				$('#totalmount').val( ivapri -  ((discount/100) * ivapri ));
		
		
		$('#discountdrop').change(function(){

		
		var suggestedPrice =  $( '#suggestedprice' ).val();
		
		
		$('#totalmount').val( suggestedPrice -  ((this.value/100) * suggestedPrice ));
		
	
		});
		
		
      
        $('#ivacheck').click(function() {  
        
				var suggestedPrice =  $( '#suggestedprice' ).val();
				if($('#ivacheck').is(':checked')) {  
				
						var ivaPrice = Math.round( (suggestedPrice * 1.16) * 100) / 100;
				
						$('#ivaprice').val(ivaPrice);
				
		            } else {  
				
		              $('#ivaprice').val(suggestedPrice);
		            } 
		
		
				var discount =  $( '#discountdrop' ).val();
				
				 var ivapri = $('#ivaprice').val();
				
				$('#totalmount').val( ivapri -  ((discount/100) * ivapri ));
		
        });  
      
		
		
		/*
$('#productdrop').change(function(){
		
		
		if (percentage =! 'null'){
		
			 suggestedPrice =  $( '#suggestedprice' ).val();
		
			
		
		}else{
		
			suggestedPrice =  $( '#suggestedprice' ).val();
		
			$('#totalmount').val( suggestedPrice );
		
		}

});*/
		
		
		", View::POS_END, 'noneoptions_drop_functions');


?>

<?php $form = ActiveForm::begin(); ?>

<div class="venta-form">

    

    <?php echo $form->errorSummary($model); ?>
    
    
  <div class="row">  
    <div class="col-md-5 col-xs-12 col-sm-12">
    
   <h3><i class="fa fa-list"></i> Datos de la orden</h3>	
		
    
    <?= $form->field($model, 'clave_proveedor')->dropDownList($dataListProveedor,['prompt'=>'-- Seleccione una opción  --','id' => 'cat-id']) ?>
	
 
     <?php echo $form->field($model, 'fecha_venta')->widget(
    'trntv\yii\datetime\DateTimeWidget',
    	[
        //'phpDatetimeFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
        	'useCurrent'=>true,	
        	'showTodayButton'=>true,	
            'minDate' => new \yii\web\JsExpression('new Date("2015-01-01")'),
            'allowInputToggle' => false,
            'sideBySide' => true,
            'locale' => 'es-MX',
            'widgetPositioning' => [
               'horizontal' => 'auto',
               'vertical' => 'auto'
            ]
        ]
    ]); ?>
    
 	 	<?php echo $form->field($model, 'garantia')->dropDownList(['3' => '3 Meses', '6' => '6 Meses', '9' => '9 Meses', '12' => '12 Meses', '0' => 'No aplica'],['prompt'=>'Seleccione una opción']); ?>

    	<!--<?php echo $form->field($model, 'seguro_robo')->checkbox()->label('Seguro contra robo') ?>-->
       
         <?php echo $form->field($model, 'comentarios')->textarea(['maxlength' => 100]) ?>
     
    </div>
   
    
     
    <div class="col-md-7 col-xs-12 col-sm-12 table-responsive">
		<h3><i class="fa fa-cubes"></i>Productos</h3>		
		<table class="table table-hover table-condensed table-bordered">
		
			<thead>
				<tr>
					<th>#Serie</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>($) Precio </th>
					<th>Seguro robo</th>
					<th><?php if($model->isNewRecord) : ?>	<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#mod_trabajadores" id="userButton">
						<i class="fa fa-plus-square"></i>&nbsp;<?= Yii::t('backend', '')?>
	   		 			</a>
	   		 		<?php endif;?>
	   		 	</th>
				</tr>
			</thead>
			
			<tbody>
			
			
			
				<?php
				$total = 0.0;
				
				if (!$model->isNewRecord) $productos = $model->productos;
				
				foreach ($productos as $producto): ?>
				
					<tr>
						<td><?= $producto->numero_serie;?></td>
						<td><?= $producto->tipoProducto->nombre;?></td>
						<td><?= $producto->tipoProducto->descripcion;?></td>
						<td><?= $producto->precio_sugerido;?></td>
						<td><?= ($producto->seguro_robo)?'Si':'No';?></td>
						<td><?php echo Html::submitButton('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger', 'name'=>'remover','id'=>$producto->numero_serie, 'value'=>$producto->numero_serie]) ?></td>
					</tr>
						<?php $total+= $producto->precio_sugerido;?>
				
				<?php endforeach;?>
			</tbody>
			
			<tfoot>
				<tr>
					
					<td align="right" colspan="3">Sub total ($)</td>
					<td colspan="2">
						<?php echo $form->field($model, 'precio_publico')->textInput(['id'=>'suggestedprice', 'readonly'=>'readonly','value'=>$total])->label(false) ?>
					</td>
					<td></td>
				</tr>
				<tr>
					
					<td align="right" colspan="3">+ I.V.A  (16%) <?php echo $form->field($model, 'iva')->checkbox(['id'=>'ivacheck',])->label(false) ?> </td>
					<td colspan="2">
						<?php echo $form->field($model, 'precioIva')->textInput(['id'=>'ivaprice', 'readonly'=>'readonly','value'=>$total])->label(false) ?>
					</td>
					<td></td>
				</tr>
				
				<tr>
					

					<td align="right" colspan="3">- Desc. preferencial %</td>
					<td colspan="2"><!--<i class="fa fa-usd"> </i> <span class="badge label-primary"><?= $total ?></span> -->
					<?php echo $form->field($model, 'descuento')->dropDownList([10 => '10', 20 => '20', 25 => '25', 30 => '30', 50 =>'50'] ,
    		['prompt'=>'NINGUNO',
				'id'=>'discountdrop'   ])->label(false); ?>

					</td>
					<td></td>
				</tr>
				
				<tr>
					
					<td colspan="2">Productos en la orden <span class="badge"><?= count($productos) ?></span></td>
					<td align="right">Total ($)</td>
					<td colspan="2"><!--<i class="fa fa-usd"> </i> <span class="badge label-primary"><?= $total ?></span> -->
					 <?php echo $form->field($model, 'monto_total')->textInput(['id'=>'totalmount', 'readonly'=>'readonly'])->label(false) ?>
					</td>
					<td></td>
				</tr>
				
				
			</tfoot>
		
		</table>
		
		
		<?php echo Html::submitButton('<i class="fa fa-usd"></i> '. $model->isNewRecord ? '$ Vender' : 'Actualizar'  , ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name'=>'vender', 'value'=>'vender']) ?>
    
        <?php echo Html::submitButton('Cancelar' , ['class' => 'btn btn-danger','name'=>'cancelar', 'value'=>'cancelar']) ?>
  
     
    </div>
    

    
    </div>

    

</div>

<?php ActiveForm::end(); ?>


<?php if ($model->isNewRecord): ?>
<div class="modal fade" id="mod_trabajadores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cubes"></i>&nbsp;<?=Yii::t('backend', 'Productos disponibles.') ?></h4>
                                        </div>
                                         <?php \yii\widgets\Pjax::begin(['timeout'=>8000]); ?>
                                        
	                                        <div class="modal-body">
	                                        
												
											    <?= GridView::widget([
											        'dataProvider' => $dataprovider,
											        'filterModel' => $searchModel,
											        'columns' => [
											           
											
											            //'ID_EMPRESA',
											            //'ID_REPRESENTANTE_LEGAL',
											            'numero_serie',	
											        		[
											        		'attribute'=>'tipo_producto',
											        		'content'=>function($data){
											        				
											        			//$tmpModel = Empresa::findOne(['ID_EMPRESA'=>$data->ID_EMPRESA]);
											        				
											        			return ( $data->tipoProducto)?  $data->tipoProducto->getCategoriaProducto(). ' - ' .$data->tipoProducto->nombre : ' -- '; //isset($tmpModel)?$tmpModel->NOMBRE_COMERCIAL: $data->NOMBRE_COMERCIAL;
											        				
											        		},
											        		//'filter'=>ArrayHelper::map(TipoProducto::findBySql('select * from tbl_tipo_producto where activo = 1;', 'id_tipo_producto','nombre')->all()),
											        		],
											            'descripcion',
											        	'precio_sugerido',
											        	[
											        	'attribute'=>'seguro_robo',
											        	'content'=>function($data){
											        		 
											        		//$tmpModel = Empresa::findOne(['ID_EMPRESA'=>$data->ID_EMPRESA]);
											        		 
											        		return ( $data->seguro_robo)?   'Si'  : 'No'; //isset($tmpModel)?$tmpModel->NOMBRE_COMERCIAL: $data->NOMBRE_COMERCIAL;
											        		 
											        	},
											        	//'filter'=>ArrayHelper::map(TipoProducto::findBySql('select * from tbl_tipo_producto where activo = 1;', 'id_tipo_producto','nombre')->all()),
											        	],
											        	 
											            //'NOMBRE_RAZON_SOCIAL',
											            // 'ACTIVO',
											          
											            
											            
													[
														'label'=>'',
														'format'=>'raw',
														'value' => function($data){
															
														return '<form  method="post" role="form">' . Html::submitButton(Yii::t('backend', '') .'&nbsp;<i class="fa fa-check-circle-o"></i>',
																['class' => 'btn btn-primary',
																'data-loading-text'=>"Loading...",
																'id'=>'trabajador_'.$data->numero_serie,
																 'name'=>'seleccionarProducto',
																'value'=>$data->numero_serie,		
																'onclick'=>"
																$('#trabajador_$data->numero_serie').fadeIn(300);
																$('#trabajador_$data->numero_serie').text('...');
																$('#trabajador_$data->numero_serie').removeClass('btn btn-primary').addClass('btn btn-success');
																return true;
																",
																]
														).'</form>';
													}]										
											           
											        ],
											    ]); ?>
												
										    </div>
										    <?php \yii\widgets\Pjax::end(); ?>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"> <?= Yii::t('backend', 'Salir')?></button>
                                            
                                        </div>
                                    </div>
                                </div>
</div>

<?php endif;?>

