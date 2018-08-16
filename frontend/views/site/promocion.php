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

$this->title =  'Promoción - ' . $promotion->titulo;


?>

	
<div class="page-banner">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>Promoción - <?=$promotion->titulo; ?> </h2>
            
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="/">Inicio</a></li>
              <li>Promoción</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  
   <!-- Start Content -->
    <div id="content">
      <div class="container">
        <div class="page-content">


          <div class="row">

            <div class="col-md-9">
            
     
       	
       	    <div class="col-md-9">
       	    
       	       <h4 class="classic-title"><span><?=strtoupper($promotion->titulo) ?></span></h4>
       	    
       	    	<img alt="Promocion" src="<?=$promotion->base . '/' . $promotion->path; ?>" />
       	    
       	    
       	    </div>
       	    
       	<div class="col-md-3">

		<h4 class="classic-title"><span>Descripción</span></h4>

       	<p> <?=$promotion->descripcion; ?></p>
      
       	<p>Con gusto atenderemos tus dudas, recuerda que el horario de atención es de:</p>
       	<p>Lunes a viernes, de 11 a 14 horas.</p>
       	
       	</div>
      
            </div>
            
          <div class="col-md-3">

              <!-- Classic Heading -->
              <h4 class="classic-title"><span>¿Te intereso esta promoción? </span></h4>

	          <h4 class="classic-title"><span>¡Contactanos!</span></h4>


            <!-- Divider -->
            <div class="hr1" style="margin-bottom:10px;"></div>

            <!-- Info - Icons List -->
            <ul class="icons-list">
              <li><i class="fa fa-globe">  </i> <strong>Dirección:</strong> Ciudad Nezahualcóyotl, Estado de México.</li>
              <li><i class="fa fa-envelope-o"></i> <strong>Email:</strong> contacto@multicode.com.mx</li>
              <li><i class="fa fa-mobile"></i> <strong>Teléfono:</strong>  (55)69325006</li>
			  
            </ul>
 

           </div>
          

          </div>

          <!-- Divider -->
          <div class="hr1" style="margin-bottom:50px;"></div>

          <div class="row">
			
            <div class="col-md-6">
            
           
            <h4 class="classic-title"><span>¡Conócenos más! Síguenos en….</span></h4>
            
            
            
            <a href="https://www.facebook.com/multicode.alfredotrejo?fref=ts" target="_bank"><i class="fa fa-facebook-square fa-5x ">    </i></a>
           
            <a href="https://www.youtube.com/channel/UCGytX53FUhl85X2tQZnzgvw" target="_bank"><span  class="fa fa-youtube-square fa-5x ">    </span ></a>
            <a href="#"><i class="fa fa-skype fa-5x "></i>    </a>
            
            </div> 
				
      

          </div>

         
      
          
          


        </div>
      </div>
    </div>
    <!-- End content -->

  