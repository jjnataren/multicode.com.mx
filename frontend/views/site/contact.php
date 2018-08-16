<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Contacto';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
		
		 (function($) {
        $.fn.CustomMap = function(options) {

          var posLatitude = $('#map').data('position-latitude'),
            posLongitude = $('#map').data('position-longitude');

          var settings = $.extend({
            home: {
              latitude: posLatitude,
              longitude: posLongitude
            },
            text: '<div class=\"map-popup\"><h4>Web Development | ZoOm-Arts</h4><p>A web development blog for all your HTML5 and WordPress needs.</p></div>',
            icon_url: $('#map').data('marker-img'),
            zoom: 15
          }, options);

          var coords = new google.maps.LatLng(settings.home.latitude, settings.home.longitude);

          return this.each(function() {
            var element = $(this);

            var options = {
              zoom: settings.zoom,
              center: coords,
              mapTypeId: google.maps.MapTypeId.ROADMAP,
              mapTypeControl: false,
              scaleControl: false,
              streetViewControl: false,
              panControl: true,
              disableDefaultUI: true,
              zoomControlOptions: {
                style: google.maps.ZoomControlStyle.DEFAULT
              },
              overviewMapControl: true,
            };

            var map = new google.maps.Map(element[0], options);

            var icon = {
              url: settings.icon_url,
              origin: new google.maps.Point(0, 0)
            };

            var marker = new google.maps.Marker({
              position: coords,
              map: map,
              icon: icon,
              draggable: false
            });

            var info = new google.maps.InfoWindow({
              content: settings.text
            });

            google.maps.event.addListener(marker, 'click', function() {
              info.open(map, marker);
            });

            var styles = [{
              \"featureType\": \"landscape\",
              \"stylers\": [{
                \"saturation\": -100
              }, {
                \"lightness\": 65
              }, {
                \"visibility\": \"on\"
              }]
            }, {
              \"featureType\": \"poi\",
              \"stylers\": [{
                \"saturation\": -100
              }, {
                \"lightness\": 51
              }, {
                \"visibility\": \"simplified\"
              }]
            }, {
              \"featureType\": \"road.highway\",
              \"stylers\": [{
                \"saturation\": -100
              }, {
                \"visibility\": \"simplified\"
              }]
            }, {
              \"featureType\": \"road.arterial\",
              \"stylers\": [{
                \"saturation\": -100
              }, {
                \"lightness\": 30
              }, {
                \"visibility\": \"on\"
              }]
            }, {
              \"featureType\": \"road.local\",
              \"stylers\": [{
                \"saturation\": -100
              }, {
                \"lightness\": 40
              }, {
                \"visibility\": \"on\"
              }]
            }, {
              \"featureType\": \"transit\",
              \"stylers\": [{
                \"saturation\": -100
              }, {
                \"visibility\": \"simplified\"
              }]
            }, {
              \"featureType\": \"administrative.province\",
              \"stylers\": [{
                \"visibility\": \"on\"
              }]
            }, {
              \"featureType\": \"water\",
              \"elementType\": \"labels\",
              \"stylers\": [{
                \"visibility\": \"on\"
              }, {
                \"lightness\": -25
              }, {
                \"saturation\": -100
              }]
            }, {
              \"featureType\": \"water\",
              \"elementType\": \"geometry\",
              \"stylers\": [{
                \"hue\": \"#ffff00\"
              }, {
                \"lightness\": -25
              }, {
                \"saturation\": -97
              }]
            }];

            map.setOptions({
              styles: styles
            });
          });

        };
      }(jQuery));

      jQuery(document).ready(function() {
        jQuery('#map').CustomMap();
      });
  
		
		", View::POS_READY, 'noneoptions234');

?>

 <!-- Start Map -->
    <div id="map" data-position-latitude="19.3941116" data-position-longitude="-99.0149527"></div>
  
    <!-- End Map -->


<div id="content">
      <div class="container">
<div class="site-contact">
   <div class="col-md-12">
<h2 class="classic-title"><span><?php echo Html::encode($this->title) ?></span></h2>
    <div class="row">
    
    
<div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-body">
        
        <div class="col-md-8">
       <h4 class="classic-title"><span>Registro de Datos</span></h4>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            
             <div class="col-md-11">
	      
	      
	       <?= $form->field($model, 'name', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-user"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Nombre del contacto','class'=>'form-control input-lg'])->label(false); ?>
			</div>  
            
             <div class="col-md-11">
	      
	      
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
            
             <div class="col-md-11">
	      
	      
	       <?= $form->field($model, 'subject', ['template' => 
		     		'<div class="form-group">
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-option-horizontal"></span>
		          </span>
		          {input}
		     		
		       </div>
		     			
		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Tema','class'=>'form-control input-lg'])->label(false); ?>
			</div> 
            <div class="col-md-11">
	      
	      
	       <?= $form->field($model, 'body')->textArea(['rows' => 6]); ?>
			</div> 
			
              
               
               
                
                <?php echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
       </div>
        
         <div class="col-md-4">

            <!-- Classic Heading -->
            <h4 class="classic-title"><span>Información</span></h4>

            <!-- Some Info -->
            <p>Póngase en contacto con nosotros para obtener más información acerca de nuestros productos y servicios. Nuestro servicio de atención al cliente le ayudará a encontrar aquello que necesite y le recomendará los accesorios y opciones de entrega más adecuados...</p>

            <!-- Divider -->
            <div class="hr1" style="margin-bottom:10px;"></div>

            <!-- Info - Icons List -->
            <ul class="icons-list">
              <li><i class="fa fa-globe">  </i> <strong>Dirección:</strong> Ciudad Nezahualcóyotl, Estado de México.</li>
              <li><i class="fa fa-envelope-o"></i> <strong>Email:</strong> contacto@multicode.com.mx</li>
              <li><i class="fa fa-mobile"></i> <strong>Teléfono:</strong>  (55)69325006</li>
			  
            </ul>

            <!-- Divider -->
            <div class="hr1" style="margin-bottom:15px;"></div>

            <!-- Classic Heading -->
            <h4 class="classic-title"><span>Horarios de Atención</span></h4>
	
            <!-- Info - List -->
            <ul class="list-unstyled">
              <li><strong>Lunes a Viernes 	</strong> - 9:00am a 8:00pm</li>
              <li><strong>Sábado</strong> - 9:00am a 2:00pm</li>
              <li><strong>Domingo</strong> - Sin atención</li>
            </ul>

          </div>
    </div>
    </div>
    </div>
    </div>
  
</div>
</div>
</div>
</div>
