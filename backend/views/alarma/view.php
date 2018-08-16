<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Alarma */

$this->title = $model->ID_ALARMA;
$this->params['breadcrumbs'][] = ['label' => 'Alarmas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alarma-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->ID_ALARMA], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->ID_ALARMA], [
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
            'ID_ALARMA',
            'NOMBRE',
            'DESCRIPCION',
            'LAT',
            'LONG',
            'ACTIVO',
            'DIRECCION',
            'TELEFONO_RESPONSABLE',
            'NOMBRE_RESPONSABLE',
        ],
    ]) ?>

</div>
