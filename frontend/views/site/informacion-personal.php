<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\captcha\Captcha;
use backend\models\Proveedor;
use yii\helpers\ArrayHelper;

use backend\models\CatCatalogo;

/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'Actualizar Datos')
?>
<?php $dataEstado=ArrayHelper::map(CatCatalogo::findAll(['CATEGORIA'=>1]), 'ID_ELEMENTO','NOMBRE');
		?>
 <!-- Start Page Banner -->
    <div class="page-banner no-subtitle">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>Configuración de cliente</h2>
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="/">Inicio</a></li>
              <li>Configuración de cliente</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

<div id="content">
<div class="container">
<div class="col-md-12">
 <h2 class="classic-title"><span><?php echo Html::encode($this->title) ?></span></h2>
      <div class="panel panel-default">
        <div class="panel-body">
        <h4 class="classic-title"><span>Información del Cliente</span></h4>
      

      <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>
    <!-- nombre -->
        <div class="col-md-12">
	      
	      <div class="col-md-8">
	       <?= $form->field($model, 'nombre', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-user"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Ingrese su Nombre del contacto...','class'=>'form-control input-lg'])->label(false); ?>
			
			</div>
			
			<div class="col-md-4"><small>Nombre(s) del cliente</small></div>
			
			</div>  

   
	 <!-- apm -->
    
     <div class="col-md-12">
	         <div class="col-md-8">
	      
	       <?= $form->field($model, 'apellido_paterno', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-option-horizontal"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Ingrese su Apellido Paterno...','class'=>'form-control input-lg'])->label(false); ?>
			</div>  		
  		<div class="col-md-4"><small>Apellido Paterno del cliente</small></div>
			</div>
			
			 <!-- app -->
    
     <div class="col-md-12">
	       <div class="col-md-8">
	      
	       <?= $form->field($model, 'apellido_materno', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-option-horizontal"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Ingrese su Apellido Materno...','class'=>'form-control input-lg'])->label(false); ?>
			</div>  
			<div class="col-md-4"><small>Apellido Materno del cliente</small></div>
			</div>
			
 <!-- red social -->
    
     <div class="col-md-12">
	      
	      <div class="col-md-8">
	       <?= $form->field($model, 'razon_social', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-skype"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Ingrese su Razon Social...','class'=>'form-control input-lg'])->label(false); ?>
			</div> 
    	<div class="col-md-4"><small>Nombre de la empresa a la que pertenece el cliente.</small></div>
			</div>
			
			 <!--estado-->
    
    
  
     <div class="col-md-12">
	        <div class="col-md-8">
	      
	       <?= $form->field($model, 'estado', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-option-horizontal"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->dropDownList($dataEstado, 
             ['prompt'=>'-Entidad Federativa-',
              'onchange'=>'',
             'id'=>'selectEstados'		
    ]);  ?>
			</div>  		
	<div class="col-md-4"><small>Seleccione su Entidad federativa actual.</small></div>
			</div>
		 <!--direccion-->
    
     <div class="col-md-12">
	   <div class="col-md-8">   
	      
	       <?= $form->field($model, 'direccion', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-home"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Ingrese su Dirección...','class'=>'form-control input-lg'])->label(false); ?>
			</div>  
			<div class="col-md-4"><small> Domicilio en el que radica actualmente.</small></div>
			</div>		
  
	
			
			 <!--  delegacion-->
    
     <div class="col-md-12">
	      
	        <div class="col-md-8">
	       <?= $form->field($model, 'delegacion_mpio', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-university"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Ingrese su Delegación o Municipio...','class'=>'form-control input-lg'])->label(false); ?>
			</div>				
	<div class="col-md-4"><small>Seleccione su delegación o municipio.</small></div>
			</div>
	<!--cp-->
    
     <div class="col-md-12">
	      <div class="col-md-8">
	      
	      
	       <?= $form->field($model, 'codigo_postal', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-option-horizontal"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Ingrese su Codigo Postal...','class'=>'form-control input-lg'])->label(false); ?>
			</div>  		
	<div class="col-md-4"><small>...</small></div>
			</div>
    	<!--email-->
    
     <div class="col-md-12">
	           <div class="col-md-8">
	      
	       <?= $form->field($model, 'email', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-envelope"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Ingrese su Email...','class'=>'form-control input-lg'])->label(false); ?>
			</div>  
			<div class="col-md-4"><small>Correo electrónico de contacto</small></div>
			</div>
	<!--telefono-->
    
     <div class="col-md-12">
	      <div class="col-md-8">
	      
	       <?= $form->field($model, 'telefono', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-earphone"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Ingrese su Telefono...','class'=>'form-control input-lg'])->label(false); ?>
			</div>				
	<div class="col-md-4"><small>Número telefónico del contacto. </small></div>
			</div>
    
  
<!--whats app-->
    
     <div class="col-md-12">
	      <div class="col-md-8">
	      
	       <?= $form->field($model, 'whatsapp', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-whatsapp"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Ingrese su Whatsapp...','class'=>'form-control input-lg'])->label(false); ?>
			</div>				
	<div class="col-md-4"><small>...</small></div>
			</div>
    
 
      <!--  rfc-->
    
     <div class="col-md-12">
	      <div class="col-md-8">
	      
	       <?= $form->field($model, 'rfc', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-registered"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Ingrese su RFC...','class'=>'form-control input-lg'])->label(false); ?>
			</div>		
			
			<div class="col-md-4"><small>Ingrese su RFC, máximo 12 caracteres.</small></div>
			</div>
					
	 <div class="col-md-12">
	 <!-- 
	 <div class="col-md-8">
	 
<!-- TODO: Add meta tags and page title here. -->
         <?php echo $form->field($model, 'fecha_nacimiento')->widget(
    'trntv\yii\datetime\DateTimeWidget',
    [
        'momentDatetimeFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
            'minDate' => new \yii\web\JsExpression('new Date("2015-01-01")'),
            'allowInputToggle' => false,
            'sideBySide' => true,
            'locale' => 'es-MX',
        	'format'=>'DD/MM/YYYY',	
            'widgetPositioning' => [
               'horizontal' => 'auto',
               'vertical' => 'auto'
            ]
        ]
    ])->label('Fecha de Nacimiento'); ?>
    
</div> 
 -->
<div class="col-md-4"><small>...</small></div>
			</div>
			
    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
</div>
</div>
