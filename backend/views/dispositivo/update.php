<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Dispositivo */

$this->title = 'Update Dispositivo: ' . ' ' . $model->ID_DISPOSITIVO;
$this->params['breadcrumbs'][] = ['label' => 'Dispositivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_DISPOSITIVO, 'url' => ['view', 'id' => $model->ID_DISPOSITIVO]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dispositivo-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
