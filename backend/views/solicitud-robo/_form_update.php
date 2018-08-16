<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use backend\models\TipoProducto;
use yii\web\View;
use yii\helpers\ArrayHelper;
use backend\models\Producto;

/* @var $this yii\web\View */
/* @var $model backend\models\SolicitudRobo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitud-robo-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="col-md-6">


<div class="panel">
	
	<div class="panel-heading">
		<h3><i class="fa fa-file-pdf-o"></i> Datos del reporte de robo</h3>
	</div>

	<div class="panel-body">
    	   
	 <!-- <?php echo $form->field($model, 'numero_serie')->textInput() ?> -->
	    
	  
	        <?php echo $form->field($model, 'fecha_robo')->widget(
    'trntv\yii\datetime\DateTimeWidget',
    [
        'phpDatetimeFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
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
		
		<?php echo $form->field($model, 'fecha_solicitud')->widget(
    'trntv\yii\datetime\DateTimeWidget',
    [
        'phpDatetimeFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
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
    
    <?php echo $form->field($model, 'fecha_validacion')->widget(
    'trntv\yii\datetime\DateTimeWidget',
    [
        'phpDatetimeFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
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
    
    <?php echo $form->field($model, 'fecha_desactivar')->widget(
    'trntv\yii\datetime\DateTimeWidget',
    [
        'phpDatetimeFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
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
			      
	
		<?php echo $form->field($model, 'descripcion')->textArea(['maxlength' => true]) ?>
	
		 <?php echo $form->field($model, 'acta_robo', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-barcode"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'No. de acta de robo','class'=>'form-control input-lg','maxlength' => '16'])->label(false); ?>
		  <!--<?php echo $form->field($model, 'estatus')->textInput() ?> -->
	</div>
   </div>
  

</div>

<div class="col-md-4 col-xs-12">

<div class="col-md-12">

	<div class="panel">
	
	<div class="panel-heading">
		<h3><i class="fa fa-cube"></i> Datos del producto
		
		</h3>
		
		
	</div>

	<div class="panel-body">
	

	
    	<?php echo $form->field($model, 'numero_serie')->textInput(['readonly'=>'readonly', 'maxlength' => true,'id'=>'producto_numero_serie']) ?>
    	
    	<?php echo Html::label('Tipo producto','nombre'); ?>
    	
		<?php echo Html::textInput('nombre', isset( $model->numeroSerie ) ? $model->numeroSerie->getTipoNombreProducto() : '' ,
				['maxlength' => true,'class'=>'form-control','id'=>'nombre_producto','readonly'=>'readonly' ]); ?>    	
    	
    	<?php echo Html::label('Precio ($)','precio'); ?>
    	
		<?php echo Html::textInput('precio',isset( $model->numeroSerie ) ? $model->numeroSerie->precio_sugerido: '',['maxlength' => true,'class'=>'form-control','id'=>'precio_producto','readonly'=>'readonly']); ?>    	
    	
    	<?php echo Html::label('Fecha registro cliente','fecha_registro'); ?>
    	
		<?php echo Html::textInput('fecha_registro', isset( $model->numeroSerie ) ? $model->numeroSerie->fecha_registro : '' ,['maxlength' => true,'class'=>'form-control','id'=>'fecha_registro','readonly'=>'readonly']); ?>    	
 	
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
    	
		<?php echo Html::textInput('nombre_cliente', isset( $model->numeroSerie->idPropietario ) ? $model->numeroSerie->idPropietario->nombre . ' ' .
									$model->numeroSerie->idPropietario->apellido_paterno . ' ' . $model->numeroSerie->idPropietario->apellido_materno	: '' ,['maxlength' => true,'class'=>'form-control','id'=>'nombre_cliente','readonly'=>'readonly']); ?>    	
    	
    	<?php echo Html::label('Telefono','telefono_cliente'); ?>
    	
    	<?php echo Html::textInput('telefono_cliente', isset( $model->numeroSerie->idPropietario ) ? $model->numeroSerie->idPropietario->telefono : '' ,['maxlength' => true,'class'=>'form-control','id'=>'telefono_cliente','readonly'=>'readonly']); ?>
    	
    	
    	<?php echo Html::label('Correo electronico','email'); ?>
    	
    	<?php echo Html::textInput('email', isset( $model->numeroSerie->idPropietario ) ? $model->numeroSerie->idPropietario->email : '',['maxlength' => true,'class'=>'form-control','id'=>'email_cliente','readonly'=>'readonly']); ?>
    	
    	

	</div>
   </div>
   
 </div>
   

</div>
	
    
    <div class="col-md-12 col-xs-12 col-sm-12">

<?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
 </div>

    <?php ActiveForm::end(); ?>

</div>
