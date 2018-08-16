<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CodigoLog */

$this->title = 'Update Codigo Log: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Codigo Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="codigo-log-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
