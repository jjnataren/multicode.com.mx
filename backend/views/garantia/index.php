<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Garantia;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\GarantiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitudes de garantía';
$this->params['breadcrumbs'][] = $this->title;

$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-check-square fa-stack-1x"></i>
							   </span>';
?>
<div class="garantia-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Crear solicitud de garantía', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_solicitud',
            'numero_serie',
            'fecha_solicitud',
            //'fecha_ingreso_garantia',
            //'fecha_valido_cliente',
        		[
        		'attribute'=>'estatus',
        		'content'=>function($data){
        		
        			$estatus = isset(Garantia::$estados[$data->estatus]) ? Garantia::$estados[$data->estatus] : 'Desconocido';
        		
        			return  $estatus;
        		
        		},
        		'filter'=>Garantia::$estados,
        		],
        		
            // 'fecha_envio',
            // 'folio_envio',
            // 'numero_guia',
            // 'comentarios',
            // 'fecha_recibio_cliente',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
