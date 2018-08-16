<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Producto;
use yii\web\View;
use yii\grid\GridView;
use backend\models\TipoProducto;
/* @var $this yii\web\View */
/* @var $model backend\models\Garantia */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="row">




    <?php $form = ActiveForm::begin(); ?>

<div class="col-md-12">    

	
	 	<?php echo $form->errorSummary($model); ?>

  </div> 



<div class="col-md-6">


<div class="panel">
	
	<div class="panel-heading">
		<h3><i class="fa fa-file-pdf-o"></i> Datos de solicitud garantia</h3>
	</div>

	<div class="panel-body">
    	
		<?php echo $form->field($model, 'fecha_solicitud')->widget(
    'trntv\yii\datetime\DateTimeWidget',
    	[
    	'phpDatetimeFormat' => 'yyyy-MM-dd',
       // 'momentDatetimeFormat' => 'DD/MM/YYYY',
        'clientOptions' => [
        	'useCurrent'=>true,	
        	'showTodayButton'=>true,	
            'minDate' => new \yii\web\JsExpression('new Date("2015-01-01")'),
            'allowInputToggle' => false,
            'sideBySide' => false,
            'locale' => 'es-MX',
            'widgetPositioning' => [
               'horizontal' => 'auto',
               'vertical' => 'auto'
            ]
        ]
    ]); ?>
    
    <?php echo $form->field($model, 'fecha_ingreso_garantia')->widget(
    'trntv\yii\datetime\DateTimeWidget',
    	[
    			'phpDatetimeFormat' => 'yyyy-MM-dd',
      //  'momentDatetimeFormat' => 'DD/MM/YYYY',
        'clientOptions' => [
        	'useCurrent'=>true,	
        	'showTodayButton'=>true,	
            'minDate' => new \yii\web\JsExpression('new Date("2015-01-01")'),
            'allowInputToggle' => false,
            'sideBySide' => false,
            'locale' => 'es-MX',
            'widgetPositioning' => [
               'horizontal' => 'auto',
               'vertical' => 'auto'
            ]
        ]
    ])->label("Fecha ingreso el producto"); ?>
	 
	
	
		
		<?php echo $form->field($model, 'motivo_garantia')->textarea() ?>
		
		<?php echo $form->field($model, 'diagnostico')->textarea() ?>
		
			<?php echo $form->field($model, 'comentarios')->textarea()->label("Comentarios adicionales"); ?>
		
		
	</div>
   </div>


</div>


<div class="col-md-6">

<div class="col-md-12">

	<div class="panel">
	
	<div class="panel-heading">
		<h3><i class="fa fa-cube"></i> Datos del producto
		
		<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mod_trabajadores" id="userButton">
					<i class="fa fa-plus-square"></i>&nbsp;<?= Yii::t('backend', 'Seleccionar producto')?>
	   		</a>
		</h3>
	
		
			
		
		
	</div>

	<div class="panel-body">
	

	
    	<?php echo $form->field($model, 'numero_serie')->textInput(['readonly'=>'readonly', 'maxlength' => true,'id'=>'producto_numero_serie']) ?>
    	
    	<?php echo Html::label('Tipo producto','nombre'); ?>
    	
		<?php echo Html::textInput('nombre','',['maxlength' => true,'class'=>'form-control','id'=>'nombre_producto','readonly'=>'readonly']); ?>    	
    	
    	<?php echo Html::label('Precio ($)','precio'); ?>
    	
		<?php echo Html::textInput('precio','',['maxlength' => true,'class'=>'form-control','id'=>'precio_producto','readonly'=>'readonly']); ?>    	
    	
    	<?php echo Html::label('Fecha registro cliente','fecha_registro'); ?>
    	
		<?php echo Html::textInput('fecha_registro','',['maxlength' => true,'class'=>'form-control','id'=>'fecha_registro','readonly'=>'readonly']); ?>    	
    	
    	
    	
<div class="modal fade" id="mod_trabajadores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cubes"></i>&nbsp;<?=Yii::t('backend', 'Productos disponibles.') ?></h4>
                                        </div>
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
											            //'NOMBRE_RAZON_SOCIAL',
											            // 'ACTIVO',
											          
											            
											            
													[
														'label'=>'',
														'format'=>'raw',
														'value' => function($data){
															
														return  Html::a(Yii::t('backend', '') .'&nbsp;<i class="fa fa-check-circle-o"></i>',
																['create#'],
																['class' => 'btn btn-primary',
																'data-loading-text'=>"Loading...",
																'id'=>'trabajador_'.$data->numero_serie,
																 'name'=>'seleccionarProducto',
																'value'=>$data->numero_serie,		
																'onclick'=>' $.get( "'.Yii::$app->urlManager->createUrl(['producto/search-particular','id'=>$data->numero_serie]).'", function( data ) {
																
																	var o =JSON.parse(data);
																
													               $("#producto_numero_serie").val(o.numero_serie);
																		
																	$("#nombre_producto").val(o.nombre_producto);
																		
																	$("#precio_producto").val(o.precio_producto);
																		
																	$("#fecha_registro").val(o.fecha_registro);	
																		
																	$("#nombre_cliente").val(o.nombre_cliente);		
																	
																	$("#telefono_cliente").val(o.telefono_cliente);		
																		
																	$("#email_cliente").val(o.email_cliente);	
																		
																		
																		
																	$("#mod_trabajadores").modal("hide");	
																		
													                });
																	
																		',
																]
														);
													}]										
											           
											        ],
											    ]); ?>
										
										    </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"> <?= Yii::t('backend', 'Salir')?></button>
                                            
                                        </div>
                                    </div>
                                </div>
</div>

    	
	</div>
	
	
	
   </div>
   
 </div>
 
 <div class="col-md-12">

	<div class="panel">
	
	<div class="panel-heading">
		<h3><i class="fa fa-id-card-o"></i> Datos del cliente</h3>
	</div>

	<div class="panel-body">
		   
		  <?php echo Html::label('Nombre ','nombre_cliente'); ?>
    	
		<?php echo Html::textInput('nombre_cliente','',['maxlength' => true,'class'=>'form-control','id'=>'nombre_cliente','readonly'=>'readonly']); ?>    	
    	
    	<?php echo Html::label('Telefono','telefono_cliente'); ?>
    	
    	<?php echo Html::textInput('telefono_cliente','',['maxlength' => true,'class'=>'form-control','id'=>'telefono_cliente','readonly'=>'readonly']); ?>
    	
    	
    	<?php echo Html::label('Correo electronico','email'); ?>
    	
    	<?php echo Html::textInput('email','',['maxlength' => true,'class'=>'form-control','id'=>'email_cliente','readonly'=>'readonly']); ?>
    	
    	

	</div>
   </div>
   
 </div>
   

</div>
    


	<?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>




    <?php ActiveForm::end(); ?>
    
    
    

</div>
