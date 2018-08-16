<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Garantia;

/* @var $this yii\web\View */
/* @var $model backend\models\Garantia */

$this->title = $model->id_solicitud;
$this->params['breadcrumbs'][] = ['label' => 'Garantias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-check-square fa-stack-1x"></i>
							   </span>';

?>
<div class="row">

<div class="col-md-6 col-xs-12 col-sm-12">

    <p>
        <?php echo Html::a('Actualizar', ['update', 'id' => $model->id_solicitud], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Borrar', ['delete', 'id' => $model->id_solicitud], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_solicitud',
            'numero_serie',
            'fecha_solicitud',
            'fecha_ingreso_garantia',

        ],
    ]) ?>
    
 </div>
 
 
 
   <div class="col-md-6 col-xs-12 col-sm-12">
   	
	<ul class="timeline">

    <!-- timeline time label -->
    <li class="time-label">
    	
        <span class="bg-green">
        	<i class="fa fa-calendar"></i>&nbsp;
            <?= isset($model->fecha_ingreso_garantia)? Yii::$app->formatter->asDatetime( $model->fecha_ingreso_garantia) :  'fecha no definida';?>
        </span>
    </li>
    <!-- /.timeline-label -->

    <!-- timeline item -->
    <li>
        <!-- timeline icon -->
        <i class="fa fa-plus-square-o bg-blue"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-plus-square"></i></span>

            <h2 class="timeline-header"><a href="#">Producto ingreso a garantia</a></h2>

            <div class="timeline-body">
              El producto fue recibido para revisión de garantia
            </div>

            <!-- <div class="timeline-footer">
                <a class="btn btn-primary btn-xs">...</a> 
            </div>-->
        </div>
    </li>    
    <!-- END timeline item -->
    
     <!-- timeline time label -->
    
    <?php if (isset ($model->fecha_captura)):?>
    
    <li class="time-label">
        <span class="bg-green">
        	<i class="fa fa-calendar"></i>&nbsp;
            <?= isset($model->fecha_captura)? Yii::$app->formatter->asDatetime( $model->fecha_captura) :  'fecha no definida';?>
        </span>
    </li>
   
    <?php endif;?>
    
     <li>
        <!-- timeline icon -->
        <i class="fa fa-check-square <?= ($model->estatus >= Garantia::STATUS_REGISTERED )? 'bg-blue':'bg-gray'?>"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-product-hunt"></i></span>

            <h3 class="timeline-header text-danger"><a href="#">Solicitud de garantía capturada</a></h3>

            <div class="timeline-body">
                 
                 <?= ($model->estatus  >=  Garantia::STATUS_REGISTERED  )? 'Se ha iniciado un proceso de garantía':'<small><i>No se ha alcanzado este estado</i></small>'?>
                
                
                
                <?php if (isset($model->numeroSerie)):?>
                
                <h4>Producto</h4>
                 
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('backend', 'Número de serie ') ?></dt>
                        <dd><?= $model->numero_serie ?></dd>
                        
                        <dt><?= Yii::t('backend', 'Tipo producto') ?></dt>
                        <dd><?= $model->numeroSerie->getTipoNombreProducto(); ?></dd>
                        
                        <dt><?= Yii::t('backend', 'Precio ($)') ?></dt>
                        <dd><?= $model->numeroSerie->precio_sugerido ?></dd>
                                             
                           <dt><?= Yii::t('backend', 'Fecha fabricación') ?></dt>
                        <dd><?= $model->numeroSerie->fecha_fabricacion; ?></dd>
                        
    					<dt><?= Yii::t('backend', 'Descripción') ?></dt>
                        <dd><?= $model->numeroSerie->descripcion ?></dd>               
	                 </dl>
                 
                  <?php if (isset($model->numeroSerie->idPropietario)):?>
                 
                 <h4>Cliente</h4>
                 
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('backend', 'Id cliente ') ?></dt>
                        <dd><?= $model->numeroSerie->idPropietario->id_cliente ?></dd>
                        
                        <dt><?= Yii::t('backend', 'Nombre') ?></dt>
                        <dd><?= $model->numeroSerie->idPropietario->nombre . ' ' . $model->numeroSerie->idPropietario->apellido_paterno . ' ' .$model->numeroSerie->idPropietario->apellido_paterno  ; ?></dd>
                        
                        <dt><?= Yii::t('backend', 'Correo electronico') ?></dt>
                        <dd><?= $model->numeroSerie->idPropietario->email; ?></dd>
                                             
                        <dt><?= Yii::t('backend', 'Telefono') ?></dt>
                        <dd><?= $model->numeroSerie->idPropietario->telefono; ?></dd>
                        
	                 </dl>
                 
                 <?php endif;?>
                 
                 
                 
                 <?php endif;?>
            </div>

            <div class="timeline-footer">
                <a class="btn btn-primary btn-xs">...</a>
            </div>
        </div>
    </li>
    
     <?php if (isset ($model->fecha_envio)):?>
    
    <li class="time-label">
        <span class="bg-green">
        	<i class="fa fa-calendar"></i>&nbsp;
            <?= isset($model->fecha_envio)? Yii::$app->formatter->asDatetime( $model->fecha_envio) :  'fecha no definida';?>
        </span>
    </li>
   
    <?php endif;?>
    
    
     <li>
        <!-- timeline icon -->
         <i class="fa fa-truck <?= ($model->estatus >  Garantia::STATUS_REGISTERED )? 'bg-blue':'bg-gray'?>"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-check-square"></i></span>

            <h3 class="timeline-header"><a href="#">Producto enviado al cliente</a></h3>

            <div class="timeline-body">
				
				 <?= ($model->estatus > Garantia::STATUS_REGISTERED )? 'Se ha enviado el producto al cliente':'<small><i>No se ha alcanzado este estado</i></small>'?>
				 
				 <?php if ($model->estatus > Garantia::STATUS_REGISTERED): ?>
				 
		             <dl class="dl-horizontal">
                        <dt><?= Yii::t('backend', 'Fecha de envio') ?></dt>
                        <dd><?= $model->fecha_envio ?></dd>
                        
                        <dt><?= Yii::t('backend', 'Folio de envio') ?></dt>
                        <dd><?= $model->folio_envio; ?></dd>
                        
                        <dt><?= Yii::t('backend', 'Número de guía') ?></dt>
                        <dd><?= $model->numero_guia ?></dd>
                                             
                      
	                 </dl>
	                 
	                <?php endif;?> 
        
				 

            </div>

            <div class="timeline-footer">
                <a class="btn btn-primary btn-xs">...</a>
            </div>
        </div>
    </li>
    
    
    <?php if (isset ($model->fecha_recibio_cliente)):?>
    
    <li class="time-label">
        <span class="<?= isset($model->fecha_recibio_cliente)? 'bg-green' :  'bg-gray';?>">
        	<i class="fa fa-calendar"></i>&nbsp;
            <?= isset($model->fecha_recibio_cliente)? Yii::$app->formatter->asDatetime( $model->fecha_recibio_cliente) :  'fecha no definida';?>
        </span>
    </li>
   
    <?php endif;?>
    
     <li>
        <!-- timeline icon -->
       
         <i class="fa fa-flag-checkered <?= ($model->estatus > Garantia::STATUS_SENT_CLIENT )? 'bg-blue':'bg-gray'?>"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-flag-checkered"></i></span>

            <h3 class="timeline-header"><a href="#">Producto recibido por el cliente</a></h3>

            <div class="timeline-body">
            <!--TODO: Reemplazar por estados a nivel de clase  -->
            					 <?= ($model->estatus > Garantia::STATUS_SENT_CLIENT )? 'El cliente ha recibido el producto':'<small><i>No se ha alcanzado este estado</i></small>'?>
            					 
            					 <?php if ($model->estatus > Garantia::STATUS_SENT_CLIENT ):?>
            					 
            		<dl class="dl-horizontal">
            		
            			<dt><?= Yii::t('backend', 'Fecha recibio cliente') ?></dt>
                        <dd><?= $model->fecha_recibio_cliente?></dd>
            		
                     </dl>
            		<?php endif;?>
            </div>

            <div class="timeline-footer">
                <a class="btn btn-primary btn-xs">...</a>
            </div>
        </div>
    </li>
    
    
    
      <?php if (isset ($model->fecha_valido_cliente)):?>
    
    <li class="time-label">
        <span class="bg-green">
        	<i class="fa fa-calendar"></i>&nbsp;
            <?= isset($model->fecha_valido_cliente)? Yii::$app->formatter->asDatetime( $model->fecha_valido_cliente) :  'fecha no definida';?>
        </span>
    </li>
   
    <?php endif;?>
    
     <li>
        <!-- timeline icon -->
       
         <i class="fa fa-flag-checkered <?= ($model->estatus > Garantia::STATUS_RECEIVED_CLIENT )? 'bg-blue':'bg-gray'?>"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-flag-checkered"></i></span>

            <h3 class="timeline-header"><a href="#">Producto validado por el liente</a></h3>

            <div class="timeline-body">
            <!--TODO: Reemplazar por estados a nivel de clase  -->
            					 <?= ($model->estatus > Garantia::STATUS_RECEIVED_CLIENT )? 'El cliente ha validado  el producto':'<small><i>No se ha alcanzado este estado</i></small>'?>
            					 
            					 <?php if ($model->estatus > Garantia::STATUS_RECEIVED_CLIENT ):?>
            					 
            		<dl class="dl-horizontal">
            		
            			<dt><?= Yii::t('backend', 'Fecha validación') ?></dt>
                        <dd><?= $model->fecha_valido_cliente;?></dd>
            		
                     </dl>
            		<?php endif;?>
            </div>

            <div class="timeline-footer">
                <a class="btn btn-primary btn-xs">...</a>
            </div>
        </div>
    </li>


</ul>
   	
   </div> 
 
    

</div>
