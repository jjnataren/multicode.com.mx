<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\SolicitudRobo;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SolicitudRoboSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reportes';
$this->params['breadcrumbs'][] = $this->title;

$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-user-secret fa-stack-1x"></i>
							   </span>';
?>
<div class="solicitud-robo-index">

  
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear reporte de robo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_solicitud_robo',
            'numero_serie',
            'fecha_robo',
            'fecha_solicitud',
        		'fecha_validacion',
        		'fecha_desactivar',
            //'descripcion',
             'acta_robo',
        		[
        		'attribute'=>'estatus',
        		'content'=>function($data){
        			return  isset(SolicitudRobo::$estados[$data->estatus])?SolicitudRobo::$estados[$data->estatus]:'desconocido';
        		},
        		'filter'=>SolicitudRobo::$estados,
        		],
             
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
