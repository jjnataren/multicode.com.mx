<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\LoginForm */

$this->title = Yii::t('frontend', 'Login');
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
              <li><a href="/">Home</a></li>
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
        <div class="col-md-10">
      <div class="panel panel-default">
        <div class="panel-body">
        
        <div class="col-md-10">
        <h4 class="classic-title"><span>Datos de acceso</span></h4>
        
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            
            <div class="col-md-11">
	         
	       <?= $form->field($model, 'identity', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-user"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Nombre de usuario','class'=>'form-control input-lg'])->label(false); ?>
			</div> 
			
			
			 <div class="col-md-11">   
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
	
                
                
             
			
                
                
                <?php echo $form->field($model, 'rememberMe')->checkbox() ?>
                <div style="color:#999;margin:1em 0">
                    <?php echo Yii::t('frontend', 'If you forgot your password you can reset it <a href="{link}">here</a>', [
                        'link'=>yii\helpers\Url::to(['sign-in/request-password-reset'])
                    ]) ?>
                </div>
                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
             
                
                <div class="form-group">
                    <?php echo Html::a(Yii::t('frontend', 'Need an account? Sign up.'), ['signup']) ?>
                </div>
                <h2><?php echo Yii::t('frontend', 'Log in with')  ?>:</h2>
                <div class="form-group">
                    <?php echo yii\authclient\widgets\AuthChoice::widget([
                        'baseAuthUrl' => ['/user/sign-in/oauth']
                    ]) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
         </div> 
    </div>
       </div>
    </div>
    </div>
    
</div>
</div>