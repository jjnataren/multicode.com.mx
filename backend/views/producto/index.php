<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\TipoProducto;
use yii\helpers\ArrayHelper;
use backend\models\Producto;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-cubes fa-stack-1x"></i>
							   </span>';

?>
<div class="producto-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Crear Producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
		 <?php if (Yii::$app->session->hasFlash('success')): ?>
			  <div class="alert alert-success alert-dismissable">
			  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
			  <h4><i class="icon fa fa-check"></i>Guardado!</h4>
			  <?= Yii::$app->session->getFlash('success') ?>
			  </div>
		<?php endif; ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
        		'fecha_registro',
            'numero_serie',
        		[
        		'attribute'=>'tipo_producto',
        		'content'=>function($data){
        			 
        			$categoriaproducto = isset(TipoProducto::$categoriaDesc[$data->tipoProducto->categoria]) ? TipoProducto::$categoriaDesc[$data->tipoProducto->categoria] : 'Desconocido';
        		
        			return  $data->tipoProducto->nombre . ' - ' .  $categoriaproducto;
        			 
        		},
        		'filter'=>ArrayHelper::map(TipoProducto::findAll([ 'activo'=>1]), 'id_tipo_producto','nombre'),
        		],
            'fecha_fabricacion',
	            [
	            'attribute'=>'estado',
	            'content'=>function($data){
	            	return  isset(Producto::$estados[$data->estado])?Producto::$estados[$data->estado]:'desconocido';
	            },
	            'filter'=>Producto::$estados,
	            ],
            'codigo_registro',
            // 'precio_sugerido',
            // 'descripcion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
