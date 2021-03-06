<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Producto;
use yii\helpers\ArrayHelper;
use backend\models\TipoProducto;


use yii\bootstrap\ActiveForm;

/**
 * Eugine Terentev <eugine@terentev.net>
 * @var $this \yii\web\View
 * @var $model \common\models\TimelineEvent
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

/* @var $this yii\web\View */
/* @var $model backend\models\Producto */

$this->title = 'Producto Id ' . $model->numero_serie;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">


    
    
 <div class="col-md-6 col-xs-12 col-sm-12">   

	    <p>
        <?php echo Html::a('Actualizar', ['update', 'id' => $model->numero_serie], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Eliminar', ['delete', 'id' => $model->numero_serie], [
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
        		
            'numero_serie',
            	['attribute'=> 'tipo_producto',
    	    		'value'=>$model->tipoProducto->nombre . ' - ' .$model->tipoProducto->getCategoriaProducto()
        		],
        		
        		['attribute'=> 'fecha_fabricacion',
	        		'value'=> isset($model->fecha_fabricacion)? Yii::$app->formatter->asDatetime( $model->fecha_fabricacion) :  'fecha no definida'
        		],
        		
        		['attribute'=> 'estado',
        		'value'=> $model->getEstadoProducto()
        				],
        		
        		
            'codigo_registro',
        		
        		['attribute'=>     'precio_sugerido',
        		'value'=>'$ '. $model->precio_sugerido
        		],
        		
        		['attribute'=>     'seguro_robo',
        		'value'=> ($model->seguro_robo)?'Si':'No'
        		],
        		
        		['attribute'=>     'servicio_app',
        		'value'=> ($model->servicio_app)?'Si':'No'
        		],
        		
        		
        
            'descripcion',
        ],
    ]) ?>
    
    
    <!-- <img class="img-thumbnail" style="width:350px; height:250px;" src="<?= isset ($model->tipoProducto->path)? $model->tipoProducto->base.'/' . $model->tipoProducto->path : '/img/clipboard.png'?>" alt="" /> -->
    
    <?php  if($model->estado < Producto::STATUS_SOLED_CLIENT):?>
   
   <div class = "panel panel-primary">
   <div class="panel-heading"><h4>Generar este producto en seríe.</h4></div>
   	<div class="panel-body">
   	
    <?php $form = ActiveForm::begin(); ?>
   	  <div class="col-md-4">
   			<label>Número de productos</label>
   		</div>	
   			<div class="col-md-3">
   			<?= Html::textInput('numero_registros','',['class'=>'form-control']); ?>
   			</div>
   			
            <?= Html::submitButton('Enviar'); ?>
        
    
   	<?php ActiveForm::end(); ?> 
   	
   	</div>
   
   <div class="panel-footer">
   	
   	Este proceso permite generar el producto en serie, indique el número de productos que desee generar.
   
   </div>
   </div> 
   
   <?php endif;?>
    
   </div>
   
   <div class="col-md-6 col-xs-12 col-sm-12">
   	
	<ul class="timeline">

    <!-- timeline time label -->
    <li class="time-label">
    	
        <span class="bg-green">
        	<i class="fa fa-calendar"></i>&nbsp;
            <?= isset($model->fecha_fabricacion)? Yii::$app->formatter->asDatetime( $model->fecha_fabricacion) :  'fecha no definida';?>
        </span>
    </li>
    <!-- /.timeline-label -->

    <!-- timeline item -->
    <li>
        <!-- timeline icon -->
        <i class="fa fa-plus-square-o bg-blue"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-plus-square"></i></span>

            <h2 class="timeline-header"><a href="#">Producto creado</a></h2>

            <div class="timeline-body">
              El producto se ha creado y esta listo para ser asignado
            </div>

            <!-- <div class="timeline-footer">
                <a class="btn btn-primary btn-xs">...</a> 
            </div>-->
        </div>
    </li>    
    <!-- END timeline item -->
    
     <!-- timeline time label -->
    
    <?php if (isset ($model->fecha_asigno_provedor)):?>
    
    <li class="time-label">
        <span class="bg-green">
        	<i class="fa fa-calendar"></i>&nbsp;
            <?= isset($model->fecha_asigno_provedor)? Yii::$app->formatter->asDatetime( $model->fecha_asigno_provedor) :  'fecha no definida';?>
        </span>
    </li>
   
    <?php endif;?>
    
     <li>
        <!-- timeline icon -->
        <i class="fa fa-product-hunt <?= ($model->estado > Producto::STATUS_CREATED )? 'bg-blue':'bg-gray'?>"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-product-hunt"></i></span>

            <h3 class="timeline-header text-danger"><a href="#">Producto asignado a proveedor</a></h3>

            <div class="timeline-body">
                 
                 <?= ($model->estado >  Producto::STATUS_CREATED )? 'El producto ha sido vendido y asignado a un proveedor autorizado':'<small><i>No se ha alcanzado este estado</i></small>'?>
                
                <?php if (isset($model->idProvedor)):?>
                 
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('backend', 'Clave del Proveedor ') ?></dt>
                        <dd><?= $model->idProvedor->clave_proveedor ?></dd>
                        
                        <dt><?= Yii::t('backend', 'Nombre') ?></dt>
                        <dd><?= $model->idProvedor->nombre ?></dd>
                        
                        <dt><?= Yii::t('backend', 'Email') ?></dt>
                        <dd><?= $model->idProvedor->email ?></dd>
                                             
                           <dt><?= Yii::t('backend', 'Whatsapp.') ?></dt>
                        <dd><?= $model->idProvedor->whatsapp ?></dd>
                        
    					<dt><?= Yii::t('backend', 'Tel.') ?></dt>
                        <dd><?= $model->idProvedor->telefono ?></dd>               
	                   </dl>
                 
                 <?php endif;?>
            </div>

            <div class="timeline-footer">
                <a class="btn btn-primary btn-xs">...</a>
            </div>
        </div>
    </li>
    
     <?php if (isset ($model->fecha_valido_proveedor)):?>
    
    <li class="time-label">
        <span class="bg-green">
        	<i class="fa fa-calendar"></i>&nbsp;
            <?= isset($model->fecha_valido_proveedor)? Yii::$app->formatter->asDatetime( $model->fecha_valido_proveedor) :  'fecha no definida';?>
        </span>
    </li>
   
    <?php endif;?>
    
    
     <li>
        <!-- timeline icon -->
         <i class="fa fa-check-square <?= ($model->estado >  Producto::STATUS_ASIGNDED_PROVIDER )? 'bg-blue':'bg-gray'?>"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-check-square"></i></span>

            <h3 class="timeline-header"><a href="#">Producto validado por proveedor</a></h3>

            <div class="timeline-body">
				
				 <?= ($model->estado > Producto::STATUS_ASIGNDED_PROVIDER )? 'El proveedor ha validado el producto':'<small><i>No se ha alcanzado este estado</i></small>'?>

            </div>

            <div class="timeline-footer">
                <a class="btn btn-primary btn-xs">...</a>
            </div>
        </div>
    </li>
    
    
    <?php if (isset ($model->fecha_registro)):?>
    
    <li class="time-label">
        <span class="bg-green">
        	<i class="fa fa-calendar"></i>&nbsp;
            <?= isset($model->fecha_registro)? Yii::$app->formatter->asDatetime( $model->fecha_registro) :  'fecha no definida';?>
        </span>
    </li>
   
    <?php endif;?>
    
     <li>
        <!-- timeline icon -->
       
         <i class="fa fa-flag-checkered <?= ($model->estado > Producto::STATUS_VALIDATED_PROVIDER )? 'bg-blue':'bg-gray'?>"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-flag-checkered"></i></span>

            <h3 class="timeline-header"><a href="#">Producto registrado por el cliente</a></h3>

            <div class="timeline-body">
            <!--TODO: Reemplazar por estados a nivel de clase  -->
            					 <?= ($model->estado > Producto::STATUS_VALIDATED_PROVIDER )? 'El cliente ha registrado el producto':'<small><i>No se ha alcanzado este estado</i></small>'?>
            					 
            					 <?php if (isset($model->idPropietario) && $model->estado > Producto::STATUS_ASIGNDED_PROVIDER):?>
            					 
            		<dl class="dl-horizontal">
            		
            			<dt><?= Yii::t('backend', 'Id cliente ') ?></dt>
                        <dd><?= $model->idPropietario->id_cliente?></dd>
            		
                        <dt><?= Yii::t('backend', 'Nombre del Cliente ') ?></dt>
                        <dd><?= $model->idPropietario->nombre?></dd>
                        
                           <dt><?= Yii::t('backend', 'Razón social ') ?></dt>
                        <dd><?= $model->idPropietario->razon_social?></dd>
                        
                           <dt><?= Yii::t('backend', 'RFC ') ?></dt>
                        <dd><?= $model->idPropietario->rfc?></dd>
                        
                        <dt><?= Yii::t('backend', 'Email') ?></dt>
                        <dd><?= $model->idPropietario->email?></dd>
                        
                           <dt><?= Yii::t('backend', 'Whatsapp ') ?></dt>
                        <dd><?= $model->idPropietario->whatsapp?></dd>
                        
                        <dt><?= Yii::t('backend', 'Tel. ') ?></dt>
                        <dd><?= $model->idPropietario->telefono?></dd>
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
