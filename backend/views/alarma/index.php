<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\AlarmaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alarmas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alarma-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Alarma', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_ALARMA',
            'NOMBRE',
            'DESCRIPCION',
            'LAT',
            'LONG',
            // 'ACTIVO',
            // 'DIRECCION',
            // 'TELEFONO_RESPONSABLE',
            // 'NOMBRE_RESPONSABLE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
