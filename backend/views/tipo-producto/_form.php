<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\TipoProducto;

/* @var $this yii\web\View */
/* @var $model backend\models\TipoProducto */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="row">

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

    
    
    <div class="col-md-12">
    <div class="col-md-7">
    <?php echo $form->field($model, 'nombre', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-tag"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Nombre	','class'=>'form-control input-lg'])->label(false); ?>
			
	</div>
	<div class="col-md-5"><small>Ingrese un nombre que lo caracterice .</small></div>
	</div>
	
	

     
	
	
	  <div class="col-md-12">
    <div class="col-md-7">
	  <?php echo $form->field($model, 'activo',['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-check-circle-o"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->dropDownList(['1' => 'Si', '0' => 'No'],['prompt'=>'Seleccione una opción']); ?>
   				
   			</div>
	<div class="col-md-5"><small>¿Desea activarlo?.</small></div>
	</div>
		
	  
	   <div class="col-md-12">
    <div class="col-md-7">
	 <?php echo $form->field($model, 'categoria',['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-list-ol"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->dropDownList(TipoProducto::$categoriaDesc,['prompt'=>'Seleccione una opción']); ?>
	</div>
	<div class="col-md-5"><small>Seleccione la categoría a la cual pertenece.</small></div>
	</div>
	
	
	
	<div class="col-md-12">
    <div class="col-md-7">
    <?php echo $form->field($model, 'precio_base', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-usd"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Precio sugerido	','class'=>'form-control input-lg'])->label(false); ?>
			
	</div>
	<div class="col-md-5"><small>Ingrese el precio sugerido para el producto.</small></div>
	</div>
	
	<div class="col-md-12">
    <div class="col-md-7">
    <?php echo $form->field($model, 'caracteristica1', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-thumbs-up"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Primera caracteristica 	','class'=>'form-control input-lg'])->label(false); ?>
			
	</div>
	<div class="col-md-4"><small>Ingrese algo que caracterice al producto. </small></div>
	</div>
	
	
		<div class="col-md-12">
    <div class="col-md-7">
    <?php echo $form->field($model, 'caracteristica2', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-thumbs-up"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Segunda caracteristica 	','class'=>'form-control input-lg'])->label(false); ?>
			
	</div>
	<div class="col-md-4"><small>Ingrese algo que caracterice al producto. </small></div>
	</div>
	
	
		<div class="col-md-12">
    <div class="col-md-7">
    <?php echo $form->field($model, 'caracteristica3', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-thumbs-up"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Tercera caracteristica 	','class'=>'form-control input-lg'])->label(false); ?>
			
	</div>
	<div class="col-md-4"><small>Ingrese algo que caracterice al producto. </small></div>
	</div>
	
	
		<div class="col-md-12">
    <div class="col-md-7">
    <?php echo $form->field($model, 'caracteristica4', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-thumbs-up"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Cuarta caracteristica 	','class'=>'form-control input-lg'])->label(false); ?>
			
	</div>
	<div class="col-md-4"><small>Ingrese algo que caracterice al producto. </small></div>
	</div>
	 <div class="col-md-12">
    <div class="col-md-7">

    <?php echo $form->field($model, 'descripcion')->textarea(['maxlength' => true]) ?>
    </div>
    </div>
 <div class="col-md-12">
      
	<?php echo Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
     </div>
     
     
     

	
    <?php ActiveForm::end(); ?>

</div>
