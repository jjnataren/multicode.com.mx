<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use trntv\filekit\widget\Upload;
use yii\base\Object;
use yii\web\View;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */

$this->title = Yii::t('frontend', 'Signup');
$this->params['breadcrumbs'][] = $this->title;

?>

 <!-- Start Page Banner -->
    <div class="page-banner no-subtitle">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>Registro de cliente</h2>
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="/">Inicio</a></li>
              <li>Registro cliente</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

 <div id="content">
 <div class="container">
 
    <!-- Classic Heading -->
      
 <h2 class="classic-title"><span><?php echo Html::encode($this->title) ?></span></h2>
    <div class="row">
     
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-body">
      
     <?php $form = ActiveForm::begin(['id' => 'form-signup',
     		//'enableAjaxValidation'   => true,
     		//'enableClientValidation' => false,
     		'options'=>['class'=>"contact-form", 'role'=>'form']]); ?>
        
        <div class="col-md-12">
           		
             <h4 class="classic-title"><span>Datos de acceso</span></h4>
                	
         <div class="row">
         
                    <div class="col-md-8">     	
		     <?= $form->field($model, 'username', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-user"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Usuario de acceso','class'=>'form-control input-lg'])->label(false); ?>
			</div>
				
			<div class="col-md-4">	
				<small>Usuario de acceso al sistema, sin caracteres especiales.</small>
			</div>	                
	                  	
	    
            
	       
             
             <div class="col-md-8">   
                 <?= $form->field($model, 'password', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-lock"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->passwordInput(['placeholder' => 'Contraseña de acceso','class'=>'form-control input-lg'])->label(false); ?>
	
                
                
              </div>  
            
              <div class="col-md-4">
             	<small>Contraseña de acceso, mínimo 6 caracteres </small>
             </div>  
         
           <div class="col-md-8">
	      
	      
	       <?= $form->field($productoModel, 'numero_serie', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-barcode"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Número de serie producto','class'=>'form-control input-lg'])->label(false); ?>
			</div>  
                
                
             <div class="col-md-4">
             	<small>Para poder registrarte deberás ingresar el número de serie de tu producto</small>
             </div>
         
         
         	 <div class="col-md-8">
	      
	      
	       <?= $form->field($productoModel, 'codigo_registro', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-eye"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Código de validación del producto','class'=>'form-control input-lg'])->label(false); ?>
			</div>  
                
                
             <div class="col-md-4">
             	<small>Ingresar el Código de registro del producto</small>
             </div>
         
         
         

             
             <div class="col-md-8">
              <?php echo $form->field($productoModel, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-md-3">{image}</div><div class="col-md-6">{input}</div></div>',
              		'captchaAction'=>'/user/sign-in/captcha',
              		'options'=>['placeholder' => 'Código de verificación','class'=>'form-control input-lg']
                ])->label(false) ?>
             </div>   
              
               <div class="col-md-4">
             	<small>Ingresa el codigo que aparece en la imagen.</small>
             </div>  
                
          </div>   
        
		
		
		
		<h4 class="classic-title"><span>Datos de contacto</span></h4>
		
		<div class="row">

	
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
   				</div>'])->textInput(['placeholder' => 'Correo electrónico ','class'=>'form-control input-lg'])->label(false); ?>
			</div>  
                
                
             <div class="col-md-4">
             	<small>Correo electronico de contacto</small>
             </div>
	
		     <div class="col-md-8">   	
	           	
		     <?= $form->field($userProfile, 'firstname', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-option-horizontal"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Nombre del cliente','class'=>'form-control input-lg'])->label(false); ?>
			</div>  
                
                
             <div class="col-md-4">
             	<small>Nombre (s) del cliente</small>
             </div>
    
		
	   
	 <div class="col-md-8">   	
	           	
		     <?= $form->field($userProfile, 'middlename', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-option-horizontal"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Apellido paterno','class'=>'form-control input-lg'])->label(false); ?>
			</div>  
                
                
             <div class="col-md-4">
             	<small>...</small>
             </div>
	
	<div class="col-md-8">   	
	           	
		     <?= $form->field($userProfile, 'lastname', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-option-horizontal"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Apellido materno','class'=>'form-control input-lg'])->label(false); ?>
			</div>  
                
                
             <div class="col-md-4">
             	<small>...</small>
             </div>
	  


			<div class="col-md-8">   	
	           	
		     <?= $form->field($userProfile, 'locale', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-globe"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->dropDownlist(Yii::$app->params['availableLocales'],['prompt' => 'Idioma','class'=>'form-control input-lg'])->label(false); ?>
			</div>  
                
                
             <div class="col-md-4">
             	<small>Idioma preferido</small>
             </div>


	    <div class="col-md-8">   	
	           	
		     <?= $form->field($userProfile, 'gender', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="fa fa-venus"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->dropDownlist([
								        \common\models\UserProfile::GENDER_FEMALE => Yii::t('frontend', 'Female'),
								        \common\models\UserProfile::GENDER_MALE => Yii::t('frontend', 'Male')
	    		],['prompt' => 'Genero','class'=>'form-control input-lg'])->label(false); ?>
			</div>  
                
                
             <div class="col-md-4">
             	<small>...</small>
             </div>
	
	    
	    </div>
	    
	    
	    <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
          
		</div>        
        
          </div>
		</div>	
		
        <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


</div>