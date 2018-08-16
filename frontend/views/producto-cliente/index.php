<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use backend\models\Producto;

/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'Mis productos');

$this->registerJs("$('#dataTable1').dataTable( {'language': {'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json' }});", View::POS_END, 'my-options');


?>


 <!-- Start Page Banner -->
    <div class="page-banner no-subtitle">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>Mis Productos </h2>
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="/">Inicio</a></li>
              <li>Mis Productos</li>
            </ul>
          </div>
        </div>
      </div>
    </div>


<div id="content">
<div class="container">
<div class="col-md-12">
<h2 class="classic-title"><span><?php echo Yii::t('frontend', 'Productos Registrados') ?></span></h2>

      <div class="panel panel-default">
        <div class="panel-body">
        
  <div class="box-body table-responsive" >
                                
                          <table id="dataTable1" class="table table-bordered">
							<thead>
								<tr>
									<th>No. serie</th>
									<th>Tipo</th>
									<th>Descripción</th>
									<th>Código de Validación</th>
									<th>Status</th>
									<th>...</th>
																											
								</tr>
							</thead>
							<tbody>
							
							
							<?php foreach ($productos as $producto):?>
							
							<?php $estado= isset(Producto::$estados[$producto->estado])? Producto::$estados[$producto->estado]: 'Desconocido'  ?>
							
							<tr>
								<td><?= $producto->numero_serie; ?></td>
								<td><?= $producto->tipoProducto->nombre; ?></td>
								<td><?= $producto->descripcion; ?></td>
								<td><?= $producto->codigo_registro; ?></td>
								<td><?= $estado; ?></td>
								
								
								
								<td><i class="fa fa-lock" aria-hidden="true" ></i></td>
							</tr>
						
						<?php endforeach;?>
							</tbody>
							
						</table>	
                                
                                </div>
                           </div> 
                           
                          </div>
                       </div>
                     </div>
                     
</div>