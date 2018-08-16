<div class="page-banner">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>Promociones</h2>
            <p>¡Mantente en contacto y aprovecha nuestras promociones!</p>
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="#">Inicio</a></li>
              <li>Promociones</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    
     <!-- Start Content -->
    
      <div class="container">
        <div class="page-content">


          <div class="row">

            
            <div class="col-md-9">

              <!-- Start Touch Slider -->
              <div class="touch-slider" data-slider-navigation="true" data-slider-pagination="true" >
              
              
              <?php foreach ($promotions as $promotion): ?>
                <div class="item">
                <br />
                <h2><?=strtoupper($promotion->titulo); ?></h2>
                <br /> 
                <div class="col-md-9">
                <a href="#";><img alt="" style="height: 400px; width: 600px;" src="<?=$promotion->base.'/'.$promotion->path ?>"></a>
                </div>
                <div class="col-md-3">
                <p class="text text-info"><?php echo $promotion->descripcion;?></p>
                </div>
                </div>
                
                <?php endforeach;?>
                
                
              </div>
              </div>
              
              <div class="col-md-3">

              <!-- Classic Heading -->
              <h4 class="classic-title"><span>¿Te intereso alguna promoción? </span></h4>

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
              <!-- End Touch Slider -->

            

          </div>

          <!-- Divider -->
          <div class="hr1" style="margin-bottom:50px;"></div>

         

         
      
          
          


        </div>
      </div>
    <!-- End content -->

