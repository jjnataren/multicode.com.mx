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

$this->title = Yii::t('frontend', 'Distribuidores Autorizados.');


?>

	
<div class="page-banner">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>Distribuidores Autorizados </h2>
            
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="/">Inicio</a></li>
              <li>Distribuidores</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  
  
 <div id="content">
<div class="container">
<div class="page-content">
 
 
 
          <div class="row">
          
          <?php foreach ($proveedores as $proveedor):?>

            <!-- Start Image Service Box 1 -->
            <div class="col-md-4 image-service-box">
            <!--    <img class="img-thumbnail" style="width:350px; height:250px;" src="<?= isset ($proveedor->img_path)? $proveedor->img_base.'/' . $proveedor->img_path : '/img/business-card.png'?>" alt="" /> -->
              <h3><?= $proveedor->nombre;?></h3>
              <p><?= $proveedor->descripcion; ?></p>
              <address>
					  
			 <?php if (isset($proveedor->telefono) &&  strlen(trim($proveedor->telefono) ) > 0 ) :?>	<i class="fa fa-phone"></i>&nbsp;<abbr title="Telefono de contacto">Tel: </abbr><?= $proveedor->telefono; ?><br /><?php endif;?>
				
			<?php if (isset($proveedor->email)  &&  strlen(trim($proveedor->email) ) > 0 ) :?>	<i class="fa fa-envelope"></i>&nbsp;<abbr title="Correo electronico">Email: </abbr><?= $proveedor->email; ?><br /> <?php endif;?>
			<?php if (isset($proveedor->facebook_url)  &&  strlen(trim($proveedor->facebook_url) ) > 0 ) :?>	<i class="fa fa-facebook-square"></i>&nbsp;<abbr title="Facebook">Facebook: </abbr> <a href="<?= $proveedor->facebook_url;?>" target="_blank"><?= $proveedor->facebook_url; ?></a><br /><?php endif;?>
			<?php if (isset($proveedor->sitio_url)  &&  strlen(trim($proveedor->sitio_url) ) > 0 ) :?>	<i class="fa fa-globe"></i>&nbsp;<abbr title="Correo electronico">Sitio: </abbr><a href="<?= $proveedor->sitio_url;?>" target="_blank"><?= $proveedor->sitio_url; ?></a><br /><?php endif;?>
			<?php if (isset($proveedor->direccion)  &&  strlen(trim($proveedor->direccion) ) > 0 ) :?>	<i class="fa fa-map-marker"></i>&nbsp;<abbr title="Dirección de contacto">Dir: </abbr><?=$proveedor->direccion?><br /><?php endif;?>
				
			</address>
            </div>
            <!-- End Image Service Box 1 -->

			<?php endforeach;?>
 
            </div>
       </div>
       </div>
       </div>