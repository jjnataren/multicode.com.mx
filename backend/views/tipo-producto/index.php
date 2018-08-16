<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\TiempoProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo de Productos';
$this->params['breadcrumbs'][] = $this->title;
$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-cube fa-stack-1x"></i>
							   </span>';

?>
<div class="tipo-producto-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Crear tipo producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_tipo_producto',
            'nombre',
        		'precio_base',
            'descripcion',
        	
        		[
        		'attribute'=>'categoria',
        		'content'=>function($data){
        			return   $data->getCategoriaProducto();
        		},
        		
        		],

        		[
        		'attribute'=>'activo',
        		'content'=>function($data){
        			return   $data->activo ? 'Si' : 'No';
        		},
        		
        		'filter'=>[1=>'Si', 0=>'No'],
        		],
        		
        		
            
        		

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
