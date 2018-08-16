<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CatalogoEventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catalogo Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-evento-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Catalogo Evento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_EVENTO',
            'NOMBRE',
            'DESCRIPCION',
            'ACTIVO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
