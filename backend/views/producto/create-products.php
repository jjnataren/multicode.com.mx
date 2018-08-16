<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\TipoProducto;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model backend\models\Producto */

$this->title = 'Crear productos en seríe.';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-plus fa-stack-1x"></i>
							   </span>';

?>



<div class="col-md-12">

<h1>Producto base.</h1>

    <?php $form = ActiveForm::begin([]); $i=0;?>
    
    <?php if ($model->hasErrors()):?>
    
    <div class="panel panel-warning">
    <?php echo $form->errorSummary($model); ?>
    </div>
    
    <?php endif;?>
    
    
<?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
        		
            'numero_serie',
            	['attribute'=> 'tipo_producto',
    	    		'value'=>$model->tipoProducto->nombre . ' - ' .$model->tipoProducto->getCategoriaProducto()
        		],
        		
        		['attribute'=> 'fecha_fabricacion',
	        		'value'=> isset($model->fecha_fabricacion)? Yii::$app->formatter->asDatetime( $model->fecha_fabricacion) :  'fecha no definida'
        		],
        		
        		['attribute'=> 'estado',
        		'value'=> $model->getEstadoProducto()
        				],
        		
            'codigo_registro',
        		
        		['attribute'=>     'precio_sugerido',
        		'value'=>'$ '. $model->precio_sugerido
        		],
        		
        		['attribute'=>     'seguro_robo',
        		'value'=> ($model->seguro_robo)?'Si':'No'
        		],
        		
        		['attribute'=>     'servicio_app',
        		'value'=> ($model->servicio_app)?'Si':'No'
        		],
        		
        ],
    ]) ?>



<div class="panel panel-success">
<div class="panel-body">
	<h3 class="text text-primary">Revisar  el detalle de los productos y hacer clic en guardar.</h3>
	</div>
</div>

	<?php foreach ($models as $modelo):?>

		<div class="row">
			    <div class="col-md-12 col-sm-12 col-xs-12" >
			    
		
			    
			    <div class="panel panel-default">
			   
			    	<?php echo $form->errorSummary($models[$i]); ?>
			    	<?php echo   $form->field($models[$i], "[$i]numero_orden")->hiddenInput()->label(false);             ?>
					<?php echo   $form->field($models[$i], "[$i]tipo_producto")->hiddenInput()->label(false);            ?>
					<?php echo  $form->field($models[$i], "[$i]fecha_fabricacion")->hiddenInput()->label(false);         ?>
					<?php echo   $form->field($models[$i], "[$i]estado")->hiddenInput()->label(false);                   ?>
					
					<?php echo  $form->field($models[$i], "[$i]precio_sugerido")->hiddenInput()->label(false);           ?>
					<?php echo  $form->field($models[$i], "[$i]descripcion")->hiddenInput()->label(false);               ?>
					<?php echo  $form->field($models[$i], "[$i]urlimg")->hiddenInput()->label(false);                    ?>
					<?php echo   $form->field($models[$i], "[$i]id_propietario")->hiddenInput()->label(false);           ?>
					<?php echo  $form->field($models[$i], "[$i]id_provedor")->hiddenInput()->label(false);               ?>
					<?php echo  $form->field($models[$i], "[$i]fecha_asigno_provedor")->hiddenInput()->label(false);     ?>
					<?php echo  $form->field($models[$i], "[$i]fecha_adquirio_cliente")->hiddenInput()->label(false);    ?>
					<?php echo  $form->field($models[$i], "[$i]path_documento_probatorio")->hiddenInput()->label(false); ?>
					<?php echo  $form->field($models[$i], "[$i]fecha_registro")->hiddenInput()->label(false);            ?>
					<?php echo  $form->field($models[$i], "[$i]fecha_valido_proveedor")->hiddenInput()->label(false);    ?>
					<?php echo  $form->field($models[$i], "[$i]email_valido_producto")->hiddenInput()->label(false);     ?>
			    
			    
			    <div class="panel-body">
			    <div class="col-md-1">
			    	 Nuevo producto <?=$i+1; ?>
			    </div>
			    <div class="col-md-3">
			  
			    <?php echo $form->field($models[$i], "[$i]numero_serie", ['template' => 
					     		'<div class="form-group">
			    					{label}
					       		 <div class="input-group">
						          <span class="input-group-addon" >
						             <span class="glyphicon glyphicon-barcode"></span>
						          </span>
			    					
					         	 {input}	    				
					     		
					       </div>
					     			
					      <div> {error}{hint}</div>
			   				</div>'])->textInput(['placeholder' => 'No. Serie Producto','class'=>'form-control input-lg','maxlength' => '16']); ?>
						
				</div>
				
			    
				
			    <div class="col-md-4">
			     <label>Código de registro</label>
			    <?php echo $form->field($models[$i], "[$i]codigo_registro", ['template' => 
					     		'<div class="form-group">
					       		 <div class="input-group">
					          <span class="input-group-addon" >
					             <span class="fa fa-eye"></span>
					          </span>
					          {input}
					     		
					       </div>
					     			
					      <div> {error}{hint}</div>
			   				</div>'])->textInput(['placeholder' => 'Código de Registro','class'=>'form-control input-lg'])->label(false); ?>
						
					</div>
					
					 <div class="col-md-2">
					 
			     <?php echo $form->field($models[$i], "[$i]seguro_robo")->checkbox(['class'=>'form']); ?>
			   	</div>
				
				
				 <div class="col-md-2">
			     <?php echo $form->field($models[$i], "[$i]servicio_app")->checkbox(['class'=>'form']); ?>
			   	</div>
				</div>
				
				</div>
				
				
				
			
				
				
				</div>
		</div>

	<?php $i++; endforeach;?>

	<?php if(!$model->hasErrors()):?>
    <div class="form-group">
         <?php echo Html::submitButton('Guardar', ['class' =>  'btn btn-success']) ?>
    </div>
	<?php endif;?>

	
    <?php ActiveForm::end(); ?>

</div>

