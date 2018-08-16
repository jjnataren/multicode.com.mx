<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\CatCatalogo;
use yii\base\Model;

/* @var $this yii\web\View */
/* @var $model backend\models\Proveedor */
/* @var $form yii\bootstrap\ActiveForm */

?>

<?php $dataPais=ArrayHelper::map(CatCatalogo::findAll(['CATEGORIA'=>3]), 'ID_ELEMENTO','NOMBRE');
		?>
		
<?php $dataEstado=(!$model->isNewRecord)?ArrayHelper::map(CatCatalogo::findAll(['CATEGORIA'=>1]), 'ID_ELEMENTO','NOMBRE'):[];
		?>
<?php $dataMun=(!$model->isNewRecord)?ArrayHelper::map(CatCatalogo::findAll(['CATEGORIA'=>1]), 'ID_ELEMENTO','NOMBRE'):[];
		?>		
		
	

<div class="row">



    <?php $form = ActiveForm::begin(); ?>
	
		<?php echo $form->errorSummary($model); ?>

<!-- 	<div class="col-md-3 col-xs-12 col-sm-12">
		
		<?php echo $form->field($model, 'imagen')->widget(\trntv\filekit\widget\Upload::classname(), [
	        'url'=>['avatar-upload']
	    ])
		//TODO: Implementar la accion de subir archivo
		?>
		
	</div>   -->

	<div class="col-md-7 col-xs-12 col-sm-12">


	<div class="panel">
	
		<div class="panel-heading">
			<h3><i class="fa fa-list"></i> Datos generales</h3>
		</div>
		
		<div class="panel-body">
			
		    <?php echo $form->field($model, 'clave_proveedor')->textInput() ?>
		
		    <?php echo $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
		
		    <?php echo $form->field($model, 'telefono')->textInput() ?>
		
		    <?php echo $form->field($model, 'direccion')->textarea(['maxlength' => 500]) ?>
		    
		        <?php 
				    echo $form->field($model, 'pais')->dropDownList($dataPais, 
				             ['prompt'=>'-seleccione pais-',
				              'onchange'=>'
				                $.post( "'.Yii::$app->urlManager->createUrl('proveedor/get-pais-estados?id=').'"+$(this).val(), function( data ) {
				                  $( "select#selectEstados" ).html( data );
				                });
				            ']); 
				    ?>
				    <?php 
				    echo $form->field($model, 'estado')->dropDownList($dataEstado, 
				             ['prompt'=>'-seleccione estado-',
				              'onchange'=>'',
				             'id'=>'selectEstados'		
				    ]); 
				    ?>
				    
				   <?php echo $form->field($model, 'descripcion')->textarea(['maxlength' => 500]) ?> 
					
		</div>
	</div>
    
    </div>
    
	<div class="col-md-5 col-xs-12 col-sm-12">
	
	
	<div class="panel">
	
		<div class="panel-heading">
			<h3><i class="fa fa-mobile"></i> Datos de contacto</h3>
		</div>
		
		<div class="panel-body">
			
	    
		<?php echo $form->field($model, 'telefono')->textInput() ?>
		     
		<?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    	<?php echo $form->field($model, 'whatsapp')->textInput(['maxlength' => true]) ?>
    	
    	<?php echo $form->field($model, 'facebook_url')->textInput(['maxlength' => 300]) ?>
    	
    	<?php echo $form->field($model, 'sitio_url')->textInput(['maxlength' => 300]) ?>
		     
					
		</div>
	</div>

    
   
    


    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    
  	</div>
  


    <?php ActiveForm::end(); ?>

</div>
