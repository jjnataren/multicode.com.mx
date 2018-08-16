<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\VentaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ordenes de venta';
$this->params['breadcrumbs'][] = $this->title;
$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-thumbs-o-up fa-stack-1x"></i>
							   </span>';
?>
<div class="venta-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Crear orden de venta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'numero_orden',
            'clave_proveedor',
            'precio_publico',
            'fecha_venta',
            // 'estatus',
            // 'garantia',
            // 'seguro_robo',
            // 'comentarios',
            // 'tipo_pago',
            // 'descuento',
            // 'monto_total',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
