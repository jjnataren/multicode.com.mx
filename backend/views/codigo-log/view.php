<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CodigoLog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Codigo Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="codigo-log-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'numero_serie',
            'cliente',
            'fecha',
            'dispositivo',
            'activacion',
            'codigo_respuesta',
            'reactivacion',
            'sistema_operativo',
            'token_generado',
        ],
    ]) ?>

</div>
