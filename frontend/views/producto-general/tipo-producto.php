
<?php 
use backend\models\TipoProducto;
use yii\widgets\DetailView;

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
        <div class="page-content">
        
           <?php $categoria= isset(TipoProducto::$categoriaDesc[$model->categoria])?TipoProducto::$categoriaDesc[$model->categoria]:'desconocido' ?>
						

            <div class="col-md-7">

              <!-- Classic Heading -->
              <h4 class="classic-title"><span>Detalles del producto</span></h4>
              
               <table id="dataTable1" class="table table-bordered">
							<tbody>
					
								<tr>
									<th>Nombre</th>
									<TD><?= $model->nombre; ?></TD>	
								</tr>
									<tr>
									<th>Categoria</th>
									<td><?= $categoria; ?></td>
								</tr>
								<tr>
									<th>Descripción</th>
									<td><?= $model->descripcion; ?></td>
									<tr>
							<tr>
									<th>Precio</th>
										<td>$<?= $model->precio_base; ?></td>
								</tr>
								<tr>	
									<th>Status</th>
									<td><?= $model->activo ? 'Si':'No'; ?></td>
								</tr>	
								
								
								
					

	
			
			
			
 		
 			
 		
       	
       	
      </tbody>
      
      </table>
         <img class="img-thumbnail" style="width:350px; height:250px;" src="<?= isset ($model->path)? $model->base.'/' . $model->path : '/img/clipboard.png'?>" alt="" /> 
      
            </div>

          

       
        
           <div class="row">

            <div class="col-md-5">

              <!-- Classic Heading -->
              <h4 class="classic-title"><span>Nuestas promociones</span></h4>

              <!-- Some Text -->
       	<p> Para obtener mayor información sobre nuestras promociones, favor de llamar al teléfono: 55-69-32-50-06	</p>
      
       	<p>o envíanos tus dudas al correo: contacto@multicode.com.mx</p>
       	
       	<p>Con gusto atenderemos tus dudas, recuerda que el horario de atención es de</p>
       	<p>Lunes a viernes, de 11 a 14 horas.</p>
       	
       	
      
            </div>

          

          </div>
 <div class="hr1" style="margin-bottom:50px;"></div>
 
 
     <div class="row">
			
            <div class="col-md-6">
            
           
            <h4 class="classic-title"><span>¡Conócenos más! Síguenos en….</span></h4>
            
            
            
            <a href="https://www.facebook.com/multicode.alfredotrejo?fref=ts" target="_bank"><i class="fa fa-facebook-square fa-5x ">    </i></a>
            <a href="#"><span  class="fa fa-twitter fa-5x ">    </span ></a>
            <a href="https://www.youtube.com/channel/UCGytX53FUhl85X2tQZnzgvw" target="_bank"><span  class="fa fa-youtube-square fa-5x ">    </span ></a>
            <a href="#"><i class="fa fa-skype fa-5x "></i>    </a>
            
            </div> 
            </div>
    
            </div>
            </div>
            </div>
            
				

