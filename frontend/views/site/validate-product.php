<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use backend\models\Producto;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Validar producto';
$this->params['breadcrumbs'][] = $this->title;
?>



 <!-- Start Page Banner -->
    <div class="page-banner no-subtitle">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>Validación de producto</h2>
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="/">Inicio</a></li>
              <li>Validación de producto</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
<div id="content">
<div class="container">
    <h2 class="classic-title"><span><?php echo Html::encode($this->title) ?></span></h2>
	<br />

	
    <div class="row">
    
    	<div class="col-md-12 col-xs-12 col-md-12">
    	
    	<p class="text text-info">
    	<i class="fa fa-info"> </i>
			&nbsp;En esta sección podrás verificar el estado del producto que adquiriste,
			para ello necesitaras el número de serie del producto e ingresar el código de validación
		</p>
	
    	
    	</div>
    
    	
        <div class="col-md-7 col-xs-12 col-sm-12">
        
        <div class="panel panel-default">
                
               <div class="panel-heading">
               </div> 
               <div class="panel-body">  
            <?php $form = ActiveForm::begin(['id' => 'validate-form']); ?>
            
                <div class="col-md-12">
	      
	     <br></br>
	       <?= $form->field($model, 'numero_serie', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-barcode"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'No. serie del producto','class'=>'form-control input-lg', 'maxlength' => "16"])->label(false); ?>
			
			</div>
			
			   <div class="col-md-12">
	      
	
	       <?= $form->field($model, 'correo_electronico_proveedor', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-envelope-o"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Ingrese correo electronico','class'=>'form-control input-lg'])->label(false); ?>
			
			</div>
			
			
            
            
                
                <?php echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <div class="panel-footer">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Consultar'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
            
            </div>
          </div>  
        </div>
        
        <div class="col-md-5 col-xs-12 col-sm-12">
       
        						<?php if($modelResult && $modelResult->idProvedor):?>
        <div class="panel panel-success">
        	<div class="panel-body">
        	 								<img class="img-thumbnail" style="width:250px; height:150px;" src="<?= isset ($modelResult->tipoProducto->path)? $modelResult->tipoProducto->base.'/' . $modelResult->tipoProducto->path : '/img/business-card.png'?>" alt="" />
        	 				
        	 						<dl class="dl-horizontal">
                                        <dt><h3>Numero de serie</h3></dt>
                                        <dd><h3><?=$modelResult->numero_serie; ?></h3></dd>
                                        <dt>Tipo producto</dt>
                                        <dd><?=$modelResult->tipoProducto->nombre . ' - ' . $modelResult->tipoProducto->getCategoriaProducto(); ?></dd>
                                        <dt>Descripción</dt>
                                        <dd><?=$modelResult->descripcion; ?></dd>
                                        
                                        <dt>Fecha de fabricación</dt>
                                        <dd><?= isset($modelResult->fecha_fabricacion)? Yii::$app->formatter->asDatetime( $modelResult->fecha_fabricacion) :  'fecha no definida';?></dd>
                                        
                                        <dt><i>Asignado a proveedor</i></dt>
                                        <dd><?=$modelResult->id_provedor." - ".$modelResult->idProvedor->nombre; ?></dd>
                                        
                                    </dl>
                                    
                                 </div>
                                 <div class="panel-footer"> <h3 class="text text-warning"><?php echo ($modelResult->estado== Producto::STATUS_STOLED_PROCESS) ? 'Producto con reporte de robo o extravio.' : ''  ;?></h3></div>
        		</div>
                                 </div>   
                                  <?php elseif($modelResult):?>
         <div class="panel panel-info">
        	<div class="panel-body">
        	
        	 						<img class="img-thumbnail" style="width:350px; height:250px;" src="<?= isset ($modelResult->tipoProducto->path)? $modelResult->tipoProducto->base.'/' . $modelResult->tipoProducto->path : '/img/business-card.png'?>" alt="" />
        	
        	
        	 						<dl class="dl-horizontal">
                                        <dt><h3>Numero de serie</h3></dt>
                                        <dd><h3><?=$modelResult->numero_serie; ?></h3></dd>
                                        <dt>Tipo producto</dt>
                                        <dd><?=$modelResult->tipoProducto->nombre. ' - ' . $modelResult->tipoProducto->getCategoriaProducto(); ?></dd>
                                        <dt>Descripción</dt>
                                        <dd><?=$modelResult->descripcion; ?></dd>
                                        
                                        <dt>Fecha de fabricación</dt>
                                        <dd><?= isset($modelResult->fecha_fabricacion)? Yii::$app->formatter->asDatetime( $modelResult->fecha_fabricacion) :  'fecha no definida';?></dd>
                                        
                                        <dt><i class="text text-warning">No asignado a proveedor</i></dt>
                                        
                                        
                                        
                                    </dl>
                                    
                                  
                                    
                                  <?php endif;?> 
        		</div>
        		<div class="panel-footer">
        		 <?php if( isset($modelResult) ):?>
        		 <h3 class="text text-warning"><?php echo ($modelResult->estado== Producto::STATUS_STOLED_PROCESS) ? 'Producto con reporte de robo o extravio.' : ''  ;?></h3>
        		 
        		 <?php endif;?>
        		 
        		 </div>
        		</div>
        	</div>
        </div>
        
    </div>
</div>