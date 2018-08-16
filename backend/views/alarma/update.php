<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Alarma */

$this->title = 'Update Alarma: ' . ' ' . $model->ID_ALARMA;
$this->params['breadcrumbs'][] = ['label' => 'Alarmas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_ALARMA, 'url' => ['view', 'id' => $model->ID_ALARMA]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="alarma-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
