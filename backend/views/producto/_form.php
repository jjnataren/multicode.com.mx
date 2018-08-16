<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\TipoProducto;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Producto */
/* @var $form yii\bootstrap\ActiveForm */

$dataListProducto=(!$model->isNewRecord)?ArrayHelper::map(TipoProducto::findBySql('select id_tipo_producto,  CONCAT(id_tipo_producto, \' - \',nombre ) as nombre from tbl_tipo_producto')->all(), 'id_tipo_producto', 'nombre'):[];

$model->categoria = ($model->isNewRecord)?'':$model->tipoProducto->categoria;

?>

<div class="row">




<div class="col-md-4">
<h3><i class="fa fa-cube"></i> <?= ($model->isNewRecord)? 'Nuevo producto' : 'Producto'; ?></h3>

<div id="divimg">

 <img class="img-thumbnail" style="width:350px; height:250px;" src="<?= isset ($model->tipoProducto->path)? $model->tipoProducto->base.'/' . $model->tipoProducto->path :'/img/clipboard.png';?>" alt="" />

</div>

</div>

<div class="col-md-8">

<h3>Datos del producto</h3>

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

	
    <div class="col-md-12 col-sm-12 col-xs-12" >
    
    <div class="col-md-12">
    <div class="col-md-7">
    <?php echo $form->field($model, 'numero_serie', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-barcode"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'No. Serie Producto','class'=>'form-control input-lg','maxlength' => '16'])->label(false); ?>
			
	</div>
	<div class="col-md-4"><small>Ingrese el número de serie del producto.</small></div>
	</div>
	
	 <div class="col-md-12">
      <div class="col-md-7">
        <?php 
    echo $form->field($model, 'categoria',['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-filter"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->dropDownList(TipoProducto::$categoriaDesc, 
             ['prompt'=>'--Seleccione categoría--',
              'onchange'=>'
                $.post( "'.Yii::$app->urlManager->createUrl('producto/get-categoria-pro?id=').'"+$(this).val(), function( data ) {
                  $( "select#selectPro" ).html( data );
                });
            ']); 
    ?>
    
	 
	</div>
	<div class="col-md-4"><small>Seleccione el tipo de categoria del producto.</small></div>
	</div>
	
    <div class="col-md-12">
    <div class="col-md-7">
      <?= $form->field($model, 'tipo_producto',['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-cube"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->dropDownList($dataListProducto,
   						['prompt'=>'-- Seleccione una opción  --',
   						'id' => 'selectPro',
   						'onchange'=>'
			                $.get( "'.Yii::$app->urlManager->createUrl('tipo-producto/get-img?id=').'"+$(this).val(), function( data ) {
			                  $( "#divimg" ).html( data );
			                });
            			',
   						
      ]) ?>
    
    </div>
	<div class="col-md-4"><small>Seleccione el tipo de producto a crear.</small></div>
	</div>
	
	   <div class="col-md-12">
    <div class="col-md-7">
    <?php echo $form->field($model, 'fecha_fabricacion')->widget(
    'trntv\yii\datetime\DateTimeWidget',
    [
        //'momentDatetimeFormat' => 'DD/MM/YYYY',
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
    
      </div>
	<div class="col-md-4"><small> Fecha de fabricación del producto .</small></div>
	</div>

    
	  <div class="col-md-12">
    <div class="col-md-7">
    <?php echo $form->field($model, 'codigo_registro', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-barcode"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Código de Registro','class'=>'form-control input-lg'])->label(false); ?>
			
		</div>
	<div class="col-md-4"><small> Ingrese el código de registro del producto.</small></div>
	</div>
	
	<div class="col-md-12">
    <div class="col-md-7">
    <?php echo $form->field($model, 'precio_sugerido',['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-usd"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Precio sugerido','class'=>'form-control input-lg'])->label(false); ?>
			
	</div>
	<div class="col-md-4"><small>Precio sugerido al público..</small></div>
	</div>
	

	
	<div class="col-md-12">
    <div class="col-md-7">
     <?php echo $form->field($model, 'seguro_robo')->checkbox(['class'=>'form']); ?>
   	</div>
	<div class="col-md-4">
		<small>Protegido con seguro contra robo.</small>
	</div>
	</div>
	
	<div class="col-md-12">
    <div class="col-md-7">
     <?php echo $form->field($model, 'servicio_app')->checkbox(['class'=>'form']); ?>
   	</div>
	<div class="col-md-4">
		<small>
			El producto cuenta con servicio para generar token por APP.
		</small>
	</div>
	</div>
	
		<div class="col-md-12">
    <div class="col-md-7">
    <?php echo $form->field($model, 'descripcion')->textArea(['maxlength' => 100]) ?>
    
   

	</div>
	
	</div>
	
	
	</div>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Crear producto' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>