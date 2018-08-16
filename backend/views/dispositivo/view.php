<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Dispositivo */

$this->title = $model->ID_DISPOSITIVO;
$this->params['breadcrumbs'][] = ['label' => 'Dispositivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dispositivo-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->ID_DISPOSITIVO], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->ID_DISPOSITIVO], [
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
            'ID_DISPOSITIVO',
            'CORREO_ELECTRONICO',
            'UID_FIREBASE',
            'ID_ALARMA',
            'TELEFONO',
        ],
    ]) ?>

</div>
