<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\SolicitudRobo;

/* @var $this yii\web\View */
/* @var $model backend\models\SolicitudRobo */

$this->title ='Solicitud de robo id '. $model->id_solicitud_robo;
$this->params['breadcrumbs'][] = ['label' => 'Reportes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-user-secret fa-stack-1x"></i>
							   </span>';
?>
<div class="solicitud-robo-view">

    

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_solicitud_robo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id_solicitud_robo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
 <div class="col-md-6 col-xs-12 col-sm-12">   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_solicitud_robo',
            'numero_serie',
            'fecha_robo',
            'fecha_solicitud',
            'fecha_desactivar',
        		'fecha_validacion',
        		'descripcion',
            'acta_robo',
        	
        		['attribute'=> 'estatus',
        		'value'=> $model->getEstadoRepore()
        		],
            
        ],
    ]) ?>
</div>

   <div class="col-md-6 col-xs-12 col-sm-12">
   	
	<ul class="timeline">

    <!-- timeline time label -->
    <li class="time-label">
    	
        <span class="bg-green">
        	<i class="fa fa-calendar"></i>&nbsp;
            <?= isset($model->fecha_solicitud)? Yii::$app->formatter->asDatetime( $model->fecha_solicitud) :  'fecha no definida';?>
        </span>
    </li>
    <!-- /.timeline-label -->

    <!-- timeline item -->
    <li>
        <!-- timeline icon -->
        <i class="fa fa-plus-square-o bg-blue"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-plus-square"></i></span>

            <h2 class="timeline-header"><a href="#">Reporte de robo creado</a></h2>

            <div class="timeline-body">
              El reporte de robo fue creado con satisfacción.
            </div>

            <!-- <div class="timeline-footer">
                <a class="btn btn-primary btn-xs">...</a> 
            </div>-->
        </div>
    </li>    
    <!-- END timeline item -->
    
     <!-- timeline time label -->
    
    <?php if (isset ($model->fecha_validacion)):?>
    
    <li class="time-label">
        <span class="bg-green">
        	<i class="fa fa-calendar"></i>&nbsp;
            <?= isset($model->fecha_validacion)? Yii::$app->formatter->asDatetime( $model->fecha_validacion) :  'fecha no definida';?>
        </span>
    </li>
   
    <?php endif;?>
    
     <li>
        <!-- timeline icon -->
        <i class="fa fa-check-square <?= ($model->estatus >= SolicitudRobo::STATUS_VALIDADO )? 'bg-blue':'bg-gray'?>"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-product-hunt"></i></span>

            <h3 class="timeline-header text-danger"><a href="#">Reporte de robo aceptado</a></h3>

            <div class="timeline-body">
                 
                 <?= ($model->estatus  >=  SolicitudRobo::STATUS_VALIDADO  )? 'Se ha aceptado el reporte de robo del producto':'<small><i>No se ha alcanzado este estado</i></small>'?>
                
                
                
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
    
     <?php if (isset ($model->fecha_desactivar)):?>
    
    <li class="time-label">
        <span class="bg-green">
        	<i class="fa fa-calendar"></i>&nbsp;
            <?= isset($model->fecha_desactivar)? Yii::$app->formatter->asDatetime( $model->fecha_desactivar) :  'fecha no definida';?>
        </span>
    </li>
   
    <?php endif;?>
    
    
     <li>
        <!-- timeline icon -->
         <i class="fa fa-truck <?= ($model->estatus >  SolicitudRobo::STATUS_RECHAZADO)? 'bg-blue':'bg-gray'?>"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-check-square"></i></span>

            <h3 class="timeline-header"><a href="#">Producto desactivado</a></h3>

            <div class="timeline-body">
				
				 <?= ($model->estatus > SolicitudRobo::STATUS_RECHAZADO)? 'Se ha desactivado el producto':'<small><i>No se ha alcanzado este estado</i></small>'?>
				 
				 <?php if (isset($model->numeroSerie)):?>
				 
		             <dl class="dl-horizontal">
                        <dt><?= Yii::t('backend', 'numero de serie') ?></dt>
                        <dd><?= $model->numero_serie ?></dd>
                        
                        <dt><?= Yii::t('backend', 'Tipo producto') ?></dt>
                        <dd><?= $model->numeroSerie->getTipoNombreProducto(); ?></dd>
                        
                  
                      <dt><?= Yii::t('backend', 'Fecha fabricación') ?></dt>
                        <dd><?= $model->numeroSerie->fecha_fabricacion; ?></dd>
                        
    					<dt><?= Yii::t('backend', 'Descripción') ?></dt>
                        <dd><?= $model->numeroSerie->descripcion ?></dd>  
                      
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

