<?php


use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\captcha\Captcha;
use backend\models\Proveedor;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'Registrar producto');

$provedoresDataList = ArrayHelper::map ( Proveedor::findBySql('select * from tbl_proveedor')->all(), 'clave_proveedor', 'nombre' );


?>


 <!-- Start Page Banner -->
    <div class="page-banner no-subtitle">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>Registro de producto</h2>
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="/">Inicio</a></li>
             
              <li>Registro de producto</li>
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
  
     
      

	 <?php $form = ActiveForm::begin(); ?>
	 
	 
	 <h4 class="classic-title"><span>Información del producto</span></h4>

    



    <div class="col-md-12">
	      
	      <div class="col-md-8">
	       <?= $form->field($model, 'numero_serie', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-barcode"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'No. Serie Producto','class'=>'form-control input-lg'])->label(false); ?>
			
			</div>
			
			<div class="col-md-4"><small>Número de serie del producto.</small></div>
			
			</div> 
			
			
			    <div class="col-md-12">
	      
	      <div class="col-md-8">
	       <?= $form->field($model, 'codigo_registro', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-eye"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Codigo de verificacion','class'=>'form-control input-lg'])->label(false); ?>
			
			</div>
			
			<div class="col-md-4"><small>Codigo de verificacion, proporcionado por el distribuidor</small></div>
			
			</div> 
			 
			
		 <div class="col-md-12">
	      
	      		<div class="col-md-8">	
   
        <?php echo $form->field($model, 'fechaAdquirio')->widget(
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
    ])->label('Fecha en que adquirio el procuto'); ?>
   				 </div>
    </div>
    
      <!--  <div class="col-md-12">
    
    <div class="col-md-8">   	
	           	
		     <?= $form->field($model, 'idProveedor', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-building"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->dropDownlist($provedoresDataList,['prompt' => 'Proveedor autorizado','class'=>'form-control input-lg'])->label(false); ?>
			</div>  
    
<div class="col-md-4"><small>Proveedor Autorizado.</small></div>
			
			</div>  --> 
	
       <div class="col-md-12">
    
    <div class="col-md-8"> 
    			<?php echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                
	</div>
	</div>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('frontend', 'Registrar'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
	</div>
	</div>
	</div>
	

</div> 
</div>