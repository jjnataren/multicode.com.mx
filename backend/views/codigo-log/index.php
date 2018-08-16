<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CodigoLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Codigos generados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="codigo-log-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create Codigo Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'numero_serie',
            'cliente',
            'fecha',
            //'dispositivo',
            // 'activacion',
             'codigo_respuesta',
            // 'reactivacion',
            // 'sistema_operativo',
             'token_generado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
