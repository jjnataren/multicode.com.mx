<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Promocion */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="promocion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>
    
    
    <div class="col-md-3 col-sm-12 col-xs-12" >
		<?php echo $form->field($model, 'imagen_url')->widget(\trntv\filekit\widget\Upload::classname(), [
	        'url'=>['avatar-upload']
	    ])
		//TODO: Implementar la accion de subir archivo
		?>
	
	</div>
    
<div class="col-md-9 col-sm-12 col-xs-12" >
    <?php echo $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>
    </div>
<div class="col-md-9 col-sm-12 col-xs-12" >    

    <?php echo $form->field($model, 'descripcion')->textarea(['maxColumns' => 300]) ?>
    
 </div>   

<div class="col-md-3 col-sm-12 col-xs-12" >

	   <?php echo $form->field($model, 'fecha_inicio')->widget(
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
<div class="col-md-3 col-sm-12 col-xs-12" >
	   <?php echo $form->field($model, 'fecha_fin')->widget(
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
<div class="col-md-3 col-sm-12 col-xs-12" >
    <?php echo $form->field($model, 'estatus')->dropDownList([1=>'Activo',0=>'Inactivo']); ?>
</div>

    <div class="col-md-12 col-sm-12 col-xs-12" >
        <?php echo Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
